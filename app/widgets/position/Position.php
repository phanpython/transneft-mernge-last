<?php

namespace widgets\position;

class Position
{
    private $pdo;

    public function __construct($db) {
        $this->pdo = $db;
    }

    public function getPosition($name = ''):array {
        $query = "SELECT * FROM get_position(:name)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array('name' => $name));

        return $stmt->fetchAll();
    }
}