<?php
/**
 * Created by PhpStorm.
 * User: Mariusz
 * Date: 23.12.2018
 * Time: 19:19
 */


class QuizController extends AppController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function quiz()
    {
        $this->render('quiz');
    }
}
