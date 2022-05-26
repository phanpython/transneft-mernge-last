<?php

namespace controllers;

use core\Twig;
use models\TypeWorkModel;

class TypeWorkController extends AppController
{
    private $model;

    public function indexAction() {
        $this->checkAuthorization();
        $this->setMeta('Типы работ');
        $this->model = new TypeWorkModel();

        if(isset($_POST['types_works'])) {
            $this->model->delTypicalWork();
        } elseif(isset($_POST['update-types-works'])) {
            $typesWorksId = explode(' ', $_POST['array_types_works']);
            $descriptionsTypesWorks = [];

            foreach ($typesWorksId as $id) {
                if(isset($_POST['typical-work__textarea-' . $id])) {
                    $descriptionsTypesWorks[] = $_POST['typical-work__textarea-' . $id];
                }
            }

            $this->model->updateTypesWorks($_POST['untypical_works'], $typesWorksId, $descriptionsTypesWorks);
        }

        $this->setIndexVarsToTwig();
    }

    protected function setIndexVarsToTwig() {
        $arr = $this->model->getIndexArrForTwig();
        Twig::addVarsToArrayOfRender($arr);
    }
}