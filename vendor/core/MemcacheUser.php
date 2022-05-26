<?php

namespace core;

use Memcache;

class MemcacheUser
{
    private static $memcache;

    public static function createMemcache() {
        self::$memcache = new Memcache;

        if(!self::$memcache->connect('127.0.0.1', 11211)) {
            throw new \Exception("Соединение Memcache с сервером не выполнено", 500);
        }
    }

    public static function getMemcache() {
        return self::$memcache;
    }
}