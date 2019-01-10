<?php
/**
 * Created by PhpStorm.
 * User: Mariusz
 * Date: 23.12.2018
 * Time: 19:19
 */
require_once __DIR__.'/../model/QuestionMapper.php';
require_once __DIR__.'/../model/Question.php';


class QuizController extends AppController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function saveQuestion(){
        $answers = "";
        $votes = "";

        foreach ($_POST as $key => $value){
            if(is_int($key)){
                $answers = $answers.$value.", ";
                $votes = $votes."0, ";
            }
        }

        if ($this->isPost()) {
            $question = new Question(null, 2, $_POST['textarea'], $answers, $votes);
            $questionMapper = new QuestionMapper();
            $questionMapper->saveQuestion($question);
        }
    }

    public function loadQuestion(){
        $questionMapper = new QuestionMapper();
        $questionMapper->loadQuestion(null);
    }
}
