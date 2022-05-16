<?php

namespace cube\base;


abstract class Controller
{
    public $route;
    public $controller;
    public $model;
    public $view;
    public $layout;
    public $prefix;
    public $data = [];
    public $meta = ['title' => '', 'desc' => '', 'key' => ''];

    public function __construct($route)
    {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->view = $route['action'];
        $this->prefix = $route['prefix'];
        $this->model = $route['controller'];
    }

    public function getView()
    {
        $viewObj = new View($this->route, $this->layout, $this->view, $this->meta);
        $viewObj->render($this->data);
    }

    public function set($data)
    {
        $this->data = $data;
    }

    public function setMeta($title = '', $desc = '', $keyw = ''){
        $this->meta['title'] = $title;
        $this->meta['desc'] = $desc;
        $this->meta['key'] = $keyw;
    }
    public function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    public function loadView($view, $vars = [])
    {
        extract($vars);
        $this->prefix = str_replace('\\', '/', $this->prefix);
        require APP . "/views/{$this->prefix}{$this->controller}/{$view}.atpl.php";
        die;
    }

    public function getRequestID($get = true, $id = 'id')
    {
        if ($get) {
            $data = $_GET;
        } else {
            $data = $_POST;
        }
        $id = !empty($data[$id]) ? (int)$data[$id] : null;
        if (!$id) {
            throw new \Exception('Страница не найдена', 404);
        }
        return $id;
    }
}