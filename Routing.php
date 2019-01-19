<?php
require_once('controllers/DefaultController.php');
require_once('controllers/VoteController.php');
require_once('controllers/AdminController.php');
require_once('controllers/QuestionController.php');

class Routing
{
    public $routes = [];

    public function __construct()
    {
        $this->routes = [
            'index' => [
                'controller' => 'DefaultController',
                'action' => 'index'
            ],
            'login' => [
                'controller' => 'DefaultController',
                'action' => 'login'
            ],
            'register' => [
                'controller' => 'DefaultController',
                'action' => 'register'
            ],
            'logout' => [
                'controller' => 'DefaultController',
                'action' => 'logout'
            ],
            'addQuestion' => [
                'controller' => 'QuestionController',
                'action' => 'addQuestion'
            ],
            'deleteQuestion' => [
                'controller' => 'QuestionController',
                'action' => 'deleteQuestion'
            ],
            'showQuestions' => [
                'controller' => 'QuestionController',
                'action' => 'showQuestions'
            ],
            'questions' => [
                'controller' => 'QuestionController',
                'action' => 'questions'
            ],
            'deleteUser' => [
                'controller' => 'AdminController',
                'action' => 'deleteUser'
            ],
            'search' => [
                'controller' => 'QuestionController',
                'action' => 'search'
            ],
            'searchResult' => [
                'controller' => 'QuestionController',
                'action' => 'searchResult'
            ],
            'voteSearch' => [
                'controller' => 'VoteController',
                'action' => 'showOtherQuestionsAnswered'
            ],
            'notAnswered' => [
                'controller' => 'VoteController',
                'action' => 'showOtherQuestionsNotAnswered'
            ],
            'showYourQuestions' => [
                'controller' => 'VoteController',
                'action' => 'showYourQuestions'
            ],
            'vote' => [
                'controller' => 'VoteController',
                'action' => 'index'
            ],
            'questionVote' => [
                'controller' => 'VoteController',
                'action' => 'questionVote'
            ],
            'admin' => [
                'controller' => 'AdminController',
                'action' => 'index'
            ],
            'allQuestions' => [
                'controller' => 'AdminController',
                'action' => 'getAllQuestions'
            ],
            'allUsers' => [
                'controller' => 'AdminController',
                'action' => 'getAllUsers'
            ],
            'formVote' => [
                'controller' => 'VoteController',
                'action' => 'formVote'
            ],
            'checkAnswerToQuestion' => [
                'controller' => 'VoteController',
                'action' => 'checkAnswerToQuestion'
            ]
        ];
    }

    public function run()
    {
        $page = isset($_GET['page'])
        && isset($this->routes[$_GET['page']]) ? $_GET['page'] : 'login';

        if ($this->routes[$page]) {
            $class = $this->routes[$page]['controller'];
            $action = $this->routes[$page]['action'];

            $object = new $class;
            $object->$action();
        }
    }
}