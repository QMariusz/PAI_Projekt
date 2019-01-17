<?php
require_once('controllers/DefaultController.php');
require_once('controllers/VoteController.php');
require_once('controllers/AdminController.php');

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
            'upload' => [
                'controller' => 'UploadController',
                'action' => 'upload'
            ],
            'player' => [
                'controller' => 'PlayerController',
                'action' => 'player'
            ],
            'addQuestion' => [
                'controller' => 'DefaultController',
                'action' => 'addQuestion'
            ],
            'saveQuestion' => [
                'controller' => 'QuizController',
                'action' => 'saveQuestion'
            ],
            'deleteQuestion' => [
                'controller' => 'DefaultController',
                'action' => 'deleteQuestion'
            ],
            'authorQuestion' => [
                'controller' => 'QuizController',
                'action' => 'loadQuestion'
            ],
            'showQuestions' => [
                'controller' => 'DefaultController',
                'action' => 'showQuestions'
            ],
            'questions' => [
                'controller' => 'DefaultController',
                'action' => 'questions'
            ],
            'deleteUser' => [
                'controller' => 'AdminController',
                'action' => 'deleteUser'
            ],
            'search' => [
                'controller' => 'DefaultController',
                'action' => 'search'
            ],
            'searchResult' => [
                'controller' => 'DefaultController',
                'action' => 'searchResult'
            ],
            'voteSearch' => [
                'controller' => 'VoteController',
                'action' => 'showOtherQuestions'
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