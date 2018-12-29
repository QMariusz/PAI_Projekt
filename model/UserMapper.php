<?php
require_once 'User.php';
require_once __DIR__.'/../Database.php';

class UserMapper
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getUser(string $nickname): User
    {
        try {
            $stmt = $this->database->connect()->prepare('SELECT * FROM users WHERE nickname = :nickname;');
            $stmt->bindParam(':nickname', $nickname, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return new User($user['nickname'], $user['email'], $user['password'], $user['role']);
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}