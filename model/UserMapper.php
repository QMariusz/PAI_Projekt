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

    public function getUsers()
    {
        try {
            $stmt = $this->database->connect()->prepare('SELECT * FROM users RIGHT JOIN role ON users.role_id = role.role_id  WHERE users.id != :id;');
            $stmt->bindParam(':id', $_SESSION['id']);
            $stmt->execute();

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $user;
        }
        catch(PDOException $e) {
            die();
        }
    }

    public function getUser(string $nickname)
    {
        try {
            $stmt = $this->database->connect()->prepare('SELECT * FROM `user_with_role` WHERE nickname = :nickname;');
            $stmt->bindParam(':nickname', $nickname, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if($user['id']!=null) {
                return new User($user['id'], $user['nickname'], $user['email'], $user['password'], $user['role_name']);
            }
            return null;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function saveUser($user)
    {
        try {
            $stmt = $this->database->connect()->prepare("INSERT INTO users (nickname,  email, password ,role_id) 
              VALUES ('".$user->getNickname()."','".$user->getEmail()."','".md5($user->getPassword())."','".$user->getRoleId()."')");
            $stmt->execute();
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function checkNickname($nickname){
        try {
            $stmt = $this->database->connect()->prepare("SELECT * FROM users WHERE nickname = :nickname;");
            $stmt->bindParam(':nickname', $nickname, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if($user == false){
                return false;
            }
            return true;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function checkEmail($email){
        try {
            $stmt = $this->database->connect()->prepare("SELECT * FROM users WHERE email = :email;");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if($user == false){
                return false;
            }
            return true;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function deleteUser($id)
    {
        $connection = $this->database->connect();
        $connection->beginTransaction();
        try {
            $stmt = $this->database->connect()->prepare("DELETE FROM questions WHERE author_id = :id;");
            $stmt ->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt ->execute();

            $stmt = $this->database->connect()->prepare("DELETE FROM users WHERE id = :id;");
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
            $connection->commit();
        } catch (PDOException $e) {
            $connection->rollBack();
        }
    }

    public function promoteUser($id)
    {
        try {
            $stmt = $this->database->connect()->prepare("UPDATE users SET role_id = 1 WHERE id = :id;");
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}