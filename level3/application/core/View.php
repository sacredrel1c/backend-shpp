<?php

namespace application\core;
class View
{
    public $path;
    public $route;
    protected $layout_header = 'default_header';
    protected $layout_footer = 'default_footer';

    public function __construct($route)
    {
        $this->route = $route;
        $this->path = $route['controller'] . '/' . $route['action'];
    }

    public function render($title, $content = [])
    {
        require 'application/views/layouts/' . $this->layout_header . '.php';
        require 'application/views/' . $this->path . '.php';
        require 'application/views/layouts/' . $this->layout_footer . '.php';
    }

    public static function errorCode($code)
    {
        http_response_code($code);
        require 'application/views/errors/' . $code . '.php';
    }

    public function setLayout($layout)
    {
        $this->layout_header = $layout . "_header";
        $this->layout_footer = $layout . "_footer";
    }
}