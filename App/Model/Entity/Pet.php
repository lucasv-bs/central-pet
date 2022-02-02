<?php
namespace App\Model\Entity;

use CentralPet\Database\Connection;
use CentralPet\Database\Repository;
use CentralPet\Database\Transaction;

class Pet {
    public $id;
    public $name;
    public $breed;
    public $birth_date;
    public $last_vaccine_date;

    public static function getPet($where = null, $order = null, $limit = null, $fields = '*') {
        Transaction::open();
        $result = (new Repository('pet'))->select($where, $order, $limit, $fields);
        Transaction::close();

        return $result;
    }


    public static function getPetByValue($value) {
        if (is_numeric($value)) {
            $where = "id = {$value}";
        }
        else {
            $where = "name like '%{$value}%'";
        }
        return self::getPet($where)->fetchObject(self::class);
    }


    public function getOwner() {

        Transaction::open();
        
        $owners_ids = (new Repository('owner_pet'))->select("pet_id = {$this->id}");
        $owner_id = $owners_ids->fetch();
        $owner = Owner::getOwnerByValue($owner_id['owner_id']);
        
        Transaction::close();

        return $owner;
    }

    
    public function setOwner($owner_id) {
        $owner_pet_id = (new Repository('owner_pet'))->insert([
            'pet_id' => $this->id,
            'owner_id' => $owner_id
        ]);

        return $owner_pet_id ? $owner_pet_id : false;
    }


    public function insert() {
        $this->id = (new Repository('pet'))->insert([
            'name' => $this->name,
            'breed' => $this->breed,
            'birth_date' => $this->birth_date,
            'last_vaccine_date' => $this->last_vaccine_date
        ]);

        return $this->id ? $this->id : false;
    }


    public function update() {
        return (new Repository('pet'))->update("id = {$this->id}", [
            'name' => $this->name,
            'breed' => $this->breed,
            'birth_date' => $this->birth_date,
            'last_vaccine_date' => $this->last_vaccine_date
        ]);
    }
}