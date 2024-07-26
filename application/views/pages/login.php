<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="shortcut icon" href="<?= base_url ?>public/assets/images/icono.ico">
    <link href="<?= base_url ?>public/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url ?>public/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url ?>public/assets/css/app.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-overlay"></div>
        <div class="auth-page-content overflow-hidden pt-lg-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card overflow-hidden">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="p-lg-5 auth-one-bg p-4 h-100" style="background-image:url(<?= base_url ?>public/assets/images/auth-one-bg.jpg);background-position:center;background-size:cover">
                                        <div class="bg-overlay"></div>
                                        <div class="position-relative h-100 d-flex flex-column">
                                            <div class="mb-4">
                                                <a href="<?= base_url ?>login" class="d-block">
                                                    <img src="<?= base_url ?>public/assets/images/logo-sm.png" alt="" height="120">
                                                </a>
                                            </div>
                                            <div class="mt-auto">
                                                <div id="qoutescarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                                    <div class="carousel-inner text-left pb-5">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4">
                                        <h1 class="mt-3 mb-5 text-primary text-center display-6"><strong>Visualizador</strong></h1>
                                        <div>
                                            <h5 class="text-primary">!Bienvenido!</h5>
                                            <p class="text-muted">Ingrese Sesión con su Correo Institucional.</p>
                                        </div>
                                        <div class="mt-4">
                                            <div class="mb-3">
                                                <label class="form-label">Correo Electronico</label>
                                                <input type="text" class="form-control" id="usuario" placeholder="Ingrese Correo Electronico">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" >Contraseña</label>
                                                <div class="position-relative auth-pass-inputgroup mb-3">
                                                    <input type="password" class="form-control pe-5" placeholder="Ingrese Contraseña" id="password">
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <button class="btn btn-primary w-100" id="login">Acceder</button>
                                            </div>
                                            <div id="error_feedback" class="alert alert-danger mt-4 d-none" role="alert">
                                                A simple danger alert—check it out!
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 fs-5 text-muted">&copy;
                                <script>document.write(new Date().getFullYear())</script> IRCEP -  Todos los derechos resevados.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="<?= base_url ?>public/js/login.js"></script>
</body>
</html>