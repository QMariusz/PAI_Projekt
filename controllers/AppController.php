<?php
/**
 * Created by PhpStorm.
 * User: Mariusz
 * Date: 23.12.2018
 * Time: 18:36
 */

class AppController
{
    const UPLOAD_DIRECTORY = '/public/upload/';

    private $request = null;

    public function __construct()
    {
        $this->request = strtolower($_SERVER['REQUEST_METHOD']);
        session_start();
    }

    public function isGet()
    {
        return $this->request === 'get';
    }

    public function isPost()
    {
        return $this->request === 'post';
    }

    public function render(string $fileName = null, $function, $variables = [], $number)
    {
        $view = $fileName ? dirname(__DIR__).'/views/'.get_class($this).'/'.$fileName.'.php' : '';

        $output = 'There isn\'t such file to open';

        if (file_exists($view)) {

            if($variables!=null) {
                extract($variables);
            }

            ob_start();
            include $view;
            $output = ob_get_clean();
        }

        print $output;
    }
}