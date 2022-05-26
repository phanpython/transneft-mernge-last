<?php

namespace widgets\typicalwork;

class TypicalWork
{
    protected $pdo;

    public function __construct($db) {
        $this->pdo = $db;
    }

    public function getTypicalWork($permissionId = 0, $userId = 0, $flag = 0) {
        $query = "SELECT * FROM get_typical_work(:permission_id, :user_id, :flag)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array('permission_id' => $permissionId, 'user_id' => $userId, 'flag' => $flag));

        return $stmt->fetchAll();
    }


    public function delTypicalWork($permissionId = 0, $typicalWorkId = 0) {
        $query = "SELECT * FROM del_typical_work(:permission_id, :typical_work_id)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array('permission_id' =>$permissionId, 'typical_work_id' => $typicalWorkId));
    }

    public function setTypicalWorks($permissionId = 0, $typicalWorkId = 0, $description = '') {
        $query = "SELECT * FROM add_typical_work(:permission_id, :typical_work_id, :description)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array('permission_id' => $permissionId, 'typical_work_id' => $typicalWorkId, 'description' => $description));
    }
}