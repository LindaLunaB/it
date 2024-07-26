<?php
    class Index extends Controller{

        public function __construct(){
        }

        public function index(){
            $data = [];

            $this->view('pages/index', '', $data);
        }
    }
?>