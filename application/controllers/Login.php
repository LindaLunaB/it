<?php
    require_once BASE_PATH . "application/models/User.php";
    require_once BASE_PATH . "application/models/Database.php";
    
    class Login extends Controller {
        private $User;
        private $Database;
        public function __construct(){
            $this->User = new User();
            $this->Database = new Database();
        }

        public function login(){
            $user = "mylove";
            $pass = "teamoa";

            $query = "SELECT * FROM users WHERE login = '$user'";
            $this->Database->query($query);
            $userDB = $this->Database->resultSet();

            if(count($userDB) == 0){
                echo json_encode("Lo sentimos, usuario o contraseña incorrectos");
                return;
            }

            if(!password_verify($pass, $userDB[0]["pass"])){
                echo json_encode("Lo sentimos, usuario o contraseña incorrectos");
                return;
            }

            echo json_encode(true);
        }

        public function register(){

            $nombre = "Linda Luna";
            $login = 'mylove';
            $pass = 'teamo';
            $idProfile = 1;
            
            $query = "SELECT * FROM users WHERE login = '$login'";
            $this->Database->query($query);
            $result = $this->Database->resultSet();

            if(count($result) > 0){
                echo json_encode("El usuario ya existe");
                return;
            }

            $user = $this->User->register($nombre,$login,$pass,$idProfile);
            echo json_encode($user);
        }
    }
?>