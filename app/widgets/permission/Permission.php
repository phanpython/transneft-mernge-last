<?php

namespace widgets\permission;

use PDO;

class Permission
{
    protected $pdo;

    public function __construct($db) {
        $this->pdo = $db;
    }

    public function getPermission($permissionId = 0, $number = '', $userId = 0, $search = '', $dateStart = '', $dateEnd = '', $statusId = 0, $numPage = 0):array {
        $query = "SELECT * FROM get_permission(:permission_id, :number, :user_id, :search, :date_start, :date_end, :status_id, :num_page)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array('permission_id' => $permissionId, 'number' => $number, 'user_id' => $userId, 'search' => $search,
            'date_start' => $dateStart, 'date_end' => $dateEnd, 'status_id' => $statusId, 'num_page' => $numPage));
        $results = $stmt->fetchAll();

        if($results) {
            foreach ($results as &$result) {
                $arrNumbers = explode('/', $result['number']);
                $result['first_number'] = $arrNumbers[0];

                if(isset($arrNumbers[1])) {
                    $result['second_number'] = $arrNumbers[1];
                } else {
                    $result['second_number'] = $arrNumbers[0];
                }
            }
        } else {
            return [];
        }

        return $results;
    }

    public function setPermission($permissionId = 0, $number = '', $description = '', $addition = '', $subdivisionId = 0, $untypicalWork = '', $emergencyMinute = 0, $isEmergencyActivation = false):void {
        $query = "SELECT * FROM add_permission(:permission_id, :number, :description, :addition, :subdivision_id, :untypical_work, :emergency_minute, :is_emergency_activation)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':permission_id', $permissionId, PDO::PARAM_INT);
        $stmt->bindValue(':number', $number, PDO::PARAM_STR_CHAR);
        $stmt->bindValue(':description', $description, PDO::PARAM_STR);
        $stmt->bindValue(':addition', $addition, PDO::PARAM_STR);
        $stmt->bindValue(':subdivision_id', $subdivisionId, PDO::PARAM_INT);
        $stmt->bindValue(':untypical_work', $untypicalWork, PDO::PARAM_STR);
        $stmt->bindValue(':emergency_minute', $emergencyMinute, PDO::PARAM_INT);
        $stmt->bindValue(':is_emergency_activation', $isEmergencyActivation, PDO::PARAM_BOOL);
        $stmt->execute();

        $_SESSION['idCurrentPermission'] =  $stmt->fetch()['id'];
    }

    public function updatePermission($permissionId, $description, $addition, $number, $subdivisionId, $untypicalWork, $emergencyMinute = 0, $isEmergencyActivation = false, $periodStart = '', $periodEnd = ''):void {
        $number = strval($number);
        $query = "SELECT * FROM update_permission(:permission_id, :number, :description, :addition, :subdivision_id, :untypical_work, :emergency_minute, :is_emergency_activation, :period_start, :period_end)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':permission_id', $permissionId, PDO::PARAM_INT);
        $stmt->bindValue(':number', $number, PDO::PARAM_STR);
        $stmt->bindValue(':description', $description, PDO::PARAM_STR);
        $stmt->bindValue(':addition', $addition, PDO::PARAM_STR);
        $stmt->bindValue(':subdivision_id', $subdivisionId, PDO::PARAM_INT);
        $stmt->bindValue(':untypical_work', $untypicalWork, PDO::PARAM_STR);
        $stmt->bindValue(':emergency_minute', $emergencyMinute, PDO::PARAM_INT);
        $stmt->bindValue(':is_emergency_activation', $isEmergencyActivation, PDO::PARAM_BOOL);
        $stmt->bindValue(':period_start', $periodStart, PDO::PARAM_STR);
        $stmt->bindValue(':period_end', $periodEnd, PDO::PARAM_STR);
        $stmt->execute();
//        $stmt->execute(array('permission_id' => $permissionId, 'description' => $description, 'addition' => $addition,
//            'number' => $number, 'subdivision_id' => $subdivisionId, 'untypical_work' => $untypicalWork));
    }

    public function recoveryPermission($permissionId, $number, $description, $addition, $subdivisionId, $untypicalWork, $emergencyMinute = 0, $isEmergencyActivation = false):void {
        $query = "SELECT * FROM recovery_permission(:permission_id, :number, :description, :addition, :subdivision_id, :untypical_work, :emergency_minute, :is_emergency_activation)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':permission_id', $permissionId, PDO::PARAM_INT);
        $stmt->bindValue(':number', $number, PDO::PARAM_STR_CHAR);
        $stmt->bindValue(':description', $description, PDO::PARAM_STR);
        $stmt->bindValue(':addition', $addition, PDO::PARAM_STR);
        $stmt->bindValue(':subdivision_id', $subdivisionId, PDO::PARAM_INT);
        $stmt->bindValue(':untypical_work', $untypicalWork, PDO::PARAM_STR);
        $stmt->bindValue(':emergency_minute', $emergencyMinute, PDO::PARAM_INT);
        $stmt->bindValue(':is_emergency_activation', $isEmergencyActivation, PDO::PARAM_BOOL);
        $stmt->execute();
    }

    public function connectUserAndPermission($userId, $permissionId):void {
        $query = "SELECT * FROM connect_user_and_permission(:user_id, :permission_id)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array('user_id' => $userId, 'permission_id' => $permissionId));
    }

    public function delPermission($permissionId):void {
        $query = "SELECT * FROM del_permission(:permission_id)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array('permission_id' => $permissionId));
    }

    public function getProtectionsOfPermission($permissionId) {
        $query = "SELECT * FROM get_protections_of_permission(:permission_id)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array('permission_id' => $permissionId));
        return $stmt->fetchAll();
    }

    public function delMasksByPermissionId($protectionId, $entrance_exit, $type_locations, $locations, $vtor, $permissionId) {
        $query = "SELECT * FROM del_masks_by_permission_id(:protection_id, :entrance_exit, :type_locations, :locations, :vtor , :permission_id)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array('protection_id' => $protectionId, 'entrance_exit' => $entrance_exit, 'type_locations' => $type_locations, 'locations' => $locations, 'vtor' =>  $vtor,  'permission_id' => $permissionId));
    }
}