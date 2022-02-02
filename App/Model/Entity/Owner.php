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


    public function setPet($pet_id) {
        $owner_pet_id = (new Repository('owner_pet'))->insert([
            'owner_id' => $this->id,
            'pet_id' => $pet_id            
        ]);

        return $owner_pet_id ? $owner_pet_id : false;
    }


    public function insert() {
        $this->id = (new Repository('owner'))->insert([
            'name' => $this->name,
            'birth_date' => $this->birth_date,
            'document_number' => $this->document_number,
            'phone' => $this->phone,
            'email' => $this->email,
            'postal_code' => $this->postal_code,
            'address' => $this->address,
            'state' => $this->state,
            'city' => $this->city
        ]);

        return $this->id ? $this->id : false;
    }


    public function update() {
        return (new Repository('owner'))->update("id = {$this->id}", [
            'name' => $this->name,
            'birth_date' => $this->birth_date,
            'document_number' => $this->document_number,
            'phone' => $this->phone,
            'email' => $this->email,
            'postal_code' => $this->postal_code,
            'address' => $this->address,
            'state' => $this->state,
            'city' => $this->city
        ]);
    }
}