<?php

namespace widgets\scv;

use widgets\date\Date;
use widgets\employee\Employee;
use widgets\typicalwork\TypicalWork;

class SCV
{
    protected string $filename = '';
    protected object $db;
    protected object $date;
    protected object $employee;
    protected object $typicalWork;

    public function __construct($filename, $db)
    {
        $this->filename = $filename;
        $this->db = $db;
        $this->date = new Date($db);
        $this->employee = new Employee($db);
        $this->typicalWork = new TypicalWork($db);
    }

    public function downloadSendHeaders() {
        $now = gmdate("D, d M Y H:i:s");
        header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");
        header("Content-Transfer-Encoding: UTF-8");

        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");

        header("Content-Disposition: attachment;filename={$this->filename}");
        header("Content-Transfer-Encoding: binary");
    }

    public function listToSCV(array &$array, $titles) {
        if (count($array) == 0) {
            return null;
        }
        ob_start();
        $df = fopen("php://output", 'w');
        fwrite($df,b"\xEF\xBB\xBF" ) ;
        fputcsv($df, $titles, ';');
        foreach ($array as $row) {
            fputcsv($df, $row, ';');
        }
        fclose($df);
        return ob_get_clean();
    }

        public function setSCVDateText($result = [], $dates = []):array {
        foreach ($dates  as $date) {
            $fio = '';
            $fl = true;
            foreach ($date as $item) {
                if($fl) {
                    $fl = false;
                    $res = $item['date'] . ' ' . $item['from_time'] . ' ' . $item['to_time'];
                } else {
                    $res = $fio . ', ' . $item['date'] . ' ' . $item['from_time'] . ' ' . $item['to_time'];
                }
                $result[$item['permissionid']]['date'] = $res;
            }
        }

        return $result;
    }

    public function setSCVResponseText($result = [], $responses = [], $nameResponse = ''):array {
        foreach ($responses  as $response) {
            $fio = '';
            $fl = true;
            foreach ($response as $item) {
                if($fl) {
                    $fl = false;
                    $fio = $item['lastname'] . ' ' . $item['name'] . ' ' . $item['patronymic'];
                } else {
                    $fio = $fio . ', ' . $item['lastname'] . ' ' . $item['name'] . ' ' . $item['patronymic'];
                }
                $result[$item['permission_id']][$nameResponse] = $fio;
            }
        }

        return $result;
    }

    public function setSCVTypicalWorksText($result = [], $typicalWorks = []):array {
        foreach ($typicalWorks  as $typicalWork) {
            $typical = '';
            $fl = true;
            foreach ($typicalWork as $item) {
                if($fl) {
                    $fl = false;
                    $typical = $item['name'];
                } else {
                    $typical = $typical . ', ' . $item['name'];
                }
                $result[$item['permission_id']]['typical_work'] = $typical;
            }
        }

        return $result;
    }

    public function getSCVDates($listId = []):array {
        foreach ($listId as $item) {
            $dates[] = $this->date->getDates($item);
        }

        return $dates;
    }

    public function getSCVResponse($id = 0, $listId = []):array {
        foreach ($listId as $item) {
            $responsibles[] = $this->employee->getEmployee($id, $item);
        }

        return $responsibles;
    }

    public function getSCVTypicalWorks($listId = []):array {
        foreach ($listId as $item) {
            $typicalWorks[] = $this->typicalWork->getTypicalWork($item);
        }

        return $typicalWorks;
    }

}