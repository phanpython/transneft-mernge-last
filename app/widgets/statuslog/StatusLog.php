<?php

namespace widgets\statuslog;

class StatusLog
{
    protected $pdo;

    public function __construct($db) {
        $this->pdo = $db;
    }

    public function addStatusManagementLog($permissionId = 0, $statusId = 0, $userId = 0, $comment = '', $dateChangeStatus = '', $date = ''):void {
        if($dateChangeStatus === '') {
            $dateChangeStatus = date('d.m.Y H:i:s');
        }
        if($date === '') {
            $date = date('d.m.Y H:i:s');
        }

        $query = "SELECT * FROM add_status_management_log(:permission_id, :status_id, :user_id, :comment, :date_change_status, :date)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array('permission_id' => $permissionId, 'status_id' => $statusId, 'user_id' => $userId,
                             'comment' => $comment, 'date_change_status' => $dateChangeStatus, 'date' => $date));
    }

    public function getStatusManagementLogs($permissionId = 0, $typeStatusId = 0):array {
        $query = "SELECT * FROM get_status_management_log(:permission_id, :type_status_id)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array('permission_id' => $permissionId, 'type_status_id' => $typeStatusId));

        $result = $stmt->fetchAll();

        foreach ($result as &$item) {
            $item['date'] = date("d.m.Y H:i:s", strtotime($item['date']));
        }

        return $result;
    }

    public function delStatusManagementLogs($permissionId) {
        $query = "SELECT * FROM del_status_management_log(:permission_id)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array('permission_id' => $permissionId));
    }
}