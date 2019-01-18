<?php
require_once 'Question.php';
require_once __DIR__.'/../Database.php';

class VoteMapper
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function showOtherQuestions()
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
}