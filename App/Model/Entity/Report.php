<?php
namespace App\Model\Entity;

use CentralPet\Database\Connection;
use CentralPet\Database\Repository;
use CentralPet\Database\Transaction;

class Report {
    public static function getAppointmentList() {
        Transaction::open();
        $result = (new Repository('vw_appointment_list'))->select();
        Transaction::close();

        return $result;
    }


    public static function getOwnerPetList() {
        Transaction::open();
        $result = (new Repository('vw_owner_pet_list'))->select();
        Transaction::close();

        return $result;
    }
}