<?php

namespace widgets\user;

class User
{
    private $pdo;

    public function __construct($db) {
        $this->pdo = $db;
    }

    public function getUsers($userId = 0, $email= '', $roleId = 0, $subdivisionId = 0, $search = '', $positionId = 0):array {
        if($search !== '') {
            $search = '%' . htmlspecialchars(trim($search)) . '%';
        }

        $query = "SELECT * FROM get_users(:user_id, :email, :role_id, :subdivision_id, :search, :position_id)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array('user_id' => $userId, 'email' => $email, 'role_id' => $roleId,
                        'subdivision_id' => $subdivisionId, 'search' => $search, 'position_id' => $positionId));

        return $stmt->fetchAll();
    }

    public function addUser($id = 0, $name = '', $lastname = '', $patronymic = '', $email = '', $password = '', $subdivisionId = 0, $positionId = 0, $mobile = '', $mats = '', $gats = '', $dect = '') {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "SELECT * FROM add_user(:id, :name, :lastname, :patronymic, :email, :password, :subdivision_id,
                                         :position_id, :mobile, :mats, :gats, :dect)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array('id' => $id, 'name' => $name, 'lastname' => $lastname, 'patronymic' => $patronymic,
            'email' => $email, 'password' => $password, 'subdivision_id' => $subdivisionId,
            'position_id' => $positionId, 'mobile' => $mobile, 'mats' => $mats, 'gats' => $gats, 'dect' => $dect));
        return $stmt->fetch()['id'];
    }
}