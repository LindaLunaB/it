<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio</title>
    <link rel="stylesheet" href="<?= base_url ?>public/bootstrap/bootstrap.min.css">
    <style>
        .box-shadow{
            -webkit-box-shadow: -1px 2px 33px -14px rgba(0,0,0,0.6);
            -moz-box-shadow: -1px 2px 33px -14px rgba(0,0,0,0.6);
            box-shadow: -1px 2px 33px -14px rgba(0,0,0,0.6);
        }
    </style>
</head>
<body class="bg-secondary-subtle">
    <div id="loader" class="position-absolute w-100 z-1 d-none">
        <div class="d-flex justify-content-center align-items-center vh-100 bg-white opacity-50">
            <div class="spinner-border" role="status" id="loading">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    <header class="bg-white">
        <section class="container d-flex align-items-center justify-content-between">
            <div>
                <img src="<?= base_url ?>public/assets/images/logo-sm.png" width="60" alt="">
            </div>
            <div class="px-3 py-4 d-flex align-items-center" style="background-color: #f3f3f9">
                <img src="<?= base_url ?>public/assets/images/no_imagen.png" width="25" alt="">
                <span class="ps-3 fw-medium" style="color:#495057; font-size: 0.8125rem; ">Usuario</span>
            </div>
        </section>
        <hr class="text-secondary my-0">
        <section class="container py-2">
            <div class="d-flex">
                <ul class="navbar-nav">
                    <li class="nav-item d-flex align-items-center">
                        <svg class="text-secondary" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 16 16">
                            <path fill="currentColor" d="m8.13 1.229l5.5 4.47a1 1 0 0 1 .37.777V14a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6.476a1 1 0 0 1 .37-.776l5.5-4.471a1 1 0 0 1 1.26 0M13 6.476L7.5 2.005L2 6.475V14h11z"/>
                        </svg>
                        <a href="#" class="text-decoration-none ps-1 text-secondary" href="nav-link">Inicio</a>
                    </li>
                </ul>
            </div>
        </section>
        <hr class="text-secondary my-0">
    </header>
    <main class="pt-5 position-relative">
        <section class="container bg-white p-3 rounded box-shadow">
            <div class="border border-light-subtle p-3 border-opacity-10">
                <h4 class="mb-0">Usuario</h4>
            </div>
            <div class="border border-light-subtle p-3 border-opacity-10">
                <div id="contenedor" class="row">
                </div>
                <div class="row d-flex align-items-center justify-content-center mt-3">
                    <div class="col-12 alert alert-danger d-none" role="alert" id="alert_errors">
                    </div>
                    <button type="button" class="btn btn-primary col-12" id="enviar">Enviar</button>
                </div>
            </div>
            <div class="border border-light-subtle p-2 border-opacity-10">
            </div>
            <div class="border border-light-subtle p-3 border-opacity-10">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead id="thead">
                        </thead>
                        <tbody id="tbody">
                        </tbody>
                    </table>
                    <nav>
                        <ul id="pagination" class="pagination justify-content-center">
                        </ul>
                    </nav>
                </div>
            </div>
        </section>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="height: 500px">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModalCompare" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Comparador de archivos</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="height: 1000px">
                    <p class="text-center">Archivos seleccionados para comparación:</p>
                    <div style="overflow-x: auto;" id="content_files" class="d-flex my-3 p-3">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="text-center">Primer archivo</p>
                            <embed id="primer_archivo" src="" width="100%" height="750" frameborder="0">
                        </div>
                        <div class="col-md-6">
                            <p class="text-center">Segundo archivo</p>
                            <embed id="segundo_archivo" src="" width="100%" height="750" frameborder="0">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>
    </main>
    <script src="<?= base_url ?>public/bootstrap/bootstrap.min.js"></script>
    <?php if (isset($data['extra_js']))  echo $data['extra_js'] ?>
    <script src="<?= base_url ?>public/js/index.js"></script>
</body>
</html>