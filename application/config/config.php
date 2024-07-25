<?php
    define('BASE_PATH', realpath(dirname(__FILE__) . '/../..').'/');
    define('base_url', $_ENV['BASE_URL']);

    define('FILES_HOST', $_ENV['FILES_HOST']);

    //Configuración de acceso a la base de datos
    define ('DB_HOST', $_ENV['DB_HOST']);
    define ('DB_USER', $_ENV['DB_USER']);
    define ('DB_PASSWORD', $_ENV['DB_PASSWORD']);
    define ('DB_NAME', $_ENV['DB_NAME']);

    //Zona horaria
    date_default_timezone_set ('America/Mexico_City');
    setlocale(LC_MONETARY, 'es_MX');

    session_start();
?>