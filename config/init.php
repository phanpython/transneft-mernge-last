<?php
$path = str_replace('/', '\\', $_SERVER['DOCUMENT_ROOT']);

define("ROOT", $path);
define("PATH", 'http://' . $_SERVER['HTTP_HOST']);
const DEBUG = 1;
const WWW = ROOT . '\\public';
const ADMIN = ROOT . '\\public\\admin';
const APP = ROOT . '\\app';
const CORE = ROOT . '\\vendor\\core';
const LIBS = ROOT . '\\vendor\\core\\libs';
const CACHE = ROOT . '\\tmp\\cache';
const CONF = ROOT . '\\config';
const VIEW = APP . '\\views';
const ERROR_PAGE = VIEW . '\\errors\\404.php';
const LAYOUT = 'default';
const HTTP = 'http';
const NAME_WEBSITE = 'trans';

require_once dirname(__DIR__) . '\\vendor\\autoload.php';