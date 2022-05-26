<?php

namespace controllers;

use core\Twig;
use models\StoryModel;

class StoryController extends AppController
{
    private $model;

    public function indexAction() {
        $this->checkAuthorization();
        $this->setMeta('Разрешения');
        $this->model = new StoryModel();

        if(isset($_POST['story'])) {
            $this->model->setCurrentLogs($_POST['id']);
        }

        $this->setIndexVarsToTwig();
    }

    public function setIndexVarsToTwig(){
        $arr = $this->model->getIndexVarsToTwig();
        Twig::addVarsToArrayOfRender($arr);
    }
}