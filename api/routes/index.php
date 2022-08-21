<?php
    use function config\slimConfiguration;

    use App\Controllers\AgendamentoController;
    use App\Controllers\ClienteController;
    use App\Controllers\EstabelecimentoController;
    use App\Controllers\AutenticarController;
    use App\Controllers\DiasFuncionamentoController;
    use App\Controllers\EnderecoController;
    use App\Controllers\ServicoController;

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
        $app->get('/estabelecimentos/token', EstabelecimentoController::class.':getEstabelecimentoWithToken');
        $app->get('/estabelecimentos/perfil', EstabelecimentoController::class.':getPerfilEstabalecimento');
        $app->put('/estabelecimento', EstabelecimentoController::class.':updateEstabelecimento');
        $app->post('/estabelecimento/foto_perfil', EstabelecimentoController::class.':updateFotoPerfilEstabelecimento');
        $app->delete('/estabelecimento', EstabelecimentoController::class.':deleteEstabelecimento');

        $app->get('/enderecos', EnderecoController::class.':getEnderecos');
        $app->get('/endereco[/{id}]', EnderecoController::class.':getEndereco');
        $app->put('/endereco', EnderecoController::class.':updateEndereco');
        $app->delete('/endereco', EnderecoController::class.':deleteEndereco');

        $app->get('/servicos', ServicoController::class.':getServicos');
        $app->get('/servico[/{id}]', ServicoController::class.':getServico');
        $app->get('/servicos_estab[/{id}]', ServicoController::class.':getServicoEstab');
        $app->get('/servicos/estabelecimento', ServicoController::class.':getServicoWithEstabelecimentoId');
        $app->post('/servico', ServicoController::class.':insertServico');
        $app->put('/servico', ServicoController::class.':updateServico');
        $app->delete('/servico', ServicoController::class.':deleteServico');

        $app->get('/dias_funcionamento', DiasFuncionamentoController::class.':getDiasFuncionamento');
        $app->get('/dia_funcionamento[/{id}]', DiasFuncionamentoController::class.':getDiaFuncionamento');
        $app->get('/dias_funcionamento_estab[/{id}]', DiasFuncionamentoController::class.':getDiaFuncionamentoEstab');
        $app->get('/dias_funcionamento/estabelecimento', DiasFuncionamentoController::class.':getDiaFuncionamentoWithEstabelecimentoId');
        $app->post('/dia_funcionamento', DiasFuncionamentoController::class.':insertDiaFuncionamento');
        $app->put('/dia_funcionamento', DiasFuncionamentoController::class.':updateDiaFuncionamento');
        $app->delete('/dia_funcionamento', DiasFuncionamentoController::class.':deleteDiaFuncionamento');

        $app->get('/agendamentos', AgendamentoController::class.':getAgendamentos');
        $app->get('/agendamento[/{id}]', AgendamentoController::class.':getAgendamento');
        $app->get('/agendamentos/estabelecimento', AgendamentoController::class.':getAgendamentoWithEstabelecimentoId');
        $app->get('/agendamentos_servico[/{id}]', AgendamentoController::class.':getAgendamentoWithServicos');
        $app->get('/agendamentos_cliente[/{id}]', AgendamentoController::class.':getAgendamentoWithClienteId');
        $app->get('/agendamentos/dashboard', AgendamentoController::class.':getAgendamentoDataCards');
        $app->get('/agendamentos/dashboard/grafico', AgendamentoController::class.':getAgendamentoDataChart');
        $app->post('/agendamento', AgendamentoController::class.':insertAgendamento');
        $app->post('/agendamento/servico', AgendamentoController::class.':insertAgendamentoServico');
        $app->post('/agendamentos/horarios', AgendamentoController::class.':getHorariosAgendamento');
        $app->put('/agendamento', AgendamentoController::class.':updateAgendamento');
        $app->put('/agendamento/status', AgendamentoController::class.':updateStatusAgendamento');
        $app->delete('/agendamento', AgendamentoController::class.':deleteAgendamento');
    })->add($verifyAuth);

    $app->run();