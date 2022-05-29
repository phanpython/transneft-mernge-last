<?php

namespace controllers;

use core\Twig;
use models\MaskAddModel;

/* Дима */

class MaskAddController extends AppController
{
    private $model;

    
    public function indexAction() {
        $this->checkAuthorization();

        $this->setMeta('Выбор системы');
        $this->model = new MaskAddModel();

        

        if(isset($_REQUEST['select_value'])){
            echo print_r($_REQUEST['select_value']);
            echo print_r('Нет');
        }

    }

    public function addtuAction() {
        $this->checkAuthorization();
        $this->setMeta('Добавление защит на ТУ');
        $this->model = new MaskAddModel();

        $this->setAddtuVarsToTwig();
    }

    public function addnpsAction() {
        $this->checkAuthorization();
        $this->setMeta('Добавление защит на НПС');
        $this->model = new MaskAddModel();

        $isAjax = false;

        if(isset($_REQUEST['id_for_object'])) {
            /*  $this->model->getSubdivision($_REQUEST['id_for_sub']); */
             $this->model->getObject($_REQUEST['id_for_object']);
             $isAjax = true;
         }
         
        

        if(isset($_REQUEST['select_value'])){
            echo print_r($_REQUEST['select_value']);
            echo print_r('Нет');
        }

        $this->setAddnpsVarsToTwig($isAjax);
    }

    public function addluAction() {
        $this->checkAuthorization();
        $this->setMeta('Добавление защит на ЛУ');
        $this->model = new MaskAddModel();

        $this->setAddluVarsToTwig();
    }

    public function setAddtuVarsToTwig() {
        $arr = $this->model->getAddtuVarsToTwig();
        Twig::addVarsToArrayOfRender($arr);
    }

    public function setAddnpsVarsToTwig($isAjax) {
        $arr = $this->model->getAddnpsVarsToTwig($isAjax);
        Twig::addVarsToArrayOfRender($arr);
    }

    
    public function setAddluVarsToTwig() {
        $arr = $this->model->getAddluVarsToTwig();
        Twig::addVarsToArrayOfRender($arr);
    }

    public function setIndexVarsToTwig(){
        $arr = $this->model->getIndexVarsToTwig();
        Twig::addVarsToArrayOfRender($arr);
    }
}

/* Дима */