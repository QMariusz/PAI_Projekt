<?php
/**
 * Created by PhpStorm.
 * User: Mariusz
 * Date: 23.12.2018
 * Time: 19:03
 */

class User
{
    private $nickname;
    private $email;
    private $password;
    private $role;

    public function __construct($nickname, $email, $password, $role)
    {
        $this->nickname = $nickname;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public function getNickname()
    {
        return $this->nickname;
    }

    public function setNickname($nickname): void
    {
        $this->nickname = $nickname;
    }


    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password): void
    {
        $this->password = md5($password);
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
    }
}