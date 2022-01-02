<?php
namespace CentralPet\Database;

use PDO;
use Exception;

final class Connection {
    private function __construct() {}

    public static function open() {
        $db_host = (null !== getenv('DB_HOST')) ? getenv('DB_HOST') : NULL;
        $db_port = (null !== getenv('DB_PORT')) ? getenv('DB_PORT') : NULL;
        $db_name = (null !== getenv('DB_NAME')) ? getenv('DB_NAME') : NULL;
        $db_user = (null !== getenv('DB_USER')) ? getenv('DB_USER') : NULL;
        $db_pass = (null !== getenv('DB_PASS')) ? getenv('DB_PASS') : NULL;

        $conn = new PDO("mysql:host={$db_host}; port={$db_port}; dbname={$db_name}", $db_user, $db_pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    }
}