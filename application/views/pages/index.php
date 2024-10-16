<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio</title>
    <link rel="stylesheet" href="<?= base_url ?>public/bootstrap/bootstrap.min.css">
    <!-- Incluye el archivo de CSS de Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .user-session {
            display: flex;
            align-items: center;
        }

        .user-session span {
            margin-right: 10px;
            font-weight: bold;
        }

        .btn-logout {
            background-color: #f44336; /* Rojo para el botón de cerrar sesión */
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .btn-logout:hover {
            background-color: #d32f2f;
        }
        .box-shadow{
            -webkit-box-shadow: -1px 2px 33px -14px rgba(0,0,0,0.6);
            -moz-box-shadow: -1px 2px 33px -14px rgba(0,0,0,0.6);
            box-shadow: -1px 2px 33px -14px rgba(0,0,0,0.6);
        }
        :root{
            --primary : #852333;
        }
        .btn-primary {
            --bs-btn-color: #fff; 
            --bs-btn-bg: var(--primary); 
            --bs-btn-border-color: var(--primary);
            --bs-btn-hover-color: #fff; 
            --bs-btn-hover-bg: #73202E; 
            --bs-btn-hover-border-color: #6B1D28; 
            --bs-btn-focus-shadow-rgb: 133, 35, 51; 
            --bs-btn-active-color: #fff; 
            --bs-btn-active-bg: #6B1D28; 
            --bs-btn-active-border-color: #5A1823; 
            --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125); 
            --bs-btn-disabled-color: #fff; 
            --bs-btn-disabled-bg: #bda8a8; 
            --bs-btn-disabled-border-color: #bda8a8; 
            --bs-btn-disabled-opacity: 0.65; 
        }
        #pagination .page-item a {
            color: white; 
            background-color:#bda8a8 ; 
        }

     
        #pagination .page-item.active a {
            background-color: #852333;
            border-color: #852333;
        }

       
        :root{
            --primary : #852333;
        }
        /*
        .btn-primary {
            --bs-btn-bg: var(--primary);
            --bs-btn-border-color: var(--primary);
            --bs-btn-hover-bg: var(--primary);
            --bs-btn-hover-border-color: var(--primary);
            --bs-btn-active-bg: var(--primary);
            --bs-btn-active-border-color: var(--primary);
            --bs-btn-disabled-bg: var(--primary);
            --bs-btn-disabled-border-color: var(--primary);
        }*/
        .form-control:focus,
        .form-select:focus{
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgb(133, 35, 51, 0.25);
            
        }
       
        .dropdown_switch:checked + .dropdownoptions-filter .dropdown_select {
            transform: scaleY(1);
            opacity: 1;
        }

        .dropdown_switch:checked + .dropdownoptions-filter .dropdown_filter:after {
            transform: rotate(-135deg);
        }

        .dropdown__options-filter {
            width: 100%;
            cursor: pointer;
        }

        .dropdown__filter {
            border: var(--bs-border-width) solid var(--bs-border-color);
            border-radius: var(--bs-border-radius);
            list-style: none;
            position: relative;
            display: flex;
            padding: 6px 12px;
            color: #595959;
            background-color: #fff;
            font-size: 1rem;
            transition: 0.3s;
        }

        .dropdown__filter:focus {
            outline: none;
        }

        .dropdown__filter::after {
            position: absolute;
            top: 45%;
            right: 20px;
            content: '';
            width: 10px;
            height: 10px;
            border-right: 1px solid #595959;
            border-bottom: 1px solid #595959;
            transform: rotate(45deg) translateX(-45%);
            transition: 0.3s ease-in-out;
        }

        .dropdown__select {
            z-index: 100;
            background-color: white;
            position: absolute;
            border: var(--bs-border-width) solid var(--bs-border-color);
            top: 100%;
            left: 0;
            padding: 0px;
            width: 100%;
            margin-top: 5px;
            overflow: hidden;
            transform: scaleY(0);
            transform-origin: top;
            opacity: 0;
            transition: 0.2s ease-in-out;
        }

        .dropdown__select-option{
            padding: 6px 12px;
            list-style: none;
        }

        .dropdown__select-option:hover {
            color: white;
            background-color: var(--primary);
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
                <span class="ps-3 fw-medium" style="color:#495057; font-size: 0.8125rem; "><?= $data['nombre'] ?>
                   
                        <form action="<?php echo base_url; ?>login/logout" method="POST" class="d-inline ms-3">
                            <button type="submit" name="logout" class="btn btn-outline-secondary">
                                <i class="fas fa-sign-out-alt"></i> 
                            </button>
                        </form>
                </span>        
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
                <h4 class="mb-0">Tepeaca</h4>
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
                <div class="modal-body">
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