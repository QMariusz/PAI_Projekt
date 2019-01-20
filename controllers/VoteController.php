<?php

require_once("AppController.php");
require_once __DIR__.'/../model/VoteMapper.php';

class VoteController extends AppController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (!isset($_POST['id'])) {
            $this->render("index", "");
        }
        else {
            $url = "http://$_SERVER[HTTP_HOST]/";
            header("Location: {$url}?page=login");
            exit();
        }
    }

    public function questionVote()
    {
        if (!isset($_POST['id'])) {
            $this->render("questionVote", "");
        }
        else {
            $url = "http://$_SERVER[HTTP_HOST]/";
            header("Location: {$url}?page=login");
            exit();
        }
    }

    public function showOtherQuestionsAnswered(){
        $voteMapper = new VoteMapper();

        header('Content-type: application/json');
        http_response_code(200);

        echo $voteMapper->showOtherQuestionsAnswered() ? json_encode($voteMapper->showOtherQuestionsAnswered()) : '';
    }

    public function showOtherQuestionsNotAnswered(){
        $voteMapper = new VoteMapper();

        header('Content-type: application/json');
        http_response_code(200);

        echo $voteMapper->showOtherQuestionsNotAnswered() ? json_encode($voteMapper->showOtherQuestionsNotAnswered()) : '';
    }

    public function showYourQuestions(){
        $voteMapper = new VoteMapper();

        header('Content-type: application/json');
        http_response_code(200);

        echo $voteMapper->showYourQuestions() ? json_encode($voteMapper->showYourQuestions()) : '';
    }

    public function formVote(){
        if (!isset($_POST['id'])) {
            $mapper = new VoteMapper();
            $mapper->saveVote($_POST['voteRadio']);

            return $this->render('index', ['text' => 'Vote saved']);
        }
        else {
            $url = "http://$_SERVER[HTTP_HOST]/";
            header("Location: {$url}?page=login");
            exit();
        }
    }

    public function checkAnswerToQuestion(){
        $voteMapper = new VoteMapper();

        header('Content-type: application/json');

        if($voteMapper->checkAnswerToQuestion()) {
            http_response_code(200);
        }
        else{
            http_response_code(201);
        }

        echo $voteMapper->checkAnswerToQuestion() ? json_encode($voteMapper->checkAnswerToQuestion()) : '';
    }
}