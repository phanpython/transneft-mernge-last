<?php

namespace models;

use core\DB;
use Fpdf\Fpdf;
use widgets\date\Date;
use widgets\pagination\Pagination;
use widgets\pdf\PDF;
use widgets\permission\Permission;
use widgets\employee\Employee;
use widgets\protection\Protection;
use widgets\role\Role;
use widgets\scv\SCV;
use widgets\status\Status;
use widgets\statuslog\StatusLog;
use widgets\typicalwork\TypicalWork;
use widgets\user\User;

class PermissionModel extends AppModel
{
    protected $typicalWork;
    protected $permission;
    protected $date;
    protected $user;
    protected $role;
    protected $employee;
    protected $statusLog;
    protected $status;
    protected $pagination;
    protected $protection;
    protected $db;

    public function __construct() {
        if(isset($_SESSION['archive-permissions']) && strpos($_SERVER['REDIRECT_QUERY_STRING'], 'add') === false) {
            $this->db = DB::getArchiveDB();
        } else {
            $this->db = DB::getMainDB();
        }

        $this->employee = new Employee($this->db);
        $this->permission = new Permission($this->db);
        $this->typicalWork = new TypicalWork($this->db);
        $this->date = new Date($this->db);
        $this->user = new User($this->db);
        $this->role = new Role($this->db);
        $this->statusLog = new StatusLog($this->db);
        $this->status = new Status($this->db);
        $this->pagination = new Pagination($this->db);
        $this->protection = new Protection($this->db);


        if (isset($_POST["del-masks"])){
            
            for($i = 1; $i < 1000; $i++) {
                if (isset($_POST["protection_id-$i"])){
                    $this->permission->delMasksByPermissionId($_POST['protection_id-' . $i], $_POST['entrance_exit-' . $i], $_POST['type_location-' . $i], $_POST['location-' . $i], '', $_SESSION['idCurrentPermission']);
                }
            }
        }

        if(isset($_POST['activemasking-permission'])){
            $this->protection->delMasksFromPermission($_POST['id']);
        }
        if (isset($_POST['masking-submit'])){
            for($i = 1; $i < 1000; $i++) {
                if (isset($_POST["masking-$i"])){
                    
                    $this->protection->addMaskingStatuses($_POST['id'], $_POST['protection-' . $i], $_POST["masking-$i"]);
                }
                if (isset($_POST["unmasking-$i"])){
                    $this->protection->addMaskingStatuses($_POST['id'], $_POST['protection-' . $i],  '', $_POST["unmasking-$i"]);
                }
                if (isset($_POST["check_masking-$i"])){
                    $this->protection->addMaskingStatuses($_POST['id'], $_POST['protection-' . $i],  '', '', $_POST["check_masking-$i"]);
                }
                if (isset($_POST["check_unmasking-$i"])){
                    $this->protection->addMaskingStatuses($_POST['id'], $_POST['protection-' . $i],  '', '', '', $_POST["check_unmasking-$i"]);
                }
            }
        }
    }

    public function addStatusOfPermission($permissionId = 0, $idStatus = 0, $comment = '', $date = '', $time = '') {
        $comment = htmlspecialchars(trim($comment));

        if($date !== '') {
            $date = $date . ' ' .$time;
        }

        $nameStatus = $this->status->getStatuses($idStatus)[0]['name'];
        $this->statusLog->addStatusManagementLog($permissionId, $idStatus, $_COOKIE['user'], $comment, $date);

        $this->setLog('изменил статус разрешения', $_COOKIE['user'], $this->db, "№ $permissionId", "на '$nameStatus'");

        $this->redirect('permission', '');
    }

    public function updatePermission($description, $addition, $countMinutes, $idEmergencyActivation) {
        $permission = $this->permission->getPermission($_SESSION['idCurrentPermission'])[0];
        $this->permission->updatePermission($permission['id'], $description, $addition,
                                            $permission['number'], $permission['subdivision_id'], $permission['untypical_work'],
                                            $countMinutes, $idEmergencyActivation);

        $this->redirect('permission', 'add');
    }

    public function updateNumber($firstNumber, $secondNumber) {
        $number = $firstNumber . '/' . $secondNumber;
        $permission = $this->permission->getPermission($_SESSION['idCurrentPermission'])[0];
        $this->permission->updatePermission($permission['id'], $permission['description'], $permission['addition'],
            $number, $permission['subdivision_id'], $permission['untypical_work']);

        $this->redirect('permission', 'add');
    }

    public function createPermission() {
        $subdivision = $this->user->getUsers($_COOKIE['user'], '', 2, 0)[0]['subdivision_id'];
        $this->permission->setPermission(0, '', '', '', $subdivision);
        $this->permission->connectUserAndPermission($_COOKIE['user'], $_SESSION['idCurrentPermission']);
        $this->statusLog->addStatusManagementLog($_SESSION['idCurrentPermission'], 1, $_COOKIE['user'], '');
        $supervisor = $this->user->getUsers(0, '', 2, $subdivision, '', 1);

        if(isset($supervisor[0])) {
            $supervisorId = $supervisor[0]['user_id'];
            $this->employee->addEmployee($supervisorId, $_SESSION['idCurrentPermission'], 5);
        }

        $this->setLog('создал разрешение', $_COOKIE['user'], $this->db, "№{$_SESSION['idCurrentPermission']}");
        $this->redirect('permission', 'add');
    }

    public function delPermission($permissionId) {
        $this->permission->delPermission($permissionId);
        $this->setLog('удалил разрешение', $_COOKIE['user'], $this->db, "№$permissionId");
        $this->redirect('permission', '');
    }

    public function editPermission($permissionId) {
        $_SESSION['idCurrentPermission'] = $permissionId;
        $this->redirect('permission', 'add');
    }

    public function createPermissionById($permissionId) {
        $db = DB::getMainDB();
        $objectStatusLog = new StatusLog($db);
        $objectEmployee = new Employee($db);
        $objectDate = new Date($db);
        $objectTypicalWork = new TypicalWork($db);
        $objectPermission = new Permission($db);
        $objectProtection = new Protection($db);

        $permission = $this->permission->getPermission($permissionId)[0];
        $objectPermission->setPermission(0, '', $permission['description'], $permission['addition'], $permission['subdivision_id'], $permission['untypical_work']);
        $dates = $this->date->getDates($permissionId);
        $objectStatusLog->addStatusManagementLog($_SESSION['idCurrentPermission'], 1, $_COOKIE['user'], '');
        $employees = $this->employee->getEmployee(0, $permissionId);
        $typicalWorks = $this->typicalWork->getTypicalWork($permissionId, $_COOKIE['user']);
        $protections = $this->protection->getMaskingProtections($permissionId);

        foreach ($typicalWorks as $typicalWork) {
            $objectTypicalWork->setTypicalWorks($_SESSION['idCurrentPermission'], $typicalWork['typical_work_id'], $typicalWork['description']);
        }

        foreach ($dates as $date) {
            $objectDate->setDate($date['date'], $date['from_time'], $date['to_time'], $_SESSION['idCurrentPermission']);
        }

        foreach ($employees as $employee) {
            $objectEmployee->addEmployee($employee['user_id'], $_SESSION['idCurrentPermission'], $employee['type_person_id']);
        }

        foreach ($protections as $protection) {
            $objectProtection->setMaskingProtectionsStuttering($_SESSION['idCurrentPermission'], $protection['vtor_id'], $protection['entrance_id'], $protection['protectionid'],
                $protection['masking'], $protection['check_masking'], $protection['unmasking'], $protection['check_unmasking'], $protection['objectid']);
        }
        $this->setLog('создал разрешение', $_COOKIE['user'], $this->db, "№{$_SESSION['idCurrentPermission']}");
        $this->redirect('permission', 'add');
    }

    public function getDispatcherStatuses():array {
        $statuses = $this->status->getStatuses();
        $result = [];

        foreach ($statuses as $status) {
            if(($status['id'] > 1)  && $status['id'] < 16) {
                $result[] =  $status;
            }
        }

        return $result;
    }

    protected function getAuthorStatuses():array {
       $result = [];
       $statuses = $this->status->getStatuses();

        foreach ($statuses as $status) {
            if($status['id'] !== 16) {
                $result[] =  $status;
            }
        }

       return $result;
    }

    public function setSessionsForFilter() {
        if(isset($_POST['date_start'])) {
            $_SESSION['date_start'] = $_POST['date_start'];
            $_SESSION['date_end'] = $_POST['date_end'];
        }

        if(isset($_POST['statuses'])) {
            $_SESSION['statuses'] = $_POST['statuses'];
        }

        $_SESSION['filter'] = $_POST['filter'];
        $this->redirect('permission', '');
    }

    protected function filterPermissionByDates($roles):array {
        if($roles['isAuthor']) {
            $permissions =  $this->permission->getPermission(0, '', $_COOKIE['user'], '', $_SESSION['date_start'], $_SESSION['date_end']);
        } else {
            $permissions =  $this->permission->getPermission(0, '', 0, '', $_SESSION['date_start'], $_SESSION['date_end']);
        }

        $permissions = $this->setCurrentStatuses($permissions, 'permission', 1);
        $permissions = $this->setCurrentStatuses($permissions, 'mask', 2);
        $permissions = $this->setCurrentStatuses($permissions, 'work', 3);

        return $permissions;
    }

    protected function filterPermission($roles = [], $permissions = []) {
        $result = [];

        if(isset($_SESSION['date_start'])) {
            $permissions = $this->filterPermissionByDates($roles);
        }

        if(isset($_SESSION['statuses']) && $_SESSION['statuses'] !== '') {
            $statuses = explode(' ', $_SESSION['statuses']);
            foreach ($permissions as $permission) {
                $fl = true;

                if(isset($permission['status_permission_id'])) {
                    if(!in_array($permission['status_permission_id'], $statuses)) {
                        $fl = false;
                    }
                }

                if(isset($permission['status_mask_id'])) {
                    if(!in_array($permission['status_mask_id'], $statuses)) {
                        $fl = false;
                    }
                }

                if(isset($permission['status_work_id'])) {
                    if(!in_array($permission['status_work_id'], $statuses)) {
                        $fl = false;
                    }
                }

                if($fl) {
                    $result[] = $permission;
                }
            }
        } else {
            $result = $permissions;
        }

        unset($_SESSION['filter']);
        unset($_SESSION['date_start']);
        unset($_SESSION['date_end']);

        return $result;
    }

    protected function filterPermissionForDispatcher($permissions = []):array {
        $result = [];

        foreach ($permissions as $permission) {
            if($permission['status_id'] !== 1) {
                $result[] = $permission;
            }
        }

        return $result;
    }

    protected function filterPermissionForEngineer($permissions = []):array {
        $result = [];

        foreach ($permissions as $permission) {
            if(!(in_array($permission['status_id'], array(1,2)) )) {
                $result[] = $permission;
            }
        }

        return $result;
    }

    public function setNumPageToSession($numPage = 1) {
        $_SESSION['num_page'] = intval($numPage);
        $this->redirect('permission');
    }

    public function updatePeriod($dateStart, $dateEnd) {
        $permission = $this->permission->getPermission($_SESSION['idCurrentPermission'])[0];
        $this->permission->updatePermission($permission['id'], $permission['description'], $permission['addition'],
                                            $permission['number'], $permission['subdivision_id'], $permission['untypical_work'],
                                            $permission['emergency_minute'], $permission['is_emergency_activation'],
                                            $dateStart, $dateEnd);
        $this->date->delDates($_SESSION['idCurrentPermission']);
        $this->redirect('permission', 'add');
    }

    protected function getPermissions($roles = []):array {
        if(isset($_SESSION['permission_search'])) {
            $permissions = $_SESSION['permission_search'];
            unset($_SESSION['permission_search']);
        } elseif(isset($_SESSION['archive-permissions'])) {
            if($roles['isDispatcher']) {
                $permissions = $this->pagination->getEntriesOfPage();
            } else {
                $permissions = $this->pagination->getEntriesOfPage($_COOKIE['user']);
            }
        } else {
            if($roles['isDispatcher']) {
                $date = date('Y.m.d');
                $permissions = $this->permission->getPermission(0, '', 0, '', $date, $date);
                $permissions = $this->filterPermissionForDispatcher($permissions);
            } elseif($roles['isReplacementEngineer']) {
                $date = date('Y.m.d');
                $permissions = $this->permission->getPermission(0, '', 0, '', $date, $date);
                $permissions = $this->filterPermissionForEngineer($permissions);
                
            } elseif($roles['isInspectingEngineer']) {
                    $date = date('Y.m.d');
                    $permissions = $this->permission->getPermission(0, '', 0, '', $date, $date);
                    $permissions = $this->filterPermissionForEngineer($permissions);
                    
            } else {
                $permissions = $this->permission->getPermission(0, '', $_COOKIE['user']);
            }
        }

        if(!isset($_SESSION['archive-permissions']) && $this->isClosePermission($permissions)) {
            $this->stutteringPermissions($permissions);
            $permissions = $this->getOperativePermissions($permissions);
        }

        if(isset($_SESSION['archive-permissions']) && $this->isRecoveryPermission($permissions)) {
            $this->stutteringPermissions($permissions, 'trans');
            $permissions = $this->getArchivePermissions($permissions);
        }

        $permissions = $this->setCurrentStatuses($permissions, 'permission', 1);
        $permissions = $this->setCurrentStatuses($permissions, 'mask', 2);
        $permissions = $this->setCurrentStatuses($permissions, 'work', 3);

        if(isset($_SESSION['filter'])) {
            $permissions = $this->filterPermission($roles, $permissions);
        }

        return $this->setColorsToPermissions($permissions);
    }

    protected function setCurrentStatuses($permissions, $nameStatus, $idStatus) {
        foreach ($permissions as &$permission) {
            $log = $this->statusLog->getStatusManagementLogs($permission['id'], $idStatus);
            if(isset($log[0])) {
                $permission['status_' . $nameStatus . '_name'] = $log[0]['status_name'];
                $permission['status_' . $nameStatus . '_date'] = substr($log[0]['date'], 0,16);
                $permission['status_' . $nameStatus . '_id'] = $log[0]['status_id'];
            }
        }

        return $permissions;
    }

    protected function isClosePermission($permissions = []):bool {
        foreach ($permissions as $permission) {
            if($permission['status_id'] === 16) {
                return true;
            }
        }

        return false;
    }

    protected function isRecoveryPermission($permissions = []):bool {
        foreach ($permissions as $permission) {
            if($permission['status_id'] <> 16) {
                return true;
            }
        }

        return false;
    }


    protected function getOperativePermissions($permissions = []):array {
        $result = [];

        foreach ($permissions as $permission) {
            if($permission['status_id'] !== 16) {
                $result[] = $permission;
            }
        }

        return $result;
    }

    protected function getArchivePermissions($permissions):array {
        $result = [];

        foreach ($permissions as $permission) {
            if($permission['status_id'] === 16) {
                $result[] = $permission;
            }
        }

        return $result;
    }

    protected function stutteringPermissions($permissions, $nameDb = 'trans_archive') {
        if($nameDb === 'trans_archive') {
            $db = DB::getArchiveDB();
            $permissions = $this->getArchivePermissions($permissions);
        } else {
            $db = DB::getMainDB();
            $permissions = $this->getOperativePermissions($permissions);
        }

        $objectPermission = new Permission($db);
        $objectStatusLog = new StatusLog($db);
        $objectEmployee = new Employee($db);
        $objectDate = new Date($db);
        $objectTypicalWork = new TypicalWork($db);
        $objectProtection = new Protection($db);

        foreach ($permissions as $permission) {
            if($nameDb === 'trans_archive') {
                $objectPermission->setPermission($permission['id'], $permission['number'], $permission['description'],
                    $permission['addition'], $permission['subdivision_id'], $permission['untypical_work']);
            } else {
                $objectPermission->recoveryPermission($permission['id'], $permission['number'], $permission['description'],
                    $permission['addition'], $permission['subdivision_id'], $permission['untypical_work']);
            }

            $statusesLog = $this->statusLog->getStatusManagementLogs($permission['id']);
            foreach ($statusesLog as $statusLog) {
                $objectStatusLog->addStatusManagementLog($statusLog['permission_id'], $statusLog['status_id'], $statusLog['user_id'],
                    $statusLog['comment'], $statusLog['date_change_status'], $statusLog['date']);
            }

            $employees = $this->employee->getEmployee(0, $permission['id']);
            foreach ($employees as $employee) {
                $objectEmployee->addEmployee($employee['user_id'], $employee['permission_id'], $employee['type_person_id']);
            }

            $dates = $this->date->getDates($permission['id']);
            foreach ($dates as $date) {
                $objectDate->setDate($date['date'], $date['from_time'], $date['to_time'], $date['permissionid']);
            }

            $typicalWorks = $this->typicalWork->getTypicalWork($permission['id']);
            foreach ($typicalWorks as $typicalWork) {
                $objectTypicalWork->setTypicalWorks($typicalWork['permission_id'], $typicalWork['typical_work_id'], $typicalWork['description']);
            }

            $protections = $this->protection->getMaskingProtections($permission['id']);
            foreach ($protections as $protection) {
                $objectProtection->setMaskingProtectionsStuttering($protection['permissionid'], $protection['vtor_id'], $protection['entrance_id'], $protection['protectionid'],
                                                                    $protection['masking'], $protection['check_masking'], $protection['unmasking'], $protection['check_unmasking'], $protection['objectid']);
            }

            $this->permission->delPermission($permission['id']);
        }

    }

    public function searchPermissions() {
        $roles = $this->role->getRoles($_COOKIE['user']);
        $_SESSION['search_info'] =  trim($_POST['search_info']);
        $search = '%' . trim($_POST['search_info']) . '%';

        if($roles['isAuthor']) {
            $permissions = $this->permission->getPermission(0, '', $_COOKIE['user'], $search);
        } else {

            if(isset($_SESSION['archive-permissions'])) {
                $permissions = $this->permission->getPermission(0, '', 0, $search);
                $permissions = $this->filterPermissionForDispatcher($permissions);
            } else {
                $date = date('Y.m.d');
                $permissions = $this->permission->getPermission(0, '', 0, $search, $date, $date);
                $permissions = $this->filterPermissionForDispatcher($permissions);
            }
        }

        $_SESSION['permission_search'] = $permissions;
        $this->redirect('permission', '');
    }

    protected function getSearch():string {
        $search = '';

        if(isset($_SESSION['search_info'])) {
            $search = $_SESSION['search_info'];
            unset($_SESSION['search_info']);
        }

        return $search;
    }
    
    public function getEngineerStatuses():array {
        $statuses = $this->status->getStatuses();
        $result = [];

        foreach ($statuses as $status) {
            if($status['id'] > 1 && $status['id'] < 16) {
                $result[] =  $status;
            }
        }

        return $result;
    }

    protected function getStatuses($roles = [], $typeStatusId = 0):array {
        $result = [];
        $arr = [];

        if($roles['isDispatcher']) {
            $arr = $this->getDispatcherStatuses();
        } elseif($roles['isAuthor']) {
            $arr = $this->getAuthorStatuses();
        } elseif($roles['isReplacementEngineer']) {
            $arr = $this->getEngineerStatuses();
        } elseif($roles['isInspectingEngineer']) {
            $arr = $this->getEngineerStatuses();
        }

        foreach ($arr as $item) {
            if($item['type_statusid'] == $typeStatusId) {
                $result[] = $item;
            }
        }

        if(isset($_SESSION['statuses'])) {
            $arr = explode(' ', $_SESSION['statuses']);

            foreach ($result as &$item) {
                if(in_array($item['id'], $arr)) {
                    $item['active'] = true;
                }
            }

            if($typeStatusId == 3) {
                unset($_SESSION['statuses']);
            }
        } else {
            foreach ($result as &$item) {
                $item['active'] = true;
            }
        }

        return $result;
    }

    protected function getDate($nameDate = ''):string {
        $result = '';

        if(isset($_SESSION[$nameDate])) {
            $result = $_SESSION[$nameDate];
        }

        return $result;
    }

    protected function getDates($roles = []) {
        $result = [];

        if($roles['isAuthor']) {
            $result = $this->date->getDates(0, $_COOKIE['user']);
        } elseif($roles['isDispatcher']) {
            $result= $this->date->getDates();
        }

        return $result;
    }

    protected function getEmployee($typePersonID = 0, $roles = []) {
        $result = [];

        if($roles['isAuthor']) {
            $result = $this->employee->getEmployee($typePersonID, 0, $_COOKIE['user']);
        } elseif($roles['isDispatcher']) {
            $result = $this->employee->getEmployee($typePersonID);
        }
;
        return $result;
    }

    protected function getTypicalWorks($roles = []) {
        $result = [];

        if($roles['isAuthor']) {
            $result = $this->typicalWork->getTypicalWork(0, $_COOKIE['user']);
        } elseif($roles['isDispatcher']) {
            $result = $this->typicalWork->getTypicalWork(0, 0, 1);
        }

        return $result;
    }

    public function getIndexVarsToTwig() {
        $roles = $this->role->getRoles($_COOKIE['user']);
        $currentUser = $this->user->getUsers($_COOKIE['user'])[0];

        return ['date_start' => $this->getDate('date_start'),
            'date_end' => $this->getDate('date_end'),
            'permissions' => $this->getPermissions($roles),
            'protections' => $this->protection->getProtectionsOfPermissionThisStatuses($_COOKIE['user']),
            'author' => $currentUser,
            'dates' => $this->getDates($roles),
            'responsiblesForPreparation' =>  $this->getEmployee(2, $roles),
            'responsiblesForExecute' => $this->getEmployee(3, $roles),
            'responsiblesForControl' =>  $this->getEmployee(4, $roles),
            'typical_works' => $this->getTypicalWorks($roles),
            'message' => 'Совпадений не найдено',
            'search_info' => $this->getSearch(),
            'roles' => $roles,
            'statuses' => $this->getStatuses($roles, 1),
            'statuses_mask' => $this->getStatuses($roles, 2),
            'statuses_work' => $this->getStatuses($roles, 3),
            'user_fio' => $this->getUserFio($this->db),
            'is_archive' => $this->isArchive(),
            'nums_pages' => $this->pagination->getArrNumPages()];
    }

    public function setSessionArchive() {
        $_SESSION['archive-permissions'] = true;
        $this->redirect('permission');
    }

    public function unsetSessionArchive() {
        unset($_SESSION['archive-permissions']);
        unset($_SESSION['num_page']);
        $this->redirect('permission');
    }

    protected function isArchive():bool {
        if(isset($_SESSION['archive-permissions'])) {
            return true;
        } else {
            return false;
        }
    }

    protected function setColorsToPermissions($permissions = []):array {
        foreach ($permissions as &$permission) {
            if($permission['status_id'] === 1) {
                $permission['color'] = 'violet';
            } elseif($permission['status_id'] === 2) {
                $permission['color'] = 'beige';
            } elseif($permission['status_id'] === 3) {
                $permission['color'] = 'blue';
            } elseif($permission['status_id'] === 4) {
                $permission['color'] = 'green';
            } elseif($permission['status_id'] === 5) {
                $permission['color'] = 'yellow';
            } elseif($permission['status_id'] === 6) {
                $permission['color'] = 'gray';
            } elseif($permission['status_id'] === 16) {
                $permission['color'] = 'pastel';
            }

            if(isset($permission['status_work_id'])) {
                if($permission['status_work_id'] === 14) {
                    $permission['work_color'] = 'violet';
                } elseif($permission['status_work_id'] === 15) {
                    $permission['work_color'] = 'beige';
                }
            }

            if(isset($permission['status_mask_id'])) {
                if($permission['status_mask_id'] === 7) {
                    $permission['mask_color'] = 'darkviolet';
                } elseif($permission['status_mask_id'] === 8) {
                    $permission['mask_color'] = 'orange';
                } elseif($permission['status_mask_id'] === 9) {
                    $permission['mask_color'] = 'darkgreen';
                } elseif($permission['status_mask_id'] === 10) {
                    $permission['mask_color'] = 'darkyellow';
                } elseif($permission['status_mask_id'] === 11) {
                    $permission['mask_color'] = 'brown';
                }  elseif($permission['status_mask_id'] === 12) {
                    $permission['mask_color'] = 'darkblue';
                } elseif($permission['status_mask_id'] === 13) {
                    $permission['mask_color'] = 'red';
                }
            }
        }

        return $permissions;
    }

    public function delTypicalWork($id) {
        $this->typicalWork->delTypicalWork(0, $id);
    }

    public function delResponsible($idEmployee, $idTypePerson) {
        $this->employee->delEmployee($idEmployee, $_SESSION['idCurrentPermission'], $idTypePerson);
    }

    protected function getSupervisor() {
        $supervisor = $this->employee->getEmployee(5, $_SESSION['idCurrentPermission']);

        if(isset($supervisor[0])) {
            $supervisor = $supervisor[0];
        }

        return $supervisor;
    }

    public function delEmployee($employeeId = 0, $permissionId = 0, $typeResponsibleId = 0) {
        $this->employee->delEmployee($employeeId, $permissionId, $typeResponsibleId);
    }

    public function getAddVarsToTwig():array {
       if (isset($_REQUEST["id_responsible_for_preparation"])) {
            return ['ajax' => true];
        } else {
            return ['current_typical_works' => $this->typicalWork->getTypicalWork($_SESSION['idCurrentPermission']),
                'current_dates' => $this->date->getDates($_SESSION['idCurrentPermission']),
                'permission' => $this->permission->getPermission($_SESSION['idCurrentPermission'])[0],
                'supervisorOfResponsibleForExecute' => $this->getSupervisor(),
                'responsiblesForPreparation' => $this->employee->getEmployee(2, $_SESSION['idCurrentPermission']),
                'responsiblesForExecute' => $this->employee->getEmployee(3, $_SESSION['idCurrentPermission']),
                'responsiblesForControl' => $this->employee->getEmployee(4, $_SESSION['idCurrentPermission']),
                'roles' => $this->role->getRoles($_COOKIE['user']),
                'protections' => $this->permission->getProtectionsOfPermission($_SESSION['idCurrentPermission']),
                'user_fio' => $this->getUserFio($this->db)];
        }
    }

    public function downloadSCV($strPermissionsId = '') {
        $listId = explode(' ', $strPermissionsId);
        $titles = array('№', '№ в СЭД', 'Статус', 'Подразделение', 'Ответственный за подготовку работ',
                        'Ответственный за проведение работ', 'Ответственный за контроль при производстве работ',
                        'Периоды работ', 'Типовые работы', 'Нетиповые работы', 'Описание', 'Дополнение');
        $result = [];
        $permissions = [];
        $idPermissions = '';
        $scv = new SCV("Разрешения.csv", $this->db);
        $responsiblesForPrepare = $scv->getSCVResponse(2, $listId);
        $responsiblesForExecute = $scv->getSCVResponse(3, $listId);
        $responsiblesForControl = $scv->getSCVResponse(4, $listId);
        $typicalWorks = $scv->getSCVTypicalWorks($listId);
        $dates = $scv->getSCVDates($listId);

        foreach ($listId as $item) {
            $permissions[] = $this->permission->getPermission($item)[0];
        }

        foreach ($permissions as $permission) {
            $result[$permission['id']]['id'] = $permission['id'];
            $result[$permission['id']]['number'] = $permission['number'];
            $result[$permission['id']]['status_name'] = $permission['status_name'];
            $result[$permission['id']]['subdivision_name'] = $permission['subdivision_name'];
            $idPermissions .= '№' . $permission['id'] . ' ';
        }
        $result = $scv->setSCVResponseText($result, $responsiblesForPrepare,  'responsePrepare');
        $result = $scv->setSCVResponseText($result, $responsiblesForExecute,  'responseExecute');
        $result = $scv->setSCVResponseText($result, $responsiblesForControl,  'responseControl');
        $result = $scv->setSCVDateText($result, $dates);
        $result = $scv->setSCVTypicalWorksText($result, $typicalWorks);
        foreach ($permissions as $permission) {
            $result[$permission['id']]['untypical_work'] = $permission['untypical_work'];
            $result[$permission['id']]['description'] = $permission['description'];
            $result[$permission['id']]['addition'] = $permission['addition'];
        }

        $this->setLog('выгрузил в scv разрешения', $_COOKIE['user'], $this->db, "$idPermissions");

        $scv->downloadSendHeaders();
        echo $scv->listToSCV($result, $titles);
        die();
    }

    public function downloadPDF($id) {
        $pdf = new PDF($this->db, intval($id));
        $pdf->download();
        $this->setLog('выгрузил в pdf разрешение', $_COOKIE['user'], $this->db, "№$id");
    }

}