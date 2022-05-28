<?php
    use function config\slimConfiguration;
    
    use App\Controllers\TesteController;

    $app = new \Slim\App(slimConfiguration());

    $app->get('/testes', TesteController::class.':getTestes');
    $app->get('/teste[/{id}]', TesteController::class.':getTeste');
    $app->post('/teste', TesteController::class.':insertTeste');
    $app->put('/teste', TesteController::class.':updateTeste');
    $app->delete('/teste', TesteController::class.':deleteTeste');

    $app->run();