<?php

namespace widgets\status;

class Status
{
    protected $pdo;

    public function __construct($db) {
        $this->pdo = $db;
    }

    public function getStatuses($statusId = 0) {
        $query = "SELECT * FROM get_status(:status_id)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['status_id' => $statusId]);;
        return $stmt->fetchAll();
    }
}