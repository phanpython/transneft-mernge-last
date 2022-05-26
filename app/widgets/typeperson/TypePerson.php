<?php

namespace widgets\typeperson;

class TypePerson
{
    protected $pdo;

    public function __construct($db) {
        $this->pdo = $db;
    }

    public function getTypePerson($typePersonId) {
        $query = "SELECT * FROM get_type_person(:type_person_id)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array('type_person_id' => $typePersonId));

        return $stmt->fetch();
    }
}