<?php

namespace core\base;

abstract class Controller
{
    protected $route;
    protected $controller;
    protected $view;
    protected $prefix;
    protected $data;
    protected $meta;
    protected $layout;

    public function __construct($route) {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->view = $route['action'];
        $this->prefix = $route['prefix'];
    }

    public function getView($name) {
        $objectView = new View($this->route, $this->layout, $this->meta, $name);
        $objectView->render($this->data);
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function setMeta($title = 'Главная', $description = '', $keywords = '') {
        $this->meta['title'] = $title;
        $this->meta['description'] = $description;
        $this->meta['keywords'] = $keywords;
    }
}