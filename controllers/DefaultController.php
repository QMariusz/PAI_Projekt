<?php

require_once("AppController.php");
require_once(__DIR__.'/../model/User.php');
require_once __DIR__.'/../model/UserMapper.php';
require_once __DIR__.'/../model/Question.php';
require_once __DIR__.'/../model/QuestionMapper.php';

class DefaultController extends AppController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if(isset($_SESSION['id'])) {
            $this->render("index", "");
        }
        else {
            $url = "http://$_SERVER[HTTP_HOST]/";
            header("Location: {$url}?page=login");
            exit();
        }
    }

    public function login()
    {
        $mapper = new UserMapper();

        $user = null;

        if ($this->isPost()) {

            $user = $mapper->getUser($_POST['nickname']);

            if ($user == null) {
                return $this->render('login', ['message' => ['Nickname not recognized']]);
            }

            if ($user->getPassword() !== md5($_POST['password'])) {
                return $this->render('login', ['message' => ['Wrong password']]);
            } else {
                $_SESSION["id"] = $user->getId();
                $_SESSION["role"] = $user->getRoleId();

                $url = "http://$_SERVER[HTTP_HOST]/";
                header("Location: {$url}?page=index");
                exit();
            }
        }

        $this->render('login');
    }

    public function register()
    {
        $mapper = new UserMapper();

        if ($this->isPost()) {

            if ($mapper->checkNickname($_POST['nickname'])) {
                return $this->render('register', ['message' => ['Nickname already in use']]);
            }

            else if ($mapper->checkEmail($_POST['email'])) {
                return $this->render('register', ['message' => ['Email already in use']]);
            }

            else if($_POST['password'] !== $_POST['passwordConfirm']){
                return $this->render('register', ['message' => ['Passwords are different']]);
            }
            else{
                $user = new User(null, $_POST['nickname'], $_POST['email'], $_POST['password'], 2);
                $mapper->saveUser($user);
                return $this->render('login', ['message' => ['Account created']]);
            }
        }

        $this->render('register');
    }

    public function logout()
    {
        session_unset();
        session_destroy();

        $this->render('login', ['message' => ['You have been successfully logged out!']]);
    }
}