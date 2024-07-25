<?php
    require_once BASE_PATH . 'application/models/Database.php';
    class Index extends Controller{

        public function __construct(){
        }

        public function index(){
            $database = new Database();

            $database->query("SELECT * FROM Apendice WHERE pnId = 1234232");
            $results = $database->resultSet();

            echo json_encode($results);
            return;
            $data = [];

            $this->view('layout', 'pages/index', $data);
           
        }
    }
?>