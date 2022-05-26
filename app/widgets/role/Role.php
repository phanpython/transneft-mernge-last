<?php

namespace widgets\role;

use widgets\permission\Permission;

class Role
{
    protected $pdo;
    protected $roles;
    protected $permission;

    public function __construct($db) {
        $this->pdo = $db;
        $this->permission = new Permission($db);

        $this->roles['isAdmin'] = false;
        $this->roles['isAuthor'] = false;
        $this->roles['isDispatcher'] = false;
        $this->roles['isReplacementEngineer'] = false;
        $this->roles['isInspectingEngineer'] = false;
    }

    public function getRoles($userId = 0):array {
        $query = "SELECT * FROM get_roles(:user_id)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array('user_id' => $userId));
        $arr = $stmt->fetchAll();

        foreach ($arr as $item) {
            if($item['name'] === 'Администратор') {
                $this->roles['isAdmin'] = true;
            } elseif($this->checkAuthor($item['name'])) {
                $this->roles['isAuthor'] = true;
            } elseif($item['name'] === 'Диспетчер') {
                $this->roles['isDispatcher'] = true;
            } elseif($item['name'] === 'Сменный инженер'){
                $this->roles['isReplacementEngineer'] = true;
            } elseif($item['name'] === 'Проверяющий инженер'){
                $this->roles['isInspectingEngineer'] = true;
            }
        }

        return $this->roles;
    }

    protected function checkAuthor($role):bool {
        if($role !== 'Автор') {
            return false;
        }

        if(stripos($_SERVER['REQUEST_URI'], 'permission/add')) {
            $permissions = $this->permission->getPermission($_SESSION['idCurrentPermission'],'', $_COOKIE['user']);

            if(count($permissions) > 0) {
                return true;
            }
        }

        if($role == 'Автор') {
            return true;
        }

        return false;
    }
}