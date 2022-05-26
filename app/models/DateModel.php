<?php

namespace models;

use core\DB;
use widgets\date\Date;
use widgets\permission\Permission;

class DateModel extends AppModel
{
    protected $date;
    protected $permission;
    protected $db;

    public function __construct() {
        $this->db = DB::getMainDB();
        $this->date = new Date($this->db);
        $this->permission = new Permission($this->db);
    }

    public function setDates() {
        $this->date->delDates($_SESSION['idCurrentPermission']);
        $counter = 0;

        while (isset($_POST['date-' . $counter + 1])) {
            $counter++;
            $this->date->setDate($_POST['date-' . $counter], $_POST['from-time-' . $counter], $_POST['to-time-' . $counter], $_SESSION['idCurrentPermission']);
        }

        $permission = $this->permission->getPermission($_SESSION['idCurrentPermission'])[0];
        $this->permission->updatePermission($permission['id'], $permission['description'], $permission['addition'],
            $permission['number'], $permission['subdivision_id'], $permission['untypical_work'],
            $permission['emergency_minute'], $permission['is_emergency_activation'],
            '', '');

        $this->redirect('permission', 'add');
    }

    public function getIndexVarsToTwig():array {
        return ['dates' => $this->date->getDates($_SESSION['idCurrentPermission']),
            'user_fio' => $this->getUserFio($this->db)];
    }
}