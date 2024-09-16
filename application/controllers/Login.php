<?php
    require_once BASE_PATH . "application/models/User.php";
    //require_once BASE_PATH . "application/models/Database.php";
    require_once BASE_PATH . "application/libraries/JWT.php";
    
    class Login extends Controller {
        private $User;
        private $Database;

        public function __construct(){
            $this->User = new User();
            //$this->Database = new Database();
        }

        public function index(){
            if(isset($_SESSION['token']) && JSONWT::validateToken($_SESSION['token'])){
                header('Location: ' . base_url);
            }
            $data = [];
            $this->view('pages/login', '', $data);
        }

        public function login(){
            $password = password_hash('12345', PASSWORD_DEFAULT);
            $userDB = [
                [
                    'usuario' => 'carlos@mail.com',
                    'pass' => $password
                ]
            ];

            $user= $_POST['usuario'];
            $pass= $_POST['password'];

            /* $query = "SELECT * FROM users WHERE login = '$user'";
            $this->Database->query($query);
            $userDB = $this->Database->resultSet(); */

            if(count($userDB) == 0){
                echo json_encode("Lo sentimos, usuario o contraseña incorrectos");
                return;
            }

            if(!password_verify($pass, $userDB[0]["pass"])){
                echo json_encode("Lo sentimos, usuario o contraseña incorrectos");
                return;
            }

            $data = [
                'usuario' => $userDB[0]['usuario'],
                'nombre' => 'Carlos'
            ];

            $token = JSONWT::generateToken($data, 3000);

            $_SESSION['token'] = $token['token'];

            echo json_encode($token);
            return;
        }

        public function register(){

            $nombre = "Linda Luna";
            $login = 'linda@mail.com';
            $pass = '12345';
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