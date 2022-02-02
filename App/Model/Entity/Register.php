<?php
namespace App\Model\Entity;

use App\Model\Entity\Owner;
use App\Model\Entity\Pet;

use CentralPet\Database\Connection;
use CentralPet\Database\Repository;
use CentralPet\Database\Transaction;

class Register {
    public static function setNewRegister($data) {
        $pet = new Pet;
        $owner = new Owner;

        $pet->name = $data['pet_name'];
        $pet->breed = $data['breed'];
        $pet->birth_date = $data['pet_birth_date'];
        $pet->last_vaccine_date = $data['last_vaccine_date'] ? $data['last_vaccine_date'] : '';
        
        $owner->name = $data['owner_name'];
        $owner->birth_date = $data['owner_birth_date'];
        $owner->document_number = $data['document_number'];
        $owner->phone = $data['phone'];
        $owner->email = $data['email'];
        $owner->postal_code = $data['postal_code'];
        $owner->address = $data['address'];
        $owner->state = $data['state'];
        $owner->city = $data['city'];

        Transaction::open();
        if ( !$pet->insert() || !$owner->insert() || !$owner->setPet($pet->id) ) {
            Transaction::rollback();
            return false;
        }

        Transaction::close();

        return $pet->id;
    }


    public static function setRegisterEdit($data, $pet_id) {        
        $pet = Pet::getPetByValue($pet_id);        
        $pet->name = $data['pet_name'];
        $pet->breed = $data['breed'];
        $pet->birth_date = $data['pet_birth_date'];
        $pet->last_vaccine_date = $data['last_vaccine_date'] ? $data['last_vaccine_date'] : $pet->last_vaccine_date;
        
        $owner = $pet->getOwner();
        $owner->name = $data['owner_name'];
        $owner->birth_date = $data['owner_birth_date'];
        $owner->document_number = $data['document_number'];
        $owner->phone = $data['phone'];
        $owner->email = $data['email'];
        $owner->postal_code = $data['postal_code'];
        $owner->address = $data['address'];
        $owner->state = $data['state'];
        $owner->city = $data['city'];

        Transaction::open();
        if ( !$pet->update() || !$owner->update() ) {
            Transaction::rollback();
            return false;
        }

        Transaction::close();
        
        return true;
    }
}