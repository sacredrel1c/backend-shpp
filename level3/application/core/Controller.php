<?php

namespace application\core;

use application\core\View;
use application\core\Model;

abstract class Controller
{
    public $route;
    public $view;
    public $model;

    function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($route);
        $this->model = $this->loadModel($route['controller']);

    }

    public function loadModel($model){
        $path = 'application\models\\'.ucfirst($model).'Model';
        if(class_exists($path)){
            return new $path;
        }
    }

    public function redirect($url)
    {
        header('Location: ' . $url);
        die();
    }
}