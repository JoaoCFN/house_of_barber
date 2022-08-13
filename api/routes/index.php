<?php
    use function config\slimConfiguration;

    use App\Controllers\ClienteController;
    use App\Controllers\EstabelecimentoController;
    use App\Controllers\AutenticarController;
    use App\Controllers\EnderecoController;

    $app = new \Slim\App(slimConfiguration());

    $app->post('/autenticar', AutenticarController::class.':autenticar');

    $app->post('/cliente', ClienteController::class.':insertCliente');
    $app->post('/estabelecimento', EstabelecimentoController::class.':insertEstabelecimento');
    $app->post('/endereco', EnderecoController::class.':insertEndereco');

    $app->group('', function () use ($app){
        $app->get('/clientes', ClienteController::class.':getClientes');
        $app->get('/cliente[/{id}]', ClienteController::class.':getCliente');
        $app->get('/clientes/token', ClienteController::class.':getUserWithToken');
        $app->put('/cliente', ClienteController::class.':updateCliente');
        $app->delete('/cliente', ClienteController::class.':deleteCliente');
    
        $app->get('/estabelecimentos', EstabelecimentoController::class.':getEstabelecimentos');
        $app->get('/estabelecimento[/{id}]', EstabelecimentoController::class.':getEstabelecimento');
        $app->put('/estabelecimento', EstabelecimentoController::class.':updateEstabelecimento');
        $app->delete('/estabelecimento', EstabelecimentoController::class.':deleteEstabelecimento');

        $app->get('/enderecos', EnderecoController::class.':getEnderecos');
        $app->get('/endereco[/{id}]', EnderecoController::class.':getEndereco');
        $app->put('/endereco', EnderecoController::class.':updateEndereco');
        $app->delete('/endereco', EnderecoController::class.':deleteEndereco');
    })->add($verifyAuth);

    $app->run();