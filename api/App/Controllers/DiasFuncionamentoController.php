<?php 
    namespace App\Controllers;

    use Psr\Http\Message\RequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;

    use App\DAO\MySQL\HouseOfBarber\DiasFuncionamentoDAO;
    use App\Assets\BaseLib\App\Utilities;
    use App\DAO\MySQL\HouseOfBarber\AutenticarDAO;
    use App\Models\MySQL\HouseOfBarber\AutenticarModel;
    use App\Models\MySQL\HouseOfBarber\DiasFuncionamentoModel;

    final class DiasFuncionamentoController{
        public function getDiasFuncionamento(Request $request, Response $response, array $args): Response 
        {
            $diasFuncionamentoDAO = new DiasFuncionamentoDAO();
            $diasFuncionamento = $diasFuncionamentoDAO->getAll();

            $response = $response->withJson($diasFuncionamento);
            
            return $response;
        }

        public function getDiaFuncionamento(Request $request, Response $response, array $args): Response 
        {
            if(isset($args['id'])){
                $id = $args['id'];
    
                if(is_numeric($id)){
                    $diasFuncionamentoDAO = new DiasFuncionamentoDAO();
                    $diaFuncionamento = $diasFuncionamentoDAO->findById($id);
        
                    $response = $response->withJson($diaFuncionamento);
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

        public function getDiaFuncionamentoEstab(Request $request, Response $response, array $args): Response 
        {
            if(isset($args['id'])){
                $id = $args['id'];
    
                if(is_numeric($id)){
                    $diasFuncionamentoDAO = new DiasFuncionamentoDAO();
                    $diaFuncionamento = $diasFuncionamentoDAO->findByEstabelecimentoId($id);
        
                    $response = $response->withJson($diaFuncionamento);
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

        public function getDiaFuncionamentoWithEstabelecimentoId(Request $request, Response $response, array $args): Response 
        {
            $headers = $request->getHeaders();

            $token = $headers['HTTP_TOKEN'][0];
                
            $autenticarDAO = new AutenticarDAO();
            $autenticarModel = new AutenticarModel();

            $autenticarModel->setToken($token);

            $tokenData = $autenticarDAO->findUserByToken($autenticarModel);

            if($tokenData && count($tokenData) > 0){
                $id = $tokenData[0]["id_usuario"];

                $diasFuncionamentoDAO = new DiasFuncionamentoDAO();
                $diaFuncionamento = $diasFuncionamentoDAO->findByEstabelecimentoId($id);
    
                $response = $response->withJson($diaFuncionamento);
            }
            else{
                $response = $response->withJson([
                    "message" => "Token inválido",
                    "error" => "true"
                ]);
            }

            return $response;
        }
        
        public function insertDiaFuncionamento(Request $request, Response $response, array $args): Response 
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
                    $fieldsNecessary = ['dia', 'horario_abertura', 'horario_fechamento'];
                    $data = Utilities::treatRequestBody($data, 'PDO');
    
                    $correctFieldsInformed = Utilities::verifyAmountFields($fieldsNecessary, $data);
    
                    if($correctFieldsInformed){
                        $diasFuncionamentoModel = new DiasFuncionamentoModel();
                        $diasFuncionamentoDAO = new DiasFuncionamentoDAO();
    
                        $diasFuncionamentoModel->setDia($data['dia']);
                        $diasFuncionamentoModel->setHorarioAbertura($data['horario_abertura']);
                        $diasFuncionamentoModel->setHorarioFechamento($data['horario_fechamento']);
                        $diasFuncionamentoModel->setEstabelecimentoId($id);
            
                        $queryStatus = $diasFuncionamentoDAO->insertDiaFuncionamento($diasFuncionamentoModel);
            
                        if($queryStatus){
                            $response = $response->withJson([
                                "message" => "Dia de funcionamento inserido com sucesso",
                                "error" => "false"
                            ]);
                        }
                        else{
                            $response = $response->withJson([
                                "message" => "Erro ao inserir o dia de funcionamento",
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
        
        public function updateDiaFuncionamento(Request $request, Response $response, array $args): Response 
        {
            $data = $request->getParsedBody();

            if($data && count($data) > 0){
                $fieldsNecessary = ['dia', 'horario_abertura', 'horario_fechamento'];
                $data = Utilities::treatRequestBody($data, 'PDO');

                $correctFieldsInformed = Utilities::verifyAmountFields($fieldsNecessary, $data);

                if($correctFieldsInformed){
                    $id = $data['id'];

                    if(is_numeric($id)){
                        $diasFuncionamentoModel = new DiasFuncionamentoModel();
                        $diasFuncionamentoDAO = new DiasFuncionamentoDAO();
    
                        $diasFuncionamentoModel->setDia($data['dia']);
                        $diasFuncionamentoModel->setHorarioAbertura($data['horario_abertura']);
                        $diasFuncionamentoModel->setHorarioFechamento($data['horario_fechamento']);
    
                        $queryStatus = $diasFuncionamentoDAO->updateDiaFuncionamento($diasFuncionamentoModel, $id);
    
                        if($queryStatus){
                            $response = $response->withJson([
                                "message" => "Dia de funcionamento atualizado com sucesso",
                                "error" => "false"
                            ]);
                        }
                        else{
                            $response = $response->withJson([
                                "message" => "Erro ao atualizar o dia de funcionamento",
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
        
        public function deleteDiaFuncionamento(Request $request, Response $response, array $args): Response 
        {
            $data = $request->getParsedBody();

            if($data && count($data) > 0){
                $fieldsNecessary = ['id'];
                $data = Utilities::treatRequestBody($data, 'PDO');

                $correctFieldsInformed = Utilities::verifyAmountFields($fieldsNecessary, $data);

                if($correctFieldsInformed){
                    $id = $data['id'];

                    if(is_numeric($id)){
                        $diasFuncionamentoDAO = new DiasFuncionamentoDAO();
                        $queryStatus = $diasFuncionamentoDAO->deleteDiaFuncionamento($id);
        
                        if($queryStatus){
                            $response = $response->withJson([
                                "message" => "Dia de funcionamento deletado com sucesso",
                                "error" => "false"
                            ]);
                        }
                        else{
                            $response = $response->withJson([
                                "message" => "Erro ao deletar o dia de funcionamento",
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