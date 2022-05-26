<?php

namespace core;

class Router
{
    protected static $routes = [];
    protected static $route = [];

    public static function add($regexp, $route = []) {
        self::$routes[$regexp] = $route;
    }   

    public static function getRoutes():array {
        return self::$routes;
    }

    public static function getRoute():array {
        return self::$route;
    }

    public static function dispatch($url):void {
        if(self::isRoute($url)) {
            $controller = 'controllers\\' . self::$route['prefix'] . self::$route['controller'] . 'Controller';

            if(class_exists($controller)) {
                $controllerObject = new $controller(self::$route);
                $action = self::$route['action'] . 'Action';

                if(method_exists($controllerObject, $action)) {
                    $controllerObject->$action();
                    $controllerObject->getView(self::$route['controller']);
                } else {
                    throw new \Exception("Метод $action не найден", 404);
                }
            } else {
                throw new \Exception("Контроллер $controller не найден", 404);
            }
        } else {
            throw new \Exception('Страница не найдена', 404);
        }
    }

    public static function isRoute($url):bool {
        foreach (self::$routes as $regexp => $route) {
            if(preg_match("#$regexp#", $url, $matches)) {
                self::setRoute($matches, $route);
                return true;
            }
        }

        return false;
    }

    protected static function setRoute($matches, $route) {
        foreach ($matches as $k => $v) {
            if(is_string($k)) {
                $route[$k] = $v;
            }
        }

        if(empty($route['action'])) {
            $route['action'] = 'index';
        }

        if(isset($route['prefix'])) {
            $route['prefix'] .= '\\';
        } else {
            $route['prefix'] = '';
        }

        $route['controller'] = self::upperCamelCase($route['controller']);
        $route['action'] = self::lowerCamelCase($route['action']);

        self::$route = $route;
    }

    protected static function upperCamelCase($str):string {
        return str_replace(' ', '' ,ucwords(str_replace('-', ' ', $str)));
    }

    protected static function lowerCamelCase($str) {
        return lcfirst(str_replace(' ', '' ,ucwords(str_replace('-', ' ', $str))));
    }
}