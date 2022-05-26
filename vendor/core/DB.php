<?php

namespace core;
use PDO;

class DB
{
    private static $mainDB;
    private static $archiveDB;

    public static function createPDO() {
        extract(require_once CONF . "/db.php");

        $dsn = "pgsql:host=$host;port=$port;dbname=$nameMainDB";
        self::$mainDB = new PDO($dsn, $username, $password);

        $dsn = "pgsql:host=$host;port=$port;dbname=$nameArchiveDB";
        self::$archiveDB = new PDO($dsn, $username, $password);
    }

    public static function getMainDB() {
        return self::$mainDB;
    }

    public static function getArchiveDB() {
        return self::$archiveDB;
    }
}