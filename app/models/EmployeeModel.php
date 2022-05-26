<?php

namespace models;

use core\DB;
use widgets\employee\Employee;
use widgets\subdivision\Subdivision;
use widgets\typeperson\TypePerson;
use widgets\user\User;

class EmployeeModel extends AppModel
{
    protected $employee;
    protected $subdivision;
    protected $user;
    protected $typePerson;
    protected $db;

    public function __construct() {
        $this->db = DB::getMainDB();
        $this->employee = new Employee($this->db);
        $this->subdivision = new Subdivision($this->db);
        $this->user = new User($this->db);
        $this->typePerson = new TypePerson($this->db);
    }

    public function setCurrentTypePerson($idTypePerson) {
        $_SESSION['current_type_person'] = $idTypePerson;
        $this->redirect('employee', '');
    }

    public function getIndexVarsToTwig($isAjax):array {
        $result = [];

        if($isAjax) {
            $result =  ['ajax' => true];
        } else {
            $result['subdivisions'] = $this->subdivision->getSubdivision();
            $result['type_person'] = $this->typePerson->getTypePerson($_SESSION['current_type_person']);
            $result['current_responsibles'] = $this->employee->getEmployee($_SESSION['current_type_person'],  $_SESSION['idCurrentPermission']);
            $result['user_fio'] = $this->getUserFio($this->db);
        }

        return $result;
    }

    public function getUser($id) {
        $responsibles = $this->user->getUsers(0, '', 1, $id,  '');

        header('Content-Type: application/json');
        echo json_encode($responsibles, JSON_UNESCAPED_UNICODE);
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

    public function saveResponsibles($str = '') {
        $keys = explode(' ', $str);

        $this->employee->delEmployee(0, $_SESSION['idCurrentPermission'], $_SESSION['current_type_person']);

        foreach ($keys as $key) {
            $this->employee->addEmployee($key, $_SESSION['idCurrentPermission'], $_SESSION['current_type_person']);
        }

        $this->redirect('permission', 'add');
    }

    public function searchResponsible($search) {
        $responsibles = $this->user->getUsers(0, '',2, 0,   $search);
        $currentResponsibles = $this->employee->getEmployee(0, $_SESSION['idCurrentPermission']);
        foreach ($responsibles as &$responsible) {
            $fl = false;

            foreach ($currentResponsibles as $currentResponsible) {
                if($responsible['user_id'] === $currentResponsible['user_id']) {
                    $fl = true;
                }
            }

            $responsible['fl'] = $fl;
        }

        header('Content-Type: application/json');
        echo json_encode($responsibles, JSON_UNESCAPED_UNICODE);
    }

    protected function checkChildrenSubdivision($subdivisions, $subdivisionId):bool {
        foreach ($subdivisions as $subdivision) {
            if($subdivision['parent_id'] === $subdivisionId) {
                return true;
            }
        }

        return false;
    }

    protected function processSearch($str) {
        $str = trim($str);
        $result = '';
        $prevChar = '';

        for($i = 0; $i < mb_strlen($str); $i++) {
            $char = mb_substr($str, $i, 1);

            if($char !== ' ' || $prevChar !== ' ') {
                $result .= $char;
                $prevChar = $char;
            }
        }

        return $result;
    }
}