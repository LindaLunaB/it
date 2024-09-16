<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
                    <div class="col-12 col-md-3 mb-3 d-flex align-items-center justify-content-center">
                        <p class="mb-0">Oficina</p>
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                          <select class="form-select" id="oficinaSelect" aria-label="Default select example">
                            <option selected disabled>Seleccione una opción</option>
                          <option value="igual a">igual a</option>
                            <option value="no igual a">no igual a</option>
                            <option value="mayor que">mayor que</option>
                            <option value="menor que">menor que</option>
                            <option value="mayor o igual a">mayor o igual a</option>
                            <option value="menor o igual a">menor o igual a</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                       <input class="form-control" id="oficina" type="text" >
                    </div>
                    <div class="col-12 col-md-3 mb-3 d-flex align-items-center justify-content-center">
                        <button id="oficinaButton" class="btn btn-light">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <path fill="currentColor" d="m14.03 1.889l9.657 9.657l-8.345 8.345l-.27.27H20v2H6.747l-3.666-3.666a4 4 0 0 1 0-5.657l10.95-10.95Zm.322 16.163l6.507-6.506l-6.829-6.829l-6.828 6.829l6.828 6.828l.32-.323l.002.001ZM5.788 12.96l-1.293 1.293a2 2 0 0 0 0 2.828l3.08 3.08h4.68l.366-.368l-6.833-6.833Z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="col-12 col-md-3 mb-3 d-flex align-items-center justify-content-center">
                        <p class="mb-0">Tipo Libro</p>
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                        <select class="form-select" id="tipoSelect" aria-label="Default select example">
                            <option selected disabled>Seleccione una opción</option>
                            <option value="igual a">igual a</option>
                            <option value="no igual a">no igual a</option>
                            <option value="mayor que">mayor que</option>
                            <option value="menor que">menor que</option>
                            <option value="mayor o igual a">mayor o igual a</option>
                            <option value="menor o igual a">menor o igual a</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                        <input class="form-control" id="tipo" type="text" placeholder ="Apendices/Inscripciones">
                    </div>
                    <div class="col-12 col-md-3 mb-3 d-flex align-items-center justify-content-center">
                        <button id="tipoButton" class="btn btn-light">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <path fill="currentColor" d="m14.03 1.889l9.657 9.657l-8.345 8.345l-.27.27H20v2H6.747l-3.666-3.666a4 4 0 0 1 0-5.657l10.95-10.95Zm.322 16.163l6.507-6.506l-6.829-6.829l-6.828 6.829l6.828 6.828l.32-.323l.002.001ZM5.788 12.96l-1.293 1.293a2 2 0 0 0 0 2.828l3.08 3.08h4.68l.366-.368l-6.833-6.833Z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="col-12 col-md-3 mb-3 d-flex align-items-center justify-content-center">
                        <p class="mb-0">Libro</p>
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                        <select class="form-select" id="libroSelect" aria-label="Default select example">
                            <option selected disabled>Seleccione una opción</option>
                            <option value="igual a">igual a</option>
                            <option value="no igual a">no igual a</option>
                            <option value="mayor que">mayor que</option>
                            <option value="menor que">menor que</option>
                            <option value="mayor o igual a">mayor o igual a</option>
                            <option value="menor o igual a">menor o igual a</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                        <input class="form-control" id="libro" type="text" placeholder ="05">
                    </div>
                    <div class="col-12 col-md-3 mb-3 d-flex align-items-center justify-content-center">
                        <button id="libroButton" class="btn btn-light">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <path fill="currentColor" d="m14.03 1.889l9.657 9.657l-8.345 8.345l-.27.27H20v2H6.747l-3.666-3.666a4 4 0 0 1 0-5.657l10.95-10.95Zm.322 16.163l6.507-6.506l-6.829-6.829l-6.828 6.829l6.828 6.828l.32-.323l.002.001ZM5.788 12.96l-1.293 1.293a2 2 0 0 0 0 2.828l3.08 3.08h4.68l.366-.368l-6.833-6.833Z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="col-12 col-md-3 mb-3 d-flex align-items-center justify-content-center">
                        <p class="mb-0">Año</p>
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                        <select class="form-select" id="anioSelect" aria-label="Default select example">
                            <option selected disabled>Seleccione una opción</option>
                            <option value="igual a">igual a</option>
                            <option value="no igual a">no igual a</option>
                            <option value="mayor que">mayor que</option>
                            <option value="menor que">menor que</option>
                            <option value="mayor o igual a">mayor o igual a</option>
                            <option value="menor o igual a">menor o igual a</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                        <input class="form-control" id="anio" type="text" placeholder="1950">
                    </div>
                    <div class="col-12 col-md-3 mb-3 d-flex align-items-center justify-content-center">
                        <button id="anioButton" class="btn btn-light">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <path fill="currentColor" d="m14.03 1.889l9.657 9.657l-8.345 8.345l-.27.27H20v2H6.747l-3.666-3.666a4 4 0 0 1 0-5.657l10.95-10.95Zm.322 16.163l6.507-6.506l-6.829-6.829l-6.828 6.829l6.828 6.828l.32-.323l.002.001ZM5.788 12.96l-1.293 1.293a2 2 0 0 0 0 2.828l3.08 3.08h4.68l.366-.368l-6.833-6.833Z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="col-12 col-md-3 mb-3 d-flex align-items-center justify-content-center">
                        <p class="mb-0">Tomo</p>
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                        <select class="form-select" id="tomoSelect" aria-label="Default select example">
                            <option selected disabled>Seleccione una opción</option>
                            <option value="igual a">igual a</option>
                            <option value="no igual a">no igual a</option>
                            <option value="mayor que">mayor que</option>
                            <option value="menor que">menor que</option>
                            <option value="mayor o igual a">mayor o igual a</option>
                            <option value="menor o igual a">menor o igual a</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                        <input class="form-control" id="tomo" type="text" placeholder ="000000015">
                    </div>
                    <div class="col-12 col-md-3 mb-3 d-flex align-items-center justify-content-center">
                        <button id="tomoButton" class="btn btn-light">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <path fill="currentColor" d="m14.03 1.889l9.657 9.657l-8.345 8.345l-.27.27H20v2H6.747l-3.666-3.666a4 4 0 0 1 0-5.657l10.95-10.95Zm.322 16.163l6.507-6.506l-6.829-6.829l-6.828 6.829l6.828 6.828l.32-.323l.002.001ZM5.788 12.96l-1.293 1.293a2 2 0 0 0 0 2.828l3.08 3.08h4.68l.366-.368l-6.833-6.833Z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="col-12 col-md-3 mb-3 d-flex align-items-center justify-content-center">
                        <p class="mb-0">Fasciculo</p>
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                        <select class="form-select" id="fasciculoSelect" aria-label="Default select example">
                            <option selected disabled>Seleccione una opción</option>
                            <option value="igual a">igual a</option>
                            <option value="no igual a">no igual a</option>
                            <option value="mayor que">mayor que</option>
                            <option value="menor que">menor que</option>
                            <option value="mayor o igual a">mayor o igual a</option>
                            <option value="menor o igual a">menor o igual a</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-3 mb-3 align-items-center justify-content-center">
                        <input class="form-control" id="fasciculo" type="text">
                    </div>
                    <div class="col-12 col-md-3 mb-3 d-flex align-items-center justify-content-center">
                        <button id="fasciculoButton" class="btn btn-light">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <path fill="currentColor" d="m14.03 1.889l9.657 9.657l-8.345 8.345l-.27.27H20v2H6.747l-3.666-3.666a4 4 0 0 1 0-5.657l10.95-10.95Zm.322 16.163l6.507-6.506l-6.829-6.829l-6.828 6.829l6.828 6.828l.32-.323l.002.001ZM5.788 12.96l-1.293 1.293a2 2 0 0 0 0 2.828l3.08 3.08h4.68l.366-.368l-6.833-6.833Z"/>
                            </svg>
                        </button>
                    </div>
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
                        <thead>
                            <tr>
                                <th scope="col">Oficina</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Libro</th>
                                <th scope="col">Año</th>
                                <th scope="col">Tomo</th>
                                <th scope="col">Fasciculo</th>
                                <th scope="col">Archivo</th>
                            </tr>
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
    </main>
    <?php if (isset($data['extra_js']))  echo $data['extra_js'] ?>
    <script src="<?= base_url ?>public/js/index.js"></script>
</body>
</html>