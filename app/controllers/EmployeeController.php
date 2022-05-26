<?php

namespace controllers;

use core\Twig;
use models\EmployeeModel;

class EmployeeController extends AppController
{
    private $model;

    public function indexAction() {
        $this->checkAuthorization();
        $this->setMeta('Ответственные');
        $this->model = new EmployeeModel();
        $isAjax = true;

        if(isset($_POST['add-responsible'])) {
            $this->model->setCurrentTypePerson($_POST['id_type_person']);
        } elseif(isset($_REQUEST['search_responsible'])) {
            $this->model->searchResponsible($_REQUEST['search_responsible']);
        } elseif(isset($_REQUEST['id_for_sub'])) {
            $this->model->getSubdivision($_REQUEST['id_for_sub']);
        } elseif(isset($_REQUEST['id_for_user'])) {
            $this->model->getUser($_REQUEST['id_for_user']);
        } elseif(isset($_POST['keys-responsibles'])) {
            $this->model->saveResponsibles($_POST['keys-responsibles']);
        } else {
            $isAjax = false;
        }

        $this->setIndexVarsToTwig($isAjax);
    }

    public function setIndexVarsToTwig($isAjax) {
        $arr = $this->model->getIndexVarsToTwig($isAjax);
        Twig::addVarsToArrayOfRender($arr);
    }
}