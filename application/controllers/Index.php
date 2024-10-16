<?php
    //require_once BASE_PATH . "application/libraries/FPDI.php";
    require_once BASE_PATH . "application/libraries/JWT.php";

    use setasign\Fpdi\Fpdi;
    use setasign\Fpdf\Fpdf;
    class Index extends Controller{

        private $levels;

        public function __construct(){
        }

        public function index(){//validacion de token
           $token = JSONWT::validateToken($_SESSION['token']);
            if(!isset($_SESSION['token']) || !$token ){
                header('Location: ' . base_url . 'login');
            }

            $data = [
                "nombre" => $token->nombre,
                "extra_js" => "
                    <script>
                        const base_url = '" . base_url . "';
                    </script>
                "
            ];

            $this->view('pages/index', '', $data);
            
        }

        public function pdfJS(){
            $token = $_REQUEST['file'] ?? '';
            $file = JSONWT::validateToken($token);
            if(!$file){
                header('Location: ' . base_url . 'errors/404');
                exit;
            }
            $url = base_url . 'index/viewFile?file=' . $token . '#toolbar=0';
            $data = [
                "url" => $url,
                "extra_js" => "
                    <script>
                        const base_url = '" . base_url . "';
                    </script>
                "
            ];

            $this->view('pages/pdfjs', '', $data);
        }

        public function queryBuilder(){
            $data = json_decode($_REQUEST['data']);
            $this->levels = json_decode($_REQUEST['levels']);
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
            //Cambiar $base_path al servidor de archivos
            //$base_path = BASE_PATH . 'servidor';
            $base_path = FILES_HOST;
            $this->searchDirectory($base_path, $filters, 0, $result, []);

            $files = [];
            $levels = $this->levels;
            foreach ($result as $res) {
                $pathParts = explode('\\', $res);
                $mappedLevels = [];
                $lastPart = end($pathParts);
                if (strpos($lastPart, '.') !== false) {
                    $res = str_replace('\\', '/', $res);
                    $res = JSONWT::generateToken(['archivo' => $res]);
                    $mappedLevels['archivo'] = $res['token'];
                    $mappedLevels['name'] = $lastPart;
                }

                foreach ($levels as $index => $level) {
                    if (isset($pathParts[$index])) {
                        $mappedLevels[$level] = $pathParts[$index];
                    }
                }
                $files[] = $mappedLevels;
            }
            return $files;
        }

        protected function searchDirectory($directory, $filters, $level, &$result, $currentPath = []) {
            $levels = $this->levels;
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
                    } elseif ($this->isValidateExtension($fileinfo->getExtension())) {
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
            $token = $_REQUEST['file'];
            
            $file = JSONWT::validateToken($token);
                
            if(!$file){
              
                header('Location: ' . base_url . 'errors/404');

                exit;
            }
           
            $file = $file->archivo;
        
            $filePath = FILES_HOST . "//" . $file;
            //$filePath = BASE_PATH . "public/$file";
            $filePath = realpath($filePath);
          
            if(file_exists($filePath)) {
                
                $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
               
                $mimeTypes = [
                    "pdf" => "application/pdf",
                    "jpg" => "image/jpeg"
                ];
                

                if(isset($mimeTypes[$fileExtension])) {

                    if($fileExtension === 'pdf'){
                        $pdf = new FPDI();
                        $pageCount = $pdf->setSourceFile($filePath);

                        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                            $tplIdx = $pdf->importPage($pageNo);
                            $pdf->AddPage();
                            $pdf->useTemplate($tplIdx, 0, 0, 210);
                            $pdf->Image(base_url . 'public/assets/images/informativo.png', 10, 10, 190);
                        }

                        $pdf->Output('I', 'watermarked_' . basename($filePath));
                    }elseif($fileExtension === 'jpg'){
                   
                        $pdf = new \FPDF();

                        $pdf->AddPage();
                        list($width, $height) = getimagesize($filePath);
                        

                        $pdf->Image($filePath, 0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight(), 'JPG'); // cargando archivo
                        
                        $pdf->Image(base_url . 'public/assets/images/informativo.png', 10, 10, 190);// marca_de agua
                       
                        
                        $pdf->Output('I', 'converted_' . basename($filePath) . '.pdf');
                    }
                }else{
                    header('HTTP/1.1 415 Unsupported Media Type');
                    echo "Tipo de archivo no soportado.";
                }
            } else {
                header('HTTP/1.1 404 Not Found');
                echo "Archivo no encontrado.";
            }
        }

        protected function isValidateExtension($extension){
            $extensions = ['pdf', 'jpg'];
            $extension = strtolower($extension);

            return in_array($extension, $extensions);
        }
    }
?>