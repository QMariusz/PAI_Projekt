<?php
require_once 'Question.php';
require_once 'QuestionMapper.php';
require_once __DIR__.'/../Database.php';

class VoteMapper
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function showOtherQuestionsAnswered()
{
    try {
        $stmt = $this->database->connect()->prepare('SELECT *  FROM questions, answered_by WHERE questions.id = answered_by.question_id AND answered_by.user_id = :id;');
        $stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_STR);
        $stmt->execute();
        $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $questions;
    } catch (PDOException $e) {
        die();
    }
}

    public function showOtherQuestionsNotAnswered()
    {
        try {

            $stmt = $this->database->connect()->prepare('SELECT *  FROM questions, answered_by WHERE questions.id = answered_by.question_id AND answered_by.user_id = :id;');
            $stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_STR);
            $stmt->execute();
            $questions2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $stmt = $this->database->connect()->prepare('SELECT *  FROM questions;');
            $stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_STR);
            $stmt->execute();
            $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($questions as $key => $value){
                foreach ($questions2 as $value2){
                    if($value2['id']==$value['id']){
                        array_splice($questions, $key, 1, 2);
                    }
                }
            }
//            array_diff($questions, $questions2);

            return $questions;
        } catch (PDOException $e) {
            die();
        }
    }

    public function showYourQuestions()
    {
        try {
            $stmt = $this->database->connect()->prepare('SELECT * FROM questions WHERE author_id = :author_id;');
            $stmt->bindParam(':author_id', $_SESSION['id'], PDO::PARAM_STR);
            $stmt->execute();
            $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $questions;
        } catch (PDOException $e) {
            die();
        }
    }

    public function saveVote($dane)
    {
        try {
            $mapper = new QuestionMapper();
            $idAndAnswer = explode(",", $dane);
            $answers = $mapper->getAnswersById($idAndAnswer[0]);
            $answersArray = explode(", ", $answers);
            $answersArray[$idAndAnswer[1]] += 1;
            $updatedAnswers =  implode(", ",$answersArray);
            $now = date("j-m-y h:i");
            $stmt = $this->database->connect()->prepare("UPDATE questions SET votes = :votes, modify_date = :modify_date WHERE id = :id");
            $stmt->bindParam(':votes', $updatedAnswers, PDO::PARAM_STR);
            $stmt->bindParam(':modify_date', $now, PDO::PARAM_STR);
            $stmt->bindParam(':id', $idAndAnswer[0], PDO::PARAM_INT);
            $stmt->execute();

            $stmt = $this->database->connect()->prepare("INSERT INTO answered_by (question_id, user_id) 
              VALUES ('".$idAndAnswer[0]."','".$_SESSION['id']."')");
            $stmt->execute();
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function checkAnswerToQuestion(){
        try {
            $stmt = $this->database->connect()->prepare('SELECT * FROM answered_by WHERE question_id = :question AND user_id = :user;');
            $stmt->bindParam(':question', $_POST['question_id'], PDO::PARAM_STR);
            $stmt->bindParam(':user', $_SESSION['id'], PDO::PARAM_STR);
            $stmt->execute();
            $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($questions != null){
                return true;
            }
            return false;
        } catch (PDOException $e) {
            die();
        }
    }
}