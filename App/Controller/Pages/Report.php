<?php
namespace App\Controller\Pages;

use App\Model\Entity\Report as EntityReport;
use App\View\View;

use PDO;

class Report extends Page {

    public static function getAppointmentItens() {
        $appointment_itens;

        $appointment_list = EntityReport::getAppointmentList();

        while($appointment = $appointment_list->fetch(PDO::FETCH_ASSOC)) {
            $appointment_itens .= View::render('data/report/appointment-item', [
                'appointment_id' => $appointment['appointment_id'],
                'owner_id' => $appointment['owner_id'],
                'owner_name' => $appointment['owner_name'],
                'pet_id' => $appointment['pet_id'],
                'pet_name' => $appointment['pet_name'],
                'service' => $appointment['service'],
                'appointment_date_time' => $appointment['appointment_date_time'],
                'value' => $appointment['value']
            ]);            
        }
        return $appointment_itens;
    }
    

    public static function getRegisterItens() {
        $register_itens;

        $register_list = EntityReport::getOwnerPetList();

        while($register = $register_list->fetch(PDO::FETCH_ASSOC)) {
            $register_itens .= View::render('data/report/register-item', [
                'owner_id' => $register['owner_id'],
                'owner_name' => $register['owner_name'],
                'pet_id' => $register['pet_id'],
                'pet_name' => $register['pet_name'],
                'breed' => $register['breed']
            ]);
        }
        return $register_itens;
    }


    public static function getReport() {
        $content = View::render('pages/report', [
            'title' => 'Relatório',
            'appointment-itens' => self::getAppointmentItens(),
            'register-itens' => self::getRegisterItens()
        ]);

        return parent::getPage('Central Pet - Report', $content);
    }
}
