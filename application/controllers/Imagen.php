<?php
    //require_once BASE_PATH."application/models/DataBase.php";
    
    
    class Imagen extends Controller {
        public function __construct(){}
         public function imagen(){
            $path ="/Apendices/02/1954/000000041/00";
            echo json_encode($this->getContentDirectory($path));
         }
       
  
       

        function getContentDirectory($path) {
            $url = FILES_HOST . $path;

            if(!is_dir($url)){
                return false;
            }

            $arrFiles = [];
            $files = scandir($url);
            foreach ($files as $file) {
                if ($file != "."&& $file != "..") {
                    $arrFiles[] = $file;
                }
            }

            return $arrFiles;
        }
    }
?>