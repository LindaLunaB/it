<?php
    require_once __DIR__  . '/../vendor/autoload.php';

    use Dotenv\Dotenv;

    $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();

    require_once 'config/config.php';
    require_once 'libraries/Controller.php';
    require_once 'libraries/Core.php';

    spl_autoload_register(function($nameClass){
        require_once 'libraries/' . '$nameClass' . '.php';
    });

    ini_set('log_errros', '1');
    ini_set('error_log', BASE_PATH .'errors/errors.log');
    
?>