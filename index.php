<?php
    require 'api/vendor/autoload.php';

    $app = new \Slim\App;

    $app->get('/', function(){
        require_once "pages/landing_page/landing_page.php";
    });

    $app->get('/cliente/login', function(){
        require_once "pages/login_cliente/login_cliente.php";
    });

    $app->get('/barbearia/login', function(){
        require_once "pages/login_barbearia/login_barbearia.php";
    });

    $app->get('/cliente/registrar', function(){
        require_once "pages/registrar_cliente/registrar_cliente.php";
    });

    $app->get('/barbearia/registrar', function(){
        require_once "pages/registrar_barbearia/registrar_barbearia.php";
    });

    $app->run();