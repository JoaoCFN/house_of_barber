<?php 
    namespace config;

    function slimConfiguration(): \Slim\Container{
        $configuration = [
            'settings' => [
                'displayErrorDetails' => true
            ],
        ];
    
        return new \Slim\Container($configuration);
    }
?>