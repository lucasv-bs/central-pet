<?php
namespace App\Model\Entity;

use CentralPet\Database\Connection;
use CentralPet\Database\Repository;
use CentralPet\Database\Transaction;

class Owner {
    public $id;
    public $name;
    public $birth_date;
    public $document_number;
    public $phone;
    public $email;
    public $postal_code;
    public $address;
    public $state;
    public $city;

    public static function getOwner($where = null, $order = null, $limit = null, $fields = '*') {
        Transaction::open();
        $result = (new Repository('owner'))->select($where, $order, $limit, $fields);
        Transaction::close();

        return $result;
    }

    public static function getOwnerByValue($value) {
        if (is_numeric($value)) {
            $where = "id = {$value} OR document_number = {$value}";
        }
        else {
            $where = "name like '%{$value}%'";
        }
        return self::getOwner($where)->fetchObject(self::class);
    }

    public function getPets() {
        $pet_list = [];

        Transaction::open();
        $pets_ids = (new Repository('owner_pet'))->select("owner_id = {$this->id}");
        while($pet_id = $pets_ids->fetch()) {
            $pet_list[] = Pet::getPetByValue($pet_id['pet_id']);
        }
        Transaction::close();

        return $pet_list;
    }
}