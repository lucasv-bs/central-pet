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
}