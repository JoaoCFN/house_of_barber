<?php
    use function config\slimConfiguration;
    
    use App\Controllers\ClienteController;
    use App\Controllers\EstabelecimentoController;

    $app = new \Slim\App(slimConfiguration());

    $app->get('/clientes', ClienteController::class.':getClientes');
    $app->get('/cliente[/{id}]', ClienteController::class.':getCliente');
    $app->post('/cliente', ClienteController::class.':insertCliente');
    $app->put('/cliente', ClienteController::class.':updateCliente');
    $app->delete('/cliente', ClienteController::class.':deleteCliente');

    $app->get('/estabelecimentos', EstabelecimentoController::class.':getEstabelecimentos');
    $app->get('/estabelecimento[/{id}]', EstabelecimentoController::class.':getEstabelecimento');
    $app->post('/estabelecimento', EstabelecimentoController::class.':insertEstabelecimento');
    $app->put('/estabelecimento', EstabelecimentoController::class.':updateEstabelecimento');
    $app->delete('/estabelecimento', EstabelecimentoController::class.':deleteEstabelecimento');

    $app->run();