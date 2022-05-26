<?php

namespace models;

use core\DB;
use widgets\position\Position;
use widgets\subdivision\Subdivision;
use widgets\user\User;

class MainModel extends AppModel
{
    private $subdivision;
    private $position;
    private $user;
    private $db;

    public function __construct()
    {
        $this->db = DB::getMainDB();
        $this->subdivision = new Subdivision($this->db);
        $this->position = new Position($this->db);
        $this->user = new User($this->db);
    }

    public function getSubdivision($subdivisionId) {
        $currentSubdivisions = $this->subdivision->getSubdivision(0, $subdivisionId);

        foreach ($currentSubdivisions as &$currentSubdivision) {
            $subdivisions = $this->subdivision->getSubdivision(0, $currentSubdivision['id']);

            if(count($subdivisions) > 0) {
                $currentSubdivision['flag'] = true;
            }
        }

        header('Content-Type: application/json');
        echo json_encode($currentSubdivisions, JSON_UNESCAPED_UNICODE);
    }

    public function addUser($name, $lastname, $patronymic, $email, $password, $subdivisionId, $position, $mobile, $mats, $gats, $dect) {
        if($this->issetEmail($email)) {
            $message = 'Пользователь с данным email уже зарегестрирован в системе!';
            $this->saveDataOfRegistration($message, $name, $lastname, $patronymic, $email, $password, $subdivisionId, $position,  $mobile, $mats, $gats, $dect);
        } else {
            if(isset($_SESSION['error-reg'])) {
                $this->delSessionsOfRegistration();
            }
            $archiveUser = new User(DB::getArchiveDB());
            $positionId = $this->position->getPosition($position)[0]['id'];
            $userId = $this->user->addUser(0, $name, $lastname, $patronymic, $email, $password, $subdivisionId, $positionId, $mobile, $mats, $gats, $dect);
            $archiveUser->addUser($userId, $name, $lastname, $patronymic, $email, $password, $subdivisionId, $positionId, $mobile, $mats, $gats, $dect);
            $_SESSION['registration-success'] = true;
        }
        $this->redirect('main');
    }

    public function saveDataOfRegistration($message, $name, $lastname, $patronymic, $email,$password, $subdivisionId, $position, $mobile, $mats, $gats, $dect) {
        $_SESSION['error-reg'] = $message;
        $_SESSION['name'] = $name;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['patronymic'] = $patronymic;
        $_SESSION['email'] = $email;
        $_SESSION['mobile'] = $mobile;
        $_SESSION['mats'] = $mats;
        $_SESSION['gats'] = $gats;
        $_SESSION['dect'] = $dect;
        $_SESSION['position'] = $position;
        $_SESSION['subdivision_id'] = $subdivisionId;
        $_SESSION['password'] = $password;
        $_SESSION['subdivision_name'] = $this->subdivision->getSubdivision($subdivisionId)[0]['name'];
    }

    protected function delSessionsOfRegistration() {
        unset($_SESSION['error-reg']);
        unset($_SESSION['name']);
        unset($_SESSION['lastname']);
        unset($_SESSION['patronymic']);
        unset($_SESSION['email']);
        unset($_SESSION['password']);
        unset($_SESSION['subdivision_id']);
        unset($_SESSION['position']);
        unset($_SESSION['mobile']);
        unset($_SESSION['mats']);
        unset($_SESSION['gats']);
        unset($_SESSION['dect']);
        unset($_SESSION['subdivision_name']);
    }

    protected function delSessionsOfAuthorization() {
        unset($_SESSION['email']);
        unset($_SESSION['password']);
        unset($_SESSION['authorization_error']);

        if(isset($_SESSION['remember_me'])) {
            unset($_SESSION['remember_me']);
        }
    }

    public function issetEmail($email) {
        if($this->user->getUsers(0, $email)) {
            return true;
        }

        return false;
    }

    public function saveDataOfAuthorization($email, $password, $message, $rememberMe) {
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        $_SESSION['authorization_error'] = $message;

        if($rememberMe) {
            $_SESSION['remember_me'] = 'checked';
        }
    }

    public function getSessionsForAuthorization() {
        $result = [];

        $result['email'] = $_SESSION['email'];
        $result['password'] = $_SESSION['password'];
        $result['error'] = $_SESSION['authorization_error'];

        if(isset($_SESSION['remember_me'])) {
            $result['remember_me'] = $_SESSION['remember_me'];
        }

        return $result;
    }

    public function setCurrentUser($email = '', $password = '', $rememberMe = false) {
        $user = $this->user->getUsers(0, $email, 0, 0, '', 0);

        if(isset($user[0]['password'])) {
            if (password_verify($password, $user[0]['password'])) {

                setcookie('user', $user[0]['user_id'], time() + 3600 * 8);

                $this->delSessionsOfAuthorization();
                $this->setLog('авторизовался в системе', $user[0]['user_id'], $this->db);
                $this->redirect('permission');
            }
        }

        $this->saveDataOfAuthorization($email, $password, 'Неверно введен логин или пароль!', $rememberMe);
        $this->redirect('main');
    }

    public function getSessionsForRegistration() {
        $result = [];

        $result['error'] = $_SESSION['error-reg'];
        $result['name'] = $_SESSION['name'];
        $result['lastname'] = $_SESSION['lastname'];
        $result['patronymic'] = $_SESSION['patronymic'];
        $result['email'] = $_SESSION['email'];
        $result['mobile'] = $_SESSION['mobile'];
        $result['mats'] = $_SESSION['mats'];
        $result['gats'] = $_SESSION['gats'];
        $result['dect'] = $_SESSION['dect'];
        $result['position'] = $_SESSION['position'];
        $result['subdivisionId'] = $_SESSION['subdivision_id'];
        $result['subdivisionName']  = $_SESSION['subdivision_name'];
        $result['password'] = $_SESSION['password'];

        return $result;
    }

    public function getIndexArrForTwig($isAjax):array {
        $result = [];

        if($isAjax) {
            $result =  ['ajax' => true];
        } else {
            if(isset($_SESSION['error-reg'])) {
                $result['registration'] = $this->getSessionsForRegistration();
                $result['regActive'] = 'true';
            } elseif(isset($_SESSION['registration-success'])) {
                $result['registrationSuccess'] = $_SESSION['registration-success'];
                unset($_SESSION['registration-success']);
            } elseif(isset($_SESSION['authorization_error'])) {
                $result['authorization'] = $this->getSessionsForAuthorization();
            }

            $result['positions'] = $this->position->getPosition();
            $result['subdivisions'] = $this->subdivision->getSubdivision();
        }

        return $result;
    }
}