<?php

namespace widgets\employee;

class Employee
{
    protected $pdo;

    public function __construct($db) {
        $this->pdo = $db;
    }

    public function addEmployee($idEmployee, $idPermission, $idTypeResponsible) {
        $query = "SELECT * FROM add_employee(:id_employee, :id_permission, :id_type_responsible)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array('id_employee' => $idEmployee, 'id_permission' => $idPermission, 'id_type_responsible' => $idTypeResponsible));
    }

    public function delEmployee($idEmployee, $idPermission, $idTypeResponsible) {
        $query = "SELECT * FROM del_employee(:id_employee, :id_permission, :id_type_responsible)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array('id_employee' => $idEmployee, 'id_permission' => $idPermission, 'id_type_responsible' => $idTypeResponsible));
    }

    public function getEmployee($typePersonId, $permissionId = 0, $userId = 0) {
        $query = "SELECT * FROM get_employee(:type_person_id, :permission_id, :user_id)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array('type_person_id' => $typePersonId, 'permission_id' => $permissionId, 'user_id' => $userId));

        return $stmt->fetchAll();
    }
}