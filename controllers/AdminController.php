<?php
require_once 'AppController.php';

require_once __DIR__.'/../model/User.php';
require_once __DIR__.'/../model/UserMapper.php';
require_once __DIR__.'/../model/QuestionMapper.php';

class AdminController extends AppController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(): void
    {
        if(isset($_SESSION['id']) && isset($_SESSION['role']) && $_SESSION['role'] == "Admin") {
            $user = new UserMapper();
            $this->render('index', ['user' => $user->getUser($_SESSION['id'])]);
        }
        else {
            $url = "http://$_SERVER[HTTP_HOST]/";
            header("Location: {$url}?page=index");
            exit();
        }
    }

    public function getAllUsers(): void
    {
        $user = new UserMapper();

        header('Content-type: application/json');
        http_response_code(200);

        echo $user->getUsers() ? json_encode($user->getUsers()) : '';
    }

    public function deleteUser(): void
    {
        if (!isset($_POST['id'])) {
            http_response_code(404);
            return;
        }

        $user = new UserMapper();
        $user->deleteUser((int)$_POST['id']);

        http_response_code(200);
    }

    public function promoteUser(): void
    {
        if (!isset($_POST['id'])) {
            http_response_code(404);
            return;
        }

        $user = new UserMapper();
        $user->promoteUser((int)$_POST['id']);

        http_response_code(200);
    }


    public function getAllQuestions(){
        $question = new QuestionMapper();

        header('Content-type: application/json');
        http_response_code(200);

        echo $question->getAllQuestions() ? json_encode($question->getAllQuestions()) : '';
    }
}
