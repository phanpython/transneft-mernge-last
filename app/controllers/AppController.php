<?php

namespace controllers;

use core\base\Controller;
use core\DB;
use models\MainModel;

class AppController extends Controller
{
    protected function checkAuthorization() {
        if(!isset($_COOKIE['user']) || isset($_POST['exit'])) {
            if(isset($_POST['exit'])) {
                $this->exitFromProfile();
            }
            header('Location: http://trans');
            die();
        }
    }

    protected function prepareVars($arr) {
        foreach ($arr as $key=>$value) {
            $arr[$key] = htmlspecialchars(trim($value));
        }

        return $arr;
    }

    protected function exitFromProfile() {
        $model = new MainModel();
        $db = DB::getMainDB();
        $model->setLog('вышел из системы', $_COOKIE['user'], $db);
        setcookie('user', '', 0, '/');
    }
}