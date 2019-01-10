<?php
/**
 * Created by PhpStorm.
 * User: Mariusz
 * Date: 23.12.2018
 * Time: 14:23
 */

require_once('controllers/DefaultController.php');
require_once('controllers/UploadController.php');
require_once('controllers/PlayerController.php');
require_once('controllers/QuizController.php');

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
            'createQuestion' => [
                'controller' => 'DefaultController',
                'action' => 'createQuestion'
            ],
            'saveQuestion' => [
                'controller' => 'QuizController',
                'action' => 'saveQuestion'
            ],
            'authorQuestion' => [
                'controller' => 'QuizController',
                'action' => 'loadQuestion'
            ]
        ];
    }

    public function run()
    {
        $page = isset($_GET['page'])
        && isset($this->routes[$_GET['page']]) ? $_GET['page'] : 'index';

        if ($this->routes[$page]) {
            $class = $this->routes[$page]['controller'];
            $action = $this->routes[$page]['action'];

            $object = new $class;
            $object->$action();
        }
    }
}