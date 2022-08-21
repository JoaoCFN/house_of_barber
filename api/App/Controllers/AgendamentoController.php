<?php 
    namespace App\Controllers;

    use Psr\Http\Message\RequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;

    use App\DAO\MySQL\HouseOfBarber\AgendamentoDAO;
    use App\Models\MySQL\HouseOfBarber\AgendamentoModel;
    use App\DAO\MySQL\HouseOfBarber\AgendamentoServicoDAO;
    use App\Models\MySQL\HouseOfBarber\AgendamentoServicoModel;
    use App\Assets\BaseLib\App\Utilities;
    use App\DAO\MySQL\HouseOfBarber\AutenticarDAO;
    use App\Models\MySQL\HouseOfBarber\AutenticarModel;

    final class AgendamentoController{
        public function getAgendamentos(Request $request, Response $response, array $args): Response 
        {
            $agendamentoDAO = new AgendamentoDAO();
            $agendamentos = $agendamentoDAO->getAll();

            $response = $response->withJson($agendamentos);
            
            return $response;
        }

        public function getAgendamento(Request $request, Response $response, array $args): Response 
        {
            if(isset($args['id'])){
                $id = $args['id'];
    
                if(is_numeric($id)){
                    $agendamentoDAO = new AgendamentoDAO();
                    $agendamento = $agendamentoDAO->findById($id);
        
                    $response = $response->withJson($agendamento);
                }
                else{
                    $response = $response->withJson([
                        "message" => "Informe um id númerico",
                        "error" => "true"
                    ]);
                }
            }
            else{
                $response = $response->withJson([
                    "message" => "Informe o id",
                    "error" => "true"
                ]);
            }

            return $response;
        }

        public function getAgendamentoWithClienteId(Request $request, Response $response, array $args): Response 
        {
            if(isset($args['id'])){
                $id = $args['id'];
    
                if(is_numeric($id)){
                    $agendamentoDAO = new AgendamentoDAO();
                    $agendamento = $agendamentoDAO->findByClienteId($id);
        
                    $response = $response->withJson($agendamento);
                }
                else{
                    $response = $response->withJson([
                        "message" => "Informe um id númerico",
                        "error" => "true"
                    ]);
                }
            }
            else{
                $response = $response->withJson([
                    "message" => "Informe o id",
                    "error" => "true"
                ]);
            }

            return $response;
        }

        public function getAgendamentoWithEstabelecimentoId(Request $request, Response $response, array $args): Response 
        {
            if(isset($args['id'])){
                $id = $args['id'];
    
                if(is_numeric($id)){
                    $agendamentoDAO = new AgendamentoDAO();
                    $agendamento = $agendamentoDAO->findByEstabelecimentoId($id);
        
                    $response = $response->withJson($agendamento);
                }
                else{
                    $response = $response->withJson([
                        "message" => "Informe um id númerico",
                        "error" => "true"
                    ]);
                }
            }
            else{
                $response = $response->withJson([
                    "message" => "Informe o id",
                    "error" => "true"
                ]);
            }

            return $response;
        }

        public function getHorariosAgendamento(Request $request, Response $response, array $args): Response 
        {
            $data = $request->getParsedBody();

            $fieldsNecessary = ['id', 'data_agendamento'];
            $data = Utilities::treatRequestBody($data, 'PDO');
    
            $correctFieldsInformed = Utilities::verifyAmountFields($fieldsNecessary, $data);

            if($correctFieldsInformed){
                $estabelecimentoId = $data['id'];
                $dataAgendamento = $data['data_agendamento'];

                $agendamentoDAO = new AgendamentoDAO();
                $agendamentoModel = new AgendamentoModel();

                $agendamentoModel->setEstabelecimentoId($estabelecimentoId);
                $agendamentoModel->setDataAgendamento($dataAgendamento);

                $horarios = $agendamentoDAO->findHorariosAgendamentosByData($agendamentoModel);
    
                $response = $response->withJson($horarios);
            }
            else{
                $response = $response->withJson([
                    "message" => "Informe todos os campos necessários",
                    "error" => "true"
                ]);
            }

            return $response;
        }

        public function getAgendamentoWithServicos(Request $request, Response $response, array $args): Response 
        {
            if(isset($args['id'])){
                $id = $args['id'];
    
                if(is_numeric($id)){
                    $agendamentoServicoDAO = new AgendamentoServicoDAO();
                    $agendamento = $agendamentoServicoDAO->findByAgendamentoId($id);
        
                    $response = $response->withJson($agendamento);
                }
                else{
                    $response = $response->withJson([
                        "message" => "Informe um id númerico",
                        "error" => "true"
                    ]);
                }
            }
            else{
                $response = $response->withJson([
                    "message" => "Informe o id",
                    "error" => "true"
                ]);
            }

            return $response;
        }

        public function getAgendamentoDataCards(Request $request, Response $response, array $args): Response
        {
            $headers = $request->getHeaders();
            $data = $request->getParsedBody();

            $token = $headers['HTTP_TOKEN'][0];
                
            $autenticarDAO = new AutenticarDAO();
            $autenticarModel = new AutenticarModel();

            $autenticarModel->setToken($token);

            $tokenData = $autenticarDAO->findUserByToken($autenticarModel);

            if($tokenData && count($tokenData) > 0){
                $arrayData = [];
                $id = $tokenData[0]["id_usuario"];

                $agendamentoDAO = new AgendamentoDAO();

                $data = $agendamentoDAO->getTotaAgendamentos($id);
                $arrayData[] = $data[0];

                $data = $agendamentoDAO->getTotaAgendamentosWithStatus($id, 'PENDENTE', 'pendentes');
                $arrayData[] = $data[0];

                $data = $agendamentoDAO->getTotaAgendamentosWithStatus($id, 'FINALIZADO', 'finalizados');
                $arrayData[] = $data[0];

                // Implemenar fluxo de média de avaliações
                $arrayData[] = ["media_avaliacoes" => 0];

                $response = $response->withJson($arrayData);
            }

            return $response;    
        }

        public function getAgendamentoDataChart(Request $request, Response $response, array $args): Response
        {
            $headers = $request->getHeaders();
            $data = $request->getParsedBody();

            $token = $headers['HTTP_TOKEN'][0];
                
            $autenticarDAO = new AutenticarDAO();
            $autenticarModel = new AutenticarModel();

            $autenticarModel->setToken($token);

            $tokenData = $autenticarDAO->findUserByToken($autenticarModel);

            if($tokenData && count($tokenData) > 0){
                $id = $tokenData[0]["id_usuario"];

                $agendamentoDAO = new AgendamentoDAO();

                $responseData = $agendamentoDAO->getAgendamentosDataChart($id);

                $response = $response->withJson($responseData);
            }

            return $response;    
        }
        
        public function insertAgendamento(Request $request, Response $response, array $args): Response 
        {
            $headers = $request->getHeaders();
            $data = $request->getParsedBody();

            $token = $headers['HTTP_TOKEN'][0];
                
            $autenticarDAO = new AutenticarDAO();
            $autenticarModel = new AutenticarModel();

            $autenticarModel->setToken($token);

            $tokenData = $autenticarDAO->findUserByToken($autenticarModel);

            if($tokenData && count($tokenData) > 0){
                $id = $tokenData[0]["id_usuario"];

                if($data && count($data) > 0){
                    $fieldsNecessary = ['estabelecimento_id', 'data_agendamento', 'horario_agendamento', 'valor', 'status'];
                    $data = Utilities::treatRequestBody($data, 'PDO');
    
                    $correctFieldsInformed = Utilities::verifyAmountFields($fieldsNecessary, $data);
    
                    if($correctFieldsInformed){
                        $agendamentoModel = new AgendamentoModel();
                        $agendamentoDAO = new AgendamentoDAO();
    
                        $agendamentoModel->setClienteId($id);
                        $agendamentoModel->setEstabelecimentoId($data['estabelecimento_id']);
                        $agendamentoModel->setDataAgendamento($data['data_agendamento']);
                        $agendamentoModel->setHorarioAgendamento($data['horario_agendamento']);
                        $agendamentoModel->setValor($data['valor']);
                        $agendamentoModel->setStatus($data['status']);

                        $agendamentoData = $agendamentoDAO->findAgendamento($agendamentoModel);

                        if($agendamentoData && count($agendamentoData) > 0){
                            $response = $response->withJson([
                                "message" => "Horário ocupado. Por favor, informe outro horário.",
                                "error" => "true"
                            ]);
                        }
                        else{
                            $queryData = $agendamentoDAO->insertAgendamento($agendamentoModel);
                            $queryStatus = $queryData[0];
                            $insertedId = $queryData[1];
                
                            if($queryStatus){
                                $response = $response->withJson([
                                    "message" => "Agendamento inserido com sucesso",
                                    "scheduling_id" => $insertedId,
                                    "error" => "false"
                                ]);
                            }
                            else{
                                $response = $response->withJson([
                                    "message" => "Erro ao inserir o agendamento",
                                    "error" => "true"
                                ]);
                            }
                        }
                    }
                    else{
                        $response = $response->withJson([
                            "message" => "Informe todos os campos necessários",
                            "error" => "true"
                        ]);
                    }
                }
                else{
                    $response = $response->withJson([
                        "message" => "Informe o campos a serem inseridos",
                        "error" => "true"
                    ]);
                }
            }
            else{
                $response = $response->withJson([
                    "message" => "Token inválido",
                    "error" => "true"
                ]);
            }

            return $response;
        }

        public function insertAgendamentoServico(Request $request, Response $response, array $args): Response 
        {
            $data = $request->getParsedBody();

            $fieldsNecessary = ['agendamento_id', 'servico_id'];
            $data = Utilities::treatRequestBody($data, 'PDO');
    
            $correctFieldsInformed = Utilities::verifyAmountFields($fieldsNecessary, $data);

            if($correctFieldsInformed){
                $agendamentoServicoModel = new AgendamentoServicoModel();
                $agendamentoServicoDAO = new AgendamentoServicoDAO();

                $agendamentoServicoModel->setAgendamentoId($data['agendamento_id']);
                $agendamentoServicoModel->setServicoId($data['servico_id']);
                
                $queryStatus = $agendamentoServicoDAO->insertAgendamentoServico($agendamentoServicoModel);
    
                if($queryStatus){
                    $response = $response->withJson([
                        "message" => "Serviço inserido com sucesso",
                        "error" => "false"
                    ]);
                }
                else{
                    $response = $response->withJson([
                        "message" => "Erro ao inserir o serviço",
                        "error" => "true"
                    ]);
                }
            }
            else{
                $response = $response->withJson([
                    "message" => "Informe todos os campos necessários",
                    "error" => "true"
                ]);
            }

            return $response;
        }
        
        public function updateAgendamento(Request $request, Response $response, array $args): Response 
        {
            $data = $request->getParsedBody();

            if($data && count($data) > 0){
                $fieldsNecessary = ['cliente_id', 'estabelecimento_id', 'data_agendamento', 'horario_agendamento', 'valor', 'status'];
                $data = Utilities::treatRequestBody($data, 'PDO');

                $correctFieldsInformed = Utilities::verifyAmountFields($fieldsNecessary, $data);

                if($correctFieldsInformed){
                    $id = $data['id'];

                    if(is_numeric($id)){
                        $agendamentoModel = new AgendamentoModel();
                        $agendamentoDAO = new AgendamentoDAO();
    
                        $agendamentoModel->setClienteId($data['cliente_id']);
                        $agendamentoModel->setEstabelecimentoId($data['estabelecimento_id']);
                        $agendamentoModel->setDataAgendamento($data['data_agendamento']);
                        $agendamentoModel->setHorarioAgendamento($data['horario_agendamento']);
                        $agendamentoModel->setValor($data['valor']);
                        $agendamentoModel->setStatus($data['status']);
    
                        $queryStatus = $agendamentoDAO->updateAgendamento($agendamentoModel, $id);
    
                        if($queryStatus){
                            $response = $response->withJson([
                                "message" => "Agendamento atualizado com sucesso",
                                "error" => "false"
                            ]);
                        }
                        else{
                            $response = $response->withJson([
                                "message" => "Erro ao atualizar o agendamento",
                                "error" => "true"
                            ]);
                        }
                    }
                    else{
                        $response = $response->withJson([
                            "message" => "Informe um id númerico",
                            "error" => "true"
                        ]);
                    }
                }
                else{
                    $response = $response->withJson([
                        "message" => "Informe todos os campos necessários para a atualização",
                        "error" => "true"
                    ]);
                }
            }
            else{
                $response = $response->withJson([
                    "message" => "Informe o campos a serem atualizados",
                    "error" => "true"
                ]);
            }

            return $response;
        }    

        public function updateStatusAgendamento(Request $request, Response $response, array $args): Response 
        {
            $data = $request->getParsedBody();

            if($data && count($data) > 0){
                $fieldsNecessary = ['status', 'id'];
                $data = Utilities::treatRequestBody($data, 'PDO');

                $correctFieldsInformed = Utilities::verifyAmountFields($fieldsNecessary, $data);

                if($correctFieldsInformed){
                    $id = $data['id'];

                    if(is_numeric($id)){
                        $agendamentoModel = new AgendamentoModel();
                        $agendamentoDAO = new AgendamentoDAO();
                    
                        $agendamentoModel->setStatus($data['status']);
    
                        $queryStatus = $agendamentoDAO->updateStatusAgendamento($agendamentoModel, $id);
    
                        if($queryStatus){
                            $response = $response->withJson([
                                "message" => "Agendamento atualizado com sucesso",
                                "error" => "false"
                            ]);
                        }
                        else{
                            $response = $response->withJson([
                                "message" => "Erro ao atualizar o agendamento",
                                "error" => "true"
                            ]);
                        }
                    }
                    else{
                        $response = $response->withJson([
                            "message" => "Informe um id númerico",
                            "error" => "true"
                        ]);
                    }
                }
                else{
                    $response = $response->withJson([
                        "message" => "Informe todos os campos necessários para a atualização",
                        "error" => "true"
                    ]);
                }
            }
            else{
                $response = $response->withJson([
                    "message" => "Informe o campos a serem atualizados",
                    "error" => "true"
                ]);
            }

            return $response;
        }
        
        public function deleteAgendamento(Request $request, Response $response, array $args): Response 
        {
            $data = $request->getParsedBody();

            if($data && count($data) > 0){
                $fieldsNecessary = ['id'];
                $data = Utilities::treatRequestBody($data, 'PDO');

                $correctFieldsInformed = Utilities::verifyAmountFields($fieldsNecessary, $data);

                if($correctFieldsInformed){
                    $id = $data['id'];

                    if(is_numeric($id)){
                        $agendamentoDAO = new AgendamentoDAO();
                        $queryStatus = $agendamentoDAO->deleteAgendamento($id);
        
                        if($queryStatus){
                            $response = $response->withJson([
                                "message" => "Agendamento deletado com sucesso",
                                "error" => "false"
                            ]);
                        }
                        else{
                            $response = $response->withJson([
                                "message" => "Erro ao deletar o agendamento",
                                "error" => "true"
                            ]);
                        }
                    }
                    else{
                        $response = $response->withJson([
                            "message" => "Informe um id númerico",
                            "error" => "true"
                        ]);
                    }
                }
                else{
                    $response = $response->withJson([
                        "message" => "Informe o id a ser deletado",
                        "error" => "true"
                    ]);
                }
            }
            else{
                $response = $response->withJson([
                    "message" => "Informe o id a ser deletado",
                    "error" => "true"
                ]);
            }
            
            return $response;
        }
    }