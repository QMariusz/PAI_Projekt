<?php
require_once 'Question.php';
require_once __DIR__.'/../Database.php';

class QuestionMapper
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function showQuestions()
    {
        try {
            $stmt = $this->database->connect()->prepare('SELECT * FROM questions;');
            $stmt->execute();
            $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $questions;
        } catch (PDOException $e) {
            die();
        }
    }

    public function loadQuestion($question)
    {
        try {
            $stmt = $this->database->connect()->prepare("INSERT INTO questions (author_id, question_name,  answers, votes) 
              VALUES ('".$question->getAuthorId()."','".$question->getName()."','".$question->getAnswers()."','".$question->getVotes()."')");
            $stmt->execute();
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function deleteUsers($id)
    {
        try {
            $stmt = $this->database->connect()->prepare("DELETE FROM questions WHERE id = :id;");
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function getQuestionById($id)
    {
        try {
            $stmt = $this->database->connect()->prepare('SELECT * FROM questions WHERE id = :id;');
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
            $queryArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $questionsArray = array();
            foreach ($queryArray as $item) {
                array_push($questionsArray, new Question($item['question_id'], $item['author_id'], $item['question_name'], $item['answers'], $item['votes']));
            }

            return $questionsArray;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function getAllQuestions(){
        try {
            $stmt = $this->database->connect()->prepare('SELECT * FROM questions LEFT JOIN users ON questions.author_id = users.id_user');
            $stmt->execute();

            $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $questions;
        }
        catch(PDOException $e) {
            die();
        }
    }

    public function saveQuestion($question)
    {
        try {
            $stmt = $this->database->connect()->prepare("INSERT INTO questions (author_id,  question_name, answers ,votes, add_date, modify_date) 
              VALUES ('".$question->getAuthorId()."','".$question->getName()."','".$question->getAnswers()."','".$question->getVotes()."','".$question->getAddDate()."','".$question->getAddDate()."')");
            $stmt->execute();
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function deleteQuestion(int $id): void
    {
        try {
            $stmt = $this->database->connect()->prepare('DELETE FROM questions WHERE id = :id;');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        }
        catch(PDOException $e) {
            die();
        }
    }

    public function searchResult($likeString)
    {
        try {
            $a = "%$likeString%";
            $stmt = $this->database->connect()->prepare('SELECT * FROM questions WHERE question_name LIKE :question');
            $stmt->bindParam(':question', $a);
            $stmt->execute();
            $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $questions;
        } catch (PDOException $e) {
            die();
        }
    }

    public function getAnswersById($id)
    {
        try {
            $stmt = $this->database->connect()->prepare('SELECT votes FROM questions WHERE id = :id;');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $answers = $stmt->fetch(PDO::FETCH_ASSOC);
            return $answers['votes'];
        } catch (PDOException $e) {
            die();
        }
    }
}