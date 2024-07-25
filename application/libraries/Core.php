<?php
    class Core{
        protected $actualController = 'Index';
        protected $actualMethod = 'index';
        protected $parameters = [];


        //Constructor
        public function __construct(){
            
            $urls = $this->getUrl();
            $controllerPath = BASE_PATH . 'application/controllers/';
            $params = [];

            /* echo json_encode($controllerPath);
            return; */

            if ($urls) {
                foreach ($urls as $url) {
                    $controllerPath .= ucwords($url);
        
                    if (file_exists($controllerPath . '.php')) {
                        $controllerPath .= '.php';
                        $this->actualController = ucwords($url);
                        break;
                    } elseif ($url !== end($urls)) {
                        $controllerPath .= '/';
                    }
                }
            } else {
                $controllerPath .= 'Index.php';
            }
        
            // Manejo de la respuesta 404
            if (!file_exists($controllerPath)) {
                $this->handle404();
                return;
            }
        
            // Si es un directorio, apuntar al archivo Index.php
            if (is_dir($controllerPath)) {
                $controllerPath .= '/Index.php';
            }
        
            // Requerir el controlador
            require_once $controllerPath;
            $this->actualController = new $this->actualController;
            
            if($urls != null){
                $paths = explode('/',str_replace('.php', '', str_replace(BASE_PATH . 'application/controllers/', '', $controllerPath)));
                $paths = array_map('strtolower', $paths);
                $urls = array_map('strtolower', $urls);
                foreach ($paths as $path) {
                    if(in_array($path, $urls)){
                        $index = array_search($path, $urls);
                        unset($urls[$index]);
                    }
                }
                $urls = array_values($urls);
            }
        
            // Verificar el método y obtener los parámetros
            if (isset($urls[0]) && method_exists($this->actualController, $urls[0])) {
                $this->actualMethod = $urls[0];
                unset($urls[0]);
            }

            $this->parameters = $urls ? array_values($urls) : [];
        
            // Llamar a la función de devolución con los parámetros
            call_user_func_array([$this->actualController, $this->actualMethod], $this->parameters);
            
        }

        private function handle404() {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                header('Location: ' . base_url . 'errors/404');
            } else {
                http_response_code(404);
                $response = [
                    'status' => false,
                    'message' => 'Lo sentimos, página no encontrada.'
                ];
        
                echo json_encode($response);
            }
        }

        public function getUrl(){
            if(isset($_GET['url'])){
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
        }
    }
?>