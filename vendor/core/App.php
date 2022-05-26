<?php

namespace core;

use core\{base\Model, Registry, ErrorsHandler, Router};

class App
{
    private static $app;

    public function __construct() {
        $url = $this->getUrl();
        session_start();
        self::$app = Registry::instance();
        self::setParams();
        new ErrorsHandler();
        DB::createPDO();
//        MemcacheUser::createMemcache();
        Router::dispatch($url);
        new Model();
        Twig::render();
    }

    protected function getUrl():string {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        preg_match("#(^[a-z-/]+)#i", $url, $matches);

        if(isset($matches[1])) {
            return $matches[1];
        }

        return '';
    }

    private function setParams() {
        $params = require_once CONF . '/parameters.php';

        if(is_array($params)) {
            foreach($params as $k => $v) {
                self::$app::set($k, $v);
            }
        }
    }

    public static function getApp() {
        return self::$app;
    }
}