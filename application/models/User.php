<?php
    //require_once BASE_PATH . "application/models/Database.php";
    class User{
        private $Database;
        public function __construct(){
            //$this->Database = new Database();
        }

        public function register($nombre, $login, $pass, $idProfile){

            $password = password_hash($pass, PASSWORD_DEFAULT);

            $query = "INSERT INTO users (nombre, login, pass, idProfile) VALUES ('$nombre', '$login', '$password', $idProfile)";

            $this->Database->query($query);
            $result = $this->Database->execute();

            return $result;
        }
    }
?>