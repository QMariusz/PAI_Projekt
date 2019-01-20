<?php

require_once("AppController.php");
require_once(__DIR__.'/../model/User.php');
require_once __DIR__.'/../model/UserMapper.php';
require_once __DIR__.'/../model/Question.php';
require_once __DIR__.'/../model/QuestionMapper.php';

class QuestionController extends AppController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function addQuestion(){
        if(isset($_SESSION['id'])) {
            $questionMapper = new QuestionMapper();
            if ($this->isPost()) {
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
                    $now = date("j-m-y h:i");

                    $question = new Question(null, $_SESSION['id'], $_POST['questionName'], $answers,$votes, $now, $now);
                    $questionMapper->saveQuestion($question);
                    return $this->render('index', ['text' => 'Question created']);
            }

            $this->render('addQuestion', "");
        }
        else {
            $url = "http://$_SERVER[HTTP_HOST]/";
            header("Location: {$url}?page=login");
            exit();
        }
    }
    //uzywane?
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
    }

    public function search(){
        if(isset($_SESSION['id'])) {
            $this->render('search', "");
        }
        else {
            $url = "http://$_SERVER[HTTP_HOST]/";
            header("Location: {$url}?page=login");
            exit();
        }
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

    public function searchResult(){
        $questionMapper = new QuestionMapper();
        header('Content-type: application/json');
        http_response_code(200);

        echo $questionMapper->searchResult($_POST['search']) ? json_encode($questionMapper->searchResult($_POST['search'])) : '';
    }
}