<?php

namespace core;

class ErrorsHandler
{
    public function __construct() {
        if(DEBUG) {
            error_reporting(E_ALL);
        } else {
            error_reporting(0);
        }

        set_exception_handler([$this, 'exceptionsHandler']);
        set_error_handler([$this, 'errorsHandler']);
        register_shutdown_function([$this, 'fatalErrorsHandler']);
    }

    public function exceptionsHandler($e) {
        $this->logErrors($e->getMessage(), $e->getFile(), $e->getLine());
        $this->printError($e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

    public function errorsHandler($num, $message, $file, $line) {
        $this->logErrors($message, $file, $line);
        $this->printError($message, $file, $line, $num);
    }

    protected function logErrors($message, $file, $line) {
        $date = date('Y-m-d H:i:s');
        error_log("[{$date}] Сообщение: $message; Файл: $file; Линия: $line \n ===================== \n", 3, ROOT . '/tmp/errors.log');
    }

    public function fatalErrorsHandler() {
        if(!empty($error = error_get_last()) && $error['type'] & (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR)) {
            ob_get_clean();
            $this->logErrors($error['message'], $error['file'], $error['line']);
            $this->printError($error['message'], $error['file'], $error['line'], $error['type']);
        }
    }

    protected function printError($message, $file, $line, $code) {
        if($code === 404 && !DEBUG) {
            require_once WWW . "/errors/404.php";
        } elseif(DEBUG) {
            require_once WWW . "/errors/dev.php";
        } else {
            require_once WWW . "/errors/prod.php";
        }

        die();
    }
}