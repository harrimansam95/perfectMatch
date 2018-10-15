<?php
class Database {
    private static $dsn = 'mysql:host=localhost;dbname=perfectmatch';
    private static $username = 'root';
    private static $password = '';
    private static $con;

    private function __construct() {}

    public static function getDB () {
        if (!isset(self::$con)) {
            try {
                self::$con = mysqli_connect("localhost", self::$username, self::$password, "perfectmatch");
                        } catch (PDOException $e) {
                $error_message = $e->getMessage();
                include('../errors/database_error.php');
                exit();
            }
        }
        return self::$con;
    }
}
?>