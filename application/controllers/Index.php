<?php
    require_once BASE_PATH . "application/libraries/FPDI.php";

    use setasign\Fpdi\Fpdi;
    use setasign\Fpdf\Fpdf;
    class Index extends Controller{

        private $levels;

        public function __construct(){
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
            $newFile = [];
            $result = [];
            $base_path = BASE_PATH . 'servidor';
            $this->searchDirectory($base_path, $filters, 0, $result, []);

            $files = [];
            $levels = $this->levels;
            foreach ($result as $res) {
                $pathParts = explode('/', $res);
                $mappedLevels = [];
                $lastPart = end($pathParts);
                if (strpos($lastPart, '.') !== false) {
                    $mappedLevels['archivo'] = array_pop($pathParts);
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
                    } elseif ($fileinfo->getExtension() === 'pdf') {
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
            $filePath = FILES_HOST . "//" . $_REQUEST["file"];
            $filePath = realpath($filePath);
            if(file_exists($filePath)) {
                $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

                $mimeTypes = [
                    "pdf" => "application/pdf"
                ];

                $pdf = new FPDI();
                $pageCount = $pdf->setSourceFile($filePath);
                if(isset($mimeTypes[$fileExtension])) {

                    $pdf = new FPDIExtended();
                    $pageCount = $pdf->setSourceFile($filePath);

                    for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                        $tplIdx = $pdf->importPage($pageNo);
                        $pdf->AddPage();
                        $pdf->useTemplate($tplIdx, 0, 0, 210);
                        $pdf->Image(base_url . 'public/assets/images/informativo.png', 10, 10, 190);
                    }

                    $pdf->Output('I', 'watermarked_' . basename($filePath));
                }else{
                    header('HTTP/1.1 415 Unsupported Media Type');
                    echo "Tipo de archivo no soportado.";
                }
            } else {
                header('HTTP/1.1 404 Not Found');
                echo "Archivo no encontrado.";
            }
        }
    }
?>