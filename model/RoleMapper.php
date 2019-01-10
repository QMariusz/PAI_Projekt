<?php
require_once 'Role.php';
require_once __DIR__.'/../Database.php';

class RoleMapper
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function loadQuestions()
    {
        try {
            $stmt = $this->database->connect()->prepare('SELECT * FROM questions;');
            $stmt->execute();
            $queryArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $questionsArray = array();
            foreach ($queryArray as $item) {
                array_push($questionsArray, new Question($item['id'], $item['authorId'], $item['name'], $item['questions'], $item['votes']));
            }

            return $questionsArray;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function saveUsers($question)
    {
        try {
            $stmt = $this->database->connect()->prepare("INSERT INTO questions (name,  author_id, answers, votes) 
              VALUES ('".$question->getName()."','".$question->getAuthorId()."','".$question->getAnswers()."','".$question->getVotes()."')");
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
}