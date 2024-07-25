<?php
    class Controller {

        public function view($layout, $vista, $data = [], $header = NULL, $footer = NULL){
            if(file_exists('../application/views/layouts/' . $layout . '.php')){
                require_once '../application/views/layouts/' . $layout . '.php';
            }else{
                die('El layout no existe');
            }
        }

    }
?>