<?php

    require_once BASE_PATH . "application/controllers/Imagen.php";
    class Index extends Controller{

        private $Imagen;
        public function __construct(){
            $this->Imagen = new Imagen();
        }

        public function index(){

            $data = [
                "extra_js" => "
                    <script>
                        const base_url = '" . base_url . "';
                    </script>
                "
            ];

            $this->view('pages/index', '', $data);
        }

        public function queryBuilder(){
            $data = json_decode($_REQUEST['data']);
            $filters = $this->parseFilters($data);
            $results = $this->searchFiles($filters);
            echo json_encode($results);
        }

        protected function parseFilters($queryParams) {
            $filters = [];
        
            foreach ($queryParams as $key => $value) {
                $filters[$key][$value->condition] = $value->value;   
            }
        
            return $filters;
        }

        protected function searchFiles($filters) {
            $result = [];
            $base_path = BASE_PATH . "servidorArchivos/";
            $this->searchDirectory($base_path, $filters, 0, $result, []);

            $files = [];
            foreach ($result as $res) {
                $levels = ['oficina', 'tipo', 'libro', 'anio', 'tomo', 'fasciculo', 'archivo'];
                $file = explode("/",$res);
                foreach ($file as $key=>$fil) {
                    if($levels[$key] === 'archivo'){
                        $fil = $base_path . $res;
                    }
                    $newFile[$levels[$key]] = $fil;
                }
                $files[] = $newFile;
            }
            return $files;
        }

        protected function searchDirectory($directory, $filters, $level, &$result, $currentPath = []) {
            $levels = ['oficina', 'tipo', 'libro', 'anio', 'tomo', 'fasciculo'];
            $currentLevel = $levels[$level] ?? null;

            if ($currentLevel && isset($filters[$currentLevel]) && count($filters[$currentLevel]) > 0) {
                $dirIterator = new DirectoryIterator($directory);

                foreach ($dirIterator as $fileinfo) {
                    if ($fileinfo->isDot()) continue;

                    if ($fileinfo->isDir()) {
                        $folderName = $fileinfo->getFilename();

                        if ($this->matchesFilters($folderName, $filters[$currentLevel])) {
                            $newPath = array_merge($currentPath, [$folderName]);
                            $this->searchDirectory($fileinfo->getPathname(), $filters, $level + 1, $result, $newPath);
                        }
                    }
                }
            } else {
                $dirIterator = new DirectoryIterator($directory);

                foreach ($dirIterator as $fileinfo) {
                    if ($fileinfo->isDot()) continue;

                    if ($fileinfo->isDir()) {
                        $newPath = array_merge($currentPath, [$fileinfo->getFilename()]);
                        $this->searchDirectory($fileinfo->getPathname(), $filters, $level + 1, $result, $newPath);
                    } elseif ($fileinfo->getExtension() === 'pdf') {
                        // Añadir los archivos PDF encontrados
                        $result[] = implode(DIRECTORY_SEPARATOR, array_merge($currentPath, [$fileinfo->getFilename()]));
                    }
                }
            }
        }

        protected function matchesFilters($folderName, $conditions) {
            foreach ($conditions as $condition => $value) {
                if (!$this->matchesFilter($folderName, $condition, $value)) {
                    return false;
                }
            }
            return true;
        }

        protected function matchesFilter($folderName, $condition, $value) {
            switch ($condition) {
                case 'igual a':
                    return $folderName === $value;
                case 'no igual a':
                    return $folderName !== $value;
                case 'mayor que':
                    return $folderName > $value;
                case 'menor que':
                    return $folderName < $value;
                case 'mayor o igual a':
                    return $folderName >= $value;
                case 'menor o igual a':
                    return $folderName <= $value;
                default:
                    return false;
            }
        }

        public function viewFile(){
            $filePath = $_REQUEST["file"];
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf'); // Cambia el tipo MIME si el archivo no es un PDF
            header('Content-Disposition: inline; filename="' . basename($filePath) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));
            readfile($filePath);
            exit;
        }
    }
?>