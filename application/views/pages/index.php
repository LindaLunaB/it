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
    <header class="bg-white">
        <section class="container d-flex align-items-center justify-content-between">
            <div>
                <img src="<?= base_url ?>public/assets/images/logo-sm.png" width="60" alt="">
            </div>
            <div class="px-3 py-4 d-flex align-items-center" style="background-color: #f3f3f9">
                <img src="<?= base_url ?>public/assets/images/no_imagen.png" width="25" alt="">
                <span class="ps-3 fw-medium" style="color:#495057; font-size: 0.8125rem; ">JC Dev</span>
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
    <main class="pt-5">
        <section class="container bg-white p-3 rounded box-shadow">
            <div class="border border-light-subtle p-3 border-opacity-10">
                <h4 class="mb-0">Personal</h4>
            </div>
            <div class="border border-light-subtle p-3 border-opacity-10">
                <div class="row">
                    <div class="col-12 col-md-6 mb-3">
                        <label for="tipoBusqueda" class="form-label">Tipo de busqueda</label>
                        <select class="form-select" id="tipoBusqueda" aria-label="Default select example">
                            <option selected disabled>Seleccione una opción</option>
                            <?php foreach ($data['carpetas'] as $carpeta) { ?>
                                <option value="<?= $carpeta ?>"><?= $carpeta ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="tipoLibro" class="form-label">Tipo de libro</label>
                        <select class="form-select" id="tipoLibro" aria-label="Default select example">
                            <option selected disabled>Seleccione una opción</option>
                            <option value="tipoLibro">tipoLibro</option>
                            <option value="tipoLibro2">tipoLibro2</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                        <label for="anio" class="form-label">Año</label>
                        <select class="form-select" id="anio" aria-label="Default select example">
                            <option selected disabled>Seleccione una opción</option>
                            <option value="anio">anio</option>
                            <option value="anio2">anio2</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                        <label for="libro" class="form-label">Libro</label>
                        <select class="form-select" id="libro" aria-label="Default select example">
                            <option selected disabled>Seleccione una opción</option>
                            <option value="libro">libro</option>
                            <option value="libro2">libro2</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                        <label for="tomo" class="form-label">Tomo</label>
                        <select class="form-select" id="tomo" aria-label="Default select example">
                            <option selected disabled>Seleccione una opción</option>
                            <option value="tomo">tomo</option>
                            <option value="tomo2">tomo2</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                        <label for="fasciculo" class="form-label">Fasciculo</label>
                        <select class="form-select" id="fasciculo" aria-label="Default select example">
                            <option selected disabled>Seleccione una opción</option>
                            <option value="fasciculo">fasciculo</option>
                            <option value="fasciculo2">fasciculo2</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="border border-light-subtle p-2 border-opacity-10">
            </div>
            <div class="border border-light-subtle p-3 border-opacity-10">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">AÑO</th>
                                <th scope="col">LIBRO</th>
                                <th scope="col">TOMO</th>
                                <th scope="col">FASCICULO</th>
                                <th scope="col">CARPETA</th>
                                <th scope="col">DETALLE</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
    <?php if (isset($data['extra_js']))  echo $data['extra_js'] ?>
    <script src="<?= base_url ?>public/js/index.js"></script>
</body>
</html>