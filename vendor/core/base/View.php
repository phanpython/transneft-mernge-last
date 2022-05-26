<?php

namespace core\base;

use core\Twig;

class View
{
    protected $route;
    protected $controller;
    protected $view;
    protected $prefix;
    protected $data;
    protected $meta;
    protected $layout;
    protected $nameDir = '';

    public function __construct($route, $layout, $meta, $name) {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->view = $route['action'];
        $this->prefix = $route['prefix'];
        $this->meta = $meta;
        $this->nameDir = $name;

        if($layout === false) {
            $this->layout = false;
        } else {
            $this->layout = $layout ?: LAYOUT;
        }
    }

    public function render($data) {
        if(is_array($data)) {
            extract($data);
        }

        $viewDirectory = APP . "\\views\\{$this->prefix}{$this->controller}";
        Twig::setTwig($viewDirectory);
        Twig::setLoadTemplate("{$this->view}.php");
        $this->setVarsToTwig();
    }

    public function setVarsToTwig() {
        Twig::addVarsToArrayOfRender(['meta' => $this->meta]);
    }

    public function getMeta() {
        return array_values($this->meta);
    }
}