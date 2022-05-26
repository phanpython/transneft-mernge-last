<?php

namespace models;

use core\DB;
use widgets\statuslog\StatusLog;

class StoryModel extends AppModel
{
    protected $statusLog;
    protected $db;

    public function __construct() {
        if(isset($_SESSION['archive-permissions'])) {
            $this->db = DB::getArchiveDB();
        } else {
            $this->db = DB::getMainDB();
        }

        $this->statusLog = new StatusLog($this->db);
    }

    public function setCurrentLogs($permissionId) {
        $_SESSION['permissionIdLog'] = $permissionId;
        $this->redirect('story');
    }

    public function getLogs():array {
        $result = [];

        if(isset($_SESSION['permissionIdLog'])) {
            $result = $this->statusLog->getStatusManagementLogs($_SESSION['permissionIdLog']);
        }

        return $result;
    }

    public function getIndexVarsToTwig() {
        $logs = $this->getLogs();

        if(!isset($logs[0]['status_management_log_id'])) {
            $this->redirect('permission');
        }

        return ['logs' => $this->getLogs(),
            'user_fio' => $this->getUserFio($this->db)];
    }
}