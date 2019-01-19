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

        $this->render("index", "");
    }

    public function questionVote()
    {

        $this->render("questionVote", "");
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
        $mapper = new VoteMapper();
        $mapper->saveVote($_POST['voteRadio']);

        return $this->render('index', ['text' => 'Vote saved']);
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