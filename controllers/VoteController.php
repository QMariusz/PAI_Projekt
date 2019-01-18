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

    public function showOtherQuestions(){
        $voteMapper = new VoteMapper();

        header('Content-type: application/json');
        http_response_code(200);

        echo $voteMapper->showOtherQuestions() ? json_encode($voteMapper->showOtherQuestions()) : '';
    }

    public function formVote(){
        $mapper = new QuestionMapper();
        $mapper->saveVote($_POST['voteRadio']);

        return $this->render('index', ['text' => 'Account created']);
    }
}