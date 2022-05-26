<?php

namespace widgets\date;

class Date
{
    protected $pdo;

    public function __construct($db) {
        $this->pdo = $db;
    }

    public function getDates($permissionId = 0, $userId = 0) {
        $query = "SELECT * FROM get_dates(:permission_id, :user_id)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array('permission_id' => $permissionId, 'user_id' => $userId));

        return $stmt->fetchAll();
    }

    public function setDate($date, $fromTime, $toTime, $permissionId) {
        $query = "SELECT * FROM add_date(:date, :from_time, :to_time, :permission_id)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array('date' => $date, 'from_time' => $fromTime, 'to_time' => $toTime, 'permission_id' => $permissionId));
    }

    public function delDates($permissionId) {
        $query = "SELECT * FROM del_dates(:permission_id)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array('permission_id' => $permissionId));
    }
}