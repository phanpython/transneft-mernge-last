<?php

namespace controllers;

use models\RoleModel;

class RoleController extends AppController
{
    private $model;

    public function indexAction() {
        $this->checkAuthorization();
        $this->setMeta('Разрешения');
        $this->model = new RoleModel();
    }
}