<?php
    require 'api/vendor/autoload.php';
    require 'config/verifyAuth.php';
    require 'config/functions.php';
    
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->safeLoad();

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

    $app->group('', function() use ($app){
        $app->get('/cliente[/]', function(){
            require_once "pages/area_cliente/area_cliente.php";
        });

        $app->get('/cliente/perfil', function(){
            require_once "pages/perfil_cliente/perfil_cliente.php";
        });

        $app->get('/barbearias[/{id}]', function(){
            require_once "pages/interna_barbearia/interna_barbearia.php";
        });
    })->add($verifyAuthCliente);

    $app->group('', function() use ($app){
        $app->get('/barbearia[/]', function(){
            require_once "pages/barbearia/barbearia.php";
        });

        $app->get('/barbearia/agendamentos', function(){
            require_once "pages/agendamentos_barbearia/agendamentos_barbearia.php";
        });

        $app->get('/barbearia/servicos', function(){
            require_once "pages/servicos_barbearia/servicos_barbearia.php";
        });

        $app->get('/barbearia/dias_funcionamento', function(){
            require_once "pages/dias_funcionamento/dias_funcionamento.php";
        });

        $app->get('/barbearia/perfil', function(){
            require_once "pages/perfil_estabelecimento/perfil_estabelecimento.php";
        });
    })->add($verifyAuthBarbearia);

    $app->run();