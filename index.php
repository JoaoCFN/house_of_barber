<?php
    require 'api/vendor/autoload.php';

    $app = new \Slim\App;

    $app->get('/', function(){
        require_once "pages/landing_page/landing_page.php";
    });

    $app->run();