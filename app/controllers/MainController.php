<?php

namespace controllers;

use core\base\Model;
use core\Twig;
use widgets\authorization\Authorization;
use widgets\department\Department;
use widgets\registration\Registration;
use widgets\subdivision\Subdivision;
use models\MainModel;

class MainController extends AppController
{
    protected $model;

    public function indexAction() {
        if(isset($_COOKIE['user'])) {
            header('Location: http://trans/permission');
            die();
        }
        $isAjax = false;

        $this->setMeta('Главная');
        $this->model =  new MainModel();
        if(isset($_REQUEST['id_for_sub'])) {
            $this->model->getSubdivision($_REQUEST['id_for_sub']);
            $isAjax = true;
        } elseif(isset($_POST['registration'])) {
            $email = trim(htmlspecialchars($_POST['email']));
            $password = trim(htmlspecialchars($_POST['password']));
            $this->model->addUser($_POST['name'], $_POST['lastname'], $_POST['patronymic'], $email, $password, $_POST['subdivision_id'],
                                  $_POST['position'], $_POST['mobile'], $_POST['mats'], $_POST['gats'], $_POST['dect']);
        } elseif(isset($_POST['authorization'])) {
            list($email, $password) = $this->prepareVars([$_POST['email'], $_POST['password']]);
            $rememberMe = false;

            if(isset($_POST['remember_me'])) {
                $rememberMe = true;
            }

            $this->model->setCurrentUser($email, $password, $rememberMe);
        }

        $this->setIndexVarsToTwig($isAjax);
    }

    protected function setIndexVarsToTwig($isAjax) {
        $arr = $this->model->getIndexArrForTwig($isAjax);
        Twig::addVarsToArrayOfRender($arr);
    }
}