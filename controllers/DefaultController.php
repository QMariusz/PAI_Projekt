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

        $this->render("index", "");
    }

    public function login()
    {
        $mapper = new UserMapper();

        $user = null;

        if ($this->isPost()) {

            $user = $mapper->getUser($_POST['nickname']);

            if($user==null) {
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

    public function register(){
        $mapper = new UserMapper();

        if ($this->isPost()) {

            if($mapper->checkNickname($_POST['nickname'])) {
                return $this->render('register', ['message' => ['Nickname already in use']]);
            }

//            if ($user->getPassword() !== $_POST['password']) {
//                return $this->render('login', ['message' => ['Wrong password']]);
//            }
            else {
//                $_SESSION["id"] = $user->getEmail();
//                $_SESSION["role"] = $user->getRole();

//                $url = "http://$_SERVER[HTTP_HOST]/";
//                header("Location: {$url}?page=index");
//                exit();
                $user = new User(null, $_POST['nickname'], $_POST['email'], $_POST['password'], 1);
                $mapper->saveUser($user);
                return $this->render('login', ['text' => 'Account created']);
            }
        }

        $this->render('register');
    }

    public function logout()
    {
        session_unset();
        session_destroy();

        $this->render('login', ['text' => 'You have been successfully logged out!']);
    }

    public function addQuestion(){

        $questionMapper = new QuestionMapper();
        if ($this->isPost()) {

//
//            if($mapper->checkNickname($_POST['nickname'])) {
//                return $this->render('register', ['message' => ['Nickname already in use']]);
//            }

//            else {
//                $_SESSION["id"] = $user->getEmail();
//                $_SESSION["role"] = $user->getRole();

//                $url = "http://$_SERVER[HTTP_HOST]/";
//                header("Location: {$url}?page=index");
//                exit();
                $answers = '';
                $votes = '';
                foreach($_POST as $key=>$value ) {
                    if (strpos($key, 'answer') !== false) {
                        $answers = $answers.$value.", ";
                        $votes = $votes.'0, ';
                    }
                }
                $answers = rtrim($answers,  ", ");
                $votes = rtrim($votes,  ", ");
                $question = new Question(null, $_SESSION['id'], $_POST['questionName'], $answers,$votes);
                $questionMapper->saveQuestion($question);
                return $this->render('index', ['text' => 'Question created']);
//            }
        }

        $this->render('addQuestion', "");
    }

    public function renderFunction($method, $number){
        $questionMapper = new QuestionMapper();
        $questions = $questionMapper->showQuestions();

        $this->render('index', "");
    }

    public function showQuestions(){
        $questionMapper = new QuestionMapper();

        header('Content-type: application/json');
        http_response_code(200);

        echo $questionMapper->showQuestions() ? json_encode($questionMapper->showQuestions()) : '';
//        $this->render('index', "");
    }

    public function deleteQuestion(): void
    {
        if (!isset($_POST['id'])) {
            http_response_code(404);
            return;
        }

        $question = new QuestionMapper();
        $question->deleteQuestion((int)$_POST['id']);

        http_response_code(200);
    }

    public function questions(){
        $this->render("questions", "");
    }
}