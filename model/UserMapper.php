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

    public function saveUser($user)
    {
        try {
            $stmt = $this->database->connect()->prepare("INSERT INTO users (nickname,  email, password ,role) 
              VALUES ('".$user->getNickname()."','".$user->getEmail()."','".$user->getPassword()."','".$user->getRole()."')");
            $stmt->execute();
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function deleteUser($id)
    {
        try {
            $stmt = $this->database->connect()->prepare("DELETE FROM users WHERE id = :id;");
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}