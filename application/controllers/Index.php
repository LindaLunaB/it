<?php

    require_once BASE_PATH . "application/controllers/Imagen.php";
    class Index extends Controller{

        private $Imagen;
        public function __construct(){
            $this->Imagen = new Imagen();
        }

        public function index(){

            $carpetas = $this->Imagen->getContentDirectory();
            $data = [
                "carpetas" => $carpetas,
                "extra_js" => "
                    <script>
                        const base_url = '" . base_url . "';
                    </script>
                "
            ];

            $this->view('pages/index', '', $data);
        }

        public function getDirectories(){
            $path = $_REQUEST['path'];
            
            $carpetas = $this->Imagen->getContentDirectory($path);

            echo json_encode($carpetas);
        }
    }
?>