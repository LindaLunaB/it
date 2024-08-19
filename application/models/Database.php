<?php
    class Database{

        private $db_host = DB_HOST;
        private $db_name = DB_NAME;
        private $db_user = DB_USER;
        private $db_pass = DB_PASSWORD;

        private $conn;
        private $err;
        private $stmt;
        public function __construct(){
            $dsn = "sqlsrv:Server=$this->db_host;Database=$this->db_name";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ];

            try{
                
                $this->conn = new PDO($dsn, $this->db_user, $this->db_pass, $options);
            }catch (Exception $e){
                $this->err = $e->getMessage();
                echo $this->err;
            }
        }

        public function query($sql){
            $this->stmt = $this->conn->prepare($sql);
        }

        public function execute(){
            return $this->stmt->execute();
        }

        public function resultSet(){
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>