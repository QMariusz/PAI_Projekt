<?php
require_once 'Question.php';
require_once __DIR__.'/../Database.php';
require_once __DIR__.'/../views/DefaultController/search.php';

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

    public function showQuestion($id)
    {
        try {
            $stmt = $this->database->connect()->prepare('SELECT * FROM questions WHERE id = :id;');
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
            $queryArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $questionsArray = array();
            foreach ($queryArray as $item) {
                array_push($questionsArray, new Question($item['id'], $item['author_id'], $item['question_name'], $item['answers'], $item['votes']));
            }

            return $questionsArray;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function saveQuestion($question)
    {
        try {
            $stmt = $this->database->connect()->prepare("INSERT INTO questions (author_id,  question_name, answers ,votes) 
              VALUES ('".$question->getAuthorId()."','".$question->getName()."','".$question->getAnswers()."','".$question->getVotes()."')");
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
            $stmt = $this->database->connect()->prepare('SELECT * FROM questions WHERE question_name LIKE :question_name;');
            $stmt->bindParam(':question_name', $likeString, PDO::PARAM_INT);
            $stmt->execute();
            $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $questions;
        } catch (PDOException $e) {
            die();
        }
    }
}