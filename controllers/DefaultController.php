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

        $this->renderFunction("showChart", 0);
    }

    public function login()
    {
        $mapper = new UserMapper();

        $user = null;

        if ($this->isPost()) {

            $user = $mapper->getUser($_POST['email']);

            if(!$user) {
                return $this->render('login', ['message' => ['Email not recognized']]);
            }

            if ($user->getPassword() !== $_POST['password']) {
                return $this->render('login', ['message' => ['Wrong password']]);
            } else {
                $_SESSION["id"] = $user->getEmail();
                $_SESSION["role"] = $user->getRole();

                $url = "http://$_SERVER[HTTP_HOST]/";
                header("Location: {$url}?page=index");
                exit();
            }
        }

        $this->render('login');
    }

    public function logout()
    {
        session_unset();
        session_destroy();

        $this->render('index', ['text' => 'You have been successfully logged out!']);
    }

    public function createQuestion(){
        if(isset($_POST['selectAnswers'])) {
            $this->renderFunction("createQuestion", $_POST['selectAnswers']);
        }
        else{
            $this->renderFunction("index", 0);
        }
    }

    public function addQuestion(){
        $this->renderFunction("addQuestion", 0);
    }

    public function renderFunction($method, $number){
        $questionMapper = new QuestionMapper();
        $questions = $questionMapper->loadQuestions();

        $this->render('index', $method, $questions, $number);
    }
}