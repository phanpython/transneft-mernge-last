<?php

namespace widgets\pagination;

use widgets\permission\Permission;

class Pagination
{
    protected $db;
    protected $countNumsOfPagination = 3;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getEntriesOfPage($userId = 0) {
        $numPage = $this->getActivePage();
        $permission = new Permission($this->db);
        return $permission->getPermission(0, '', $userId, '', '', '', 0, $numPage);
    }

    public function getCountPages() {
        $query = "SELECT * FROM get_count_permissions()";
        $stmt = $this->db->query($query);
        return intval(ceil($stmt->fetch()['count_permissions'] / 2));
    }

    protected function getActivePage():int {
        $result = 1;

        if(isset($_SESSION['num_page'])) {
            $result = intval($_SESSION['num_page']);
        }

        return $result;
    }

    public function getArrNumPages():array {
        $result = [];

        if(isset($_SESSION['archive-permissions'])) {
            $fl = false;
            $numActivePage = $this->getActivePage();
            $countNumsOfPagination = $this->countNumsOfPagination;
            $countPages = $this->getCountPages();

            for($i = 1; $i <= $countPages; $i++) {
                if($i > $countNumsOfPagination) {
                    if($i === $countNumsOfPagination + 1) {
                        $result[$i]['num'] = $i;
                        $result[$i]['points'] = true;
                        $fl = true;
                        break;
                    }
                } else {
                    $result[$i]['num'] = $i;
                }

                if($i === $numActivePage) {
                    if($numActivePage === $countPages) {
                        $result[$i]['num'] = $countPages;
                    }
                    $result[$i]['fl'] = true;
                }
             }

            if($fl) {
                $result[$countPages]['num'] = $countPages;

                if($numActivePage === $countPages) {
                    $result[$countPages]['fl'] = true;
                }
            }

            $result = $this->setNumArrows($result, $numActivePage, $countPages);
        }

        return $result;
    }

    protected function setNumArrows($list = [], $numActivePage = 1, $countPages = 1) {
        for($i = 1; $i <= count($list); $i++) {
           if(isset($list[$i]['num']) && $numActivePage === $list[$i]['num']) {
               if(isset($list[$i - 1]['num'])) {
                   $list[$i - 1]['left'] = true;
               } else {
                   $list[$i]['left'] = true;
               }

               if(isset($list[$i + 1]['num'])) {
                   $list[$i + 1]['right'] = true;
               } else {
                   $list[$i]['right'] = true;
               }
           }
        }

        return $list;
    }
}