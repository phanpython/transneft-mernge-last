<?php

namespace core;

use core\TSingletone;

class Registry
{
    use TSingletone;
    private static $properties = [];

    public static function set(string $name, string $value):bool {
        if(!empty($name) && !empty($value)) {
            self::$properties[$name] = $value;
            return true;
        }

        return false;
    }

    public static function get(string $name):string {
        $result = '';

        if(isset(self::$properties[$name])) {
            $result = self::$properties[$name];
        }

        return $result;
    }

    public static function remove($key):bool
    {
        unset(self::$properties[$key]);
        return true;
    }

    public static function clean():bool
    {
        self::$properties = array();
        return true;
    }
}