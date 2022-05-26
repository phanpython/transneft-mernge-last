<?php

namespace models;

use widgets\user\User;

class AppModel
{
    public function redirect($controller, $event = '') {
        $location = 'Location: ' . HTTP . '://' . '/' . NAME_WEBSITE . '/' . $controller . '/' . $event;
        header($location);
        die();
    }

    protected function getUserFio($db):string {
        $user = new User($db);
        $currentUser = $user->getUsers($_COOKIE['user'])[0];
        return $currentUser['lastname'] . ' ' . mb_substr($currentUser['name'], 0, 1) . '.' . mb_substr($currentUser['patronymic'], 0, 1) . '.';
    }

    public function setLog($event, $userId, $db, $numPermission = '', $addition = '') {
        $objectUser = new User($db);
        $fileName = ROOT . '/tmp/logs.log';
        $date = date("Y.m.d H:i:s");
        $user = $objectUser->getUsers($userId)[0];
        $current = "$date {$user['lastname']} {$user['name']} {$user['patronymic']} $event $numPermission $addition\n";
        file_put_contents($fileName, $current, FILE_APPEND);
    }
}