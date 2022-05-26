<?php

namespace widgets\pdf;

use Mpdf\Mpdf;
use widgets\date\Date;
use widgets\employee\Employee;
use widgets\permission\Permission;
use widgets\protection\Protection;
use widgets\typicalwork\TypicalWork;
use widgets\user\User;

class PDF
{
    protected object $mpdf;
    protected object $date;
    protected object $employee;
    protected object $typicalWork;
    protected object $permission;
    protected object $user;
    protected int $permissionId;

    public function __construct($db, $permissionId = 0)
    {
        $this->mpdf = new Mpdf(['utf-8', 'A4', 16, '', 55, 55, 55, 55]);
        $this->permissionId = $permissionId;
        $this->date = new Date($db);
        $this->user = new User($db);
        $this->employee = new Employee($db);
        $this->typicalWork = new TypicalWork($db);
        $this->permission = new Permission($db);
    }

    public function download() {
        $permission = $this->permission->getPermission($this->permissionId)[0];
        $supervisor = $this->employee->getEmployee(5, $_SESSION['idCurrentPermission'])[0];
        $supervisorFIO = $this->getFIO($supervisor['name'], $supervisor['lastname'], $supervisor['patronymic']);

        $header = $this->getHeader($permission['number']);
        $this->mpdf->SetHTMLHeader($header);

        $footer = $this->getFooter();
        $this->mpdf->SetHTMLFooter($footer);

        $html = "<div style='text-align: right;margin:0 0 20px 0;'>Начальнику {$supervisor['subdivision_name']} $supervisorFIO</div>
                <div style='font-size: 16px;margin:0 0 20px 0;font-weight: bold;'>Разрешение на проведение работ</div>
                <div style='margin: 0 0 5px 0'>АО Транснефть-Север разрешает проведение следующих работ по направлению деятельности отдела {$permission['subdivision_name']}.</div> ";
        $html .= $this->getFirstPart($permission);
        $html .= $this->getSecondPart($permission['untypical_work']);
        $html .= $this->getThirdPart();
        $html .= $this->getFourthPart($permission['emergency_minute'], $permission['is_emergency_activation']);
        $html .= $this->getFifthPart($permission['description']);

        $this->mpdf->AddPage('', // L - landscape, P - portrait
            '', '', '', '',
            15, // margin_left
            15, // margin right
            40, // margin top
            30, // margin bottom
            10, // margin header
            10  // margin footer
        );
        $this->mpdf->WriteHTML($html);
        $this->mpdf->Output("wefwef.pdf", 'I');
    }

    protected function getHeader($number) {
        $date = $this->getNowDate();
        $result = "<div style='margin: 0 0 10px 0'>$date №{$number}</div>
                    <img style='width: 120px;' src='../../../public/img/logo.png'>
                    <div style='border-bottom: 1px solid #000;'></div>";
        return $result;
    }

    protected function getFooter() {
        $user = $this->employee->getEmployee(1, $this->permissionId)[0];
        $fio = $this->getFIO($user['name'], $user['lastname'], $user['patronymic']);
        return "<div>{$user['user_position']} $fio</div>";
    }

    protected function getFirstPart($permission):string {
        $result = "<div style='margin: 0 0 5px 0;font-weight: bold;'>1. Периоды проведения работ</div>";
        $dates = $this->date->getDates($this->permissionId);

        if(count($dates) > 0) {
            $result .= "<div style='margin: 0 0 3px 15px;'>Первый день:</div>";

            for ($i = 0; $i < count($dates); $i++) {
                if($i === 0) {
                    $result .= "<div style='margin: 0 0 0 15px;'><span>Начало работ {$dates[$i]['date']} {$dates[$i]['from_time']}</span> 
                                <span>Окончание работ {$dates[$i]['date']} {$dates[$i]['to_time']}</span></div>";
                } else {
                    if($i === 1) {
                        $result .= "<div style='margin: 3px 0 3px 15px;'>Последующие дни</div>";
                    }
                    $result .= "<div style='margin: 0 0 0 15px;'><span style='padding: 0 20px 0 0;'>Начало работ {$dates[$i]['date']} {$dates[$i]['from_time']}</span> 
                                <span>Окончание работ {$dates[$i]['date']} {$dates[$i]['to_time']}</span></div>";
                }
            }
        } else  {
            $result .= "<div style='margin: 0 0 0 15px;'><span>Начало работ {$permission['period_start']}</span> 
                                <span>Окончание работ {$permission['period_end']}</span></div>";
        }

        return $result;
    }

    protected function getSecondPart($untypicalWorks = ''):string {
        $typicalWorks = $this->typicalWork->getTypicalWork($this->permissionId);

        $result = "<div style='margin: 0 0 5px 0;font-weight: bold;'>2. Наименование работ, основание для выполнения работ</div>";
        $result .= "<table style='margin: 0 0 0 17px; width: 100%;' border='0' cellspacing='0' cellpadding='0'>
                    <thead>
                      <tr>
                         <td style='width: 40%; border: 1px solid #000;text-align: center;padding: 5px;'>Наименование работ</td>
                         <td style='width: 40%; border: 1px solid #000;text-align: center;padding: 5px;'>Комментарий</td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                         <td style='width: 40%; border: 1px solid #000;padding: 5px;'>$untypicalWorks</td>
                         <td style='width: 40%; border: 1px solid #000;padding: 5px;'></td>
                      </tr>";

        foreach ($typicalWorks as $typicalWork) {
            $result .= "<tr>
                         <td style='width: 40%; border: 1px solid #000; padding: 5px;'>{$typicalWork['name']}</td>
                         <td style='width: 40%; border: 1px solid #000;padding: 5px;'>{$typicalWork['description']}</td>
                      </tr>";
        }

        $result .= "</tbody></table>";

        return $result;
    }

    protected function getThirdPart():string {
        $result = "<div style='margin: 5px 0;font-weight: bold;'>3. Маскирвание защит:</div>";
        $protections = $this->prepareInfoAboutProtections($this->permission->getProtectionsOfPermission($this->permissionId));

        if(count($protections) > 0) {
            $result .= "<table style='margin: 0 0 0 17px; width: 100%;' border='0' cellspacing='0' cellpadding='0'>
                    <thead>
                      <tr>
                         <td style='width: 14%; border: 1px solid #000;text-align: center;padding: 5px;'>Система</td>
                         <td style='width: 14%; border: 1px solid #000;text-align: center;padding: 5px;'>Защита</td>
                         <td style='width: 14%; border: 1px solid #000;text-align: center;padding: 5px;'>Вход</td>
                         <td style='width: 14%; border: 1px solid #000;text-align: center;padding: 5px;'>Выход</td>
                         <td style='width: 16%; border: 1px solid #000;text-align: center;padding: 5px;'>Тип объекта</td>
                         <td style='width: 14%; border: 1px solid #000;text-align: center;padding: 5px;'>Объект</td>
                         <td style='width: 14%; border: 1px solid #000;text-align: center;padding: 5px;'>Втор</td>
                      </tr>
                    </thead>
                    <tbody>";


            foreach ($protections as $protection) {
                $result .= "
                      <tr>
                         <td style='width: 14%; border: 1px solid #000;text-align: center;padding: 5px;'>{$protection['system_apcs_name']}</td>
                         <td style='width: 14%; border: 1px solid #000;text-align: center;padding: 5px;'>{$protection['protection_name']}</td>
                         <td style='width: 14%; border: 1px solid #000;text-align: center;padding: 5px;'>{$protection['in']}</td>
                         <td style='width: 14%; border: 1px solid #000;text-align: center;padding: 5px;'>{$protection['out']}</td>
                         <td style='width: 16%; border: 1px solid #000;text-align: center;padding: 5px;'>{$protection['type_object_name']}</td>
                         <td style='width: 14%; border: 1px solid #000;text-align: center;padding: 5px;'>{$protection['object_name']}</td>
                         <td style='width: 14%; border: 1px solid #000;text-align: center;padding: 5px;'>{$protection['vtor']}</td>
                      </tr>";
            }

            $result .= "</tbody></table>";
        } else {
            $result .= '<div style="margin: 0 0 0 18px">Список масок пуст.</div>';
        }

        return $result;
    }

    protected function prepareInfoAboutProtections($protections) {
        foreach ($protections as &$protection) {
            if($protection['entrance_name'] == 'Вход') {
                $protection['in'] = '+';
                $protection['out'] = '-';
            } else {
                $protection['in'] = '-';
                $protection['out'] = '+';
            }

            if($protection['vtor_name'] == 'Втор') {
                $protection['vtor'] = '+';
            } else {
                $protection['vtor'] = '-';
            }

            if($protection['object_name'] === '') {
                $protection['object_name'] = '-';
            }
        }

        return $protections;
    }

    protected function getFourthPart($countMinutes = 0, $isEmergencyActive = false):string {
        $result = "<div style='margin: 5px 0;font-weight: bold;'>4. Прочие условия проведения работ:</div>";

        $result .= "<div style='margin: 0 0 5px 18px;'>4.1 Аварийная готовность $countMinutes минут.</div>";

        if($isEmergencyActive) {
            $emergencyActive = 'да';
        } else {
            $emergencyActive = 'нет';
        }

        $result .= "<div  style='margin: 0 0 5px 18px;'>4.2 Отметка об отсутствии(наличии) аварийного включения резерва(АВР) при выполнении работ: $emergencyActive.</div>";

        $result .= $this->getResponsibleText(2, 'подготовку');
        $result .= $this->getResponsibleText(3, 'выполнение');
        $result .= $this->getResponsibleText(4, 'контроль при производстве');

        return $result;
    }

    protected function getFifthPart($description = '') {
        return "<span style='margin: 5px 0;font-weight: bold;'>5. При производстве работ обеспечить: </span><span>$description.</span>";
    }

    protected function getResponsibleText($typeResponsiblesId, $nameEmployee) {
        $responsibles = $this->employee->getEmployee($typeResponsiblesId, $this->permissionId);

        $result = "<div style='margin: 0 0 5px 18px;'>4.3. Ответственный за $nameEmployee работ: ";
        for ($i = 0; $i < count($responsibles); $i++) {
            $sign = '; ';
            if($i + 1 === count($responsibles)) {
                $sign = '.';
            }
            $result .= $responsibles[$i]['user_position'] . ', ';
            $result .= $this->getFIO($responsibles[$i]['name'], $responsibles[$i]['lastname'], $responsibles[$i]['patronymic']) . ', ';
            $result .= trim($responsibles[$i]['mobile']) . $sign;
        }

        $result .= '</div>';

        return $result;
    }

    protected function getFIO($name, $lastname, $patronymic) {
        return mb_substr($name,0, 1) . '.' . mb_substr($patronymic,0, 1) . '.' . $lastname;
    }

    protected function getNowDate() {
        $arr = [
            'января',
            'февраля',
            'марта',
            'апреля',
            'мая',
            'июня',
            'июля',
            'августа',
            'сентября',
            'октября',
            'ноября',
            'декабря'
        ];

        $month = date('n')-1;
        $date = date('d').' '.$arr[$month].' '.date('Y') . 'г.';
        return $date;
    }
}