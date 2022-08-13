<?php 
    namespace App\Controllers;

    use Psr\Http\Message\RequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;

    use App\DAO\MySQL\HouseOfBarber\ServicoDAO;
    use App\Models\MySQL\HouseOfBarber\ServicoModel;
    use App\Assets\BaseLib\App\Utilities;
    use App\DAO\MySQL\HouseOfBarber\AutenticarDAO;
    use App\Models\MySQL\HouseOfBarber\AutenticarModel;

    final class ServicoController{
        public function getServicos(Request $request, Response $response, array $args): Response 
        {
            $servicoDAO = new ServicoDAO();
            $servicos = $servicoDAO->getAll();

            $response = $response->withJson($servicos);
            
            return $response;
        }

        public function getServico(Request $request, Response $response, array $args): Response 
        {
            if(isset($args['id'])){
                $id = $args['id'];
    
                if(is_numeric($id)){
                    $servicoDAO = new ServicoDAO();
                    $servico = $servicoDAO->findById($id);
        
                    $response = $response->withJson($servico);
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

        public function getServicoWithEstabelecimentoId(Request $request, Response $response, array $args): Response 
        {
            $headers = $request->getHeaders();

            $token = $headers['HTTP_TOKEN'][0];
                
            $autenticarDAO = new AutenticarDAO();
            $autenticarModel = new AutenticarModel();

            $autenticarModel->setToken($token);

            $tokenData = $autenticarDAO->findUserByToken($autenticarModel);

            if($tokenData && count($tokenData) > 0){
                $id = $tokenData[0]["id_usuario"];

                $servicoDAO = new ServicoDAO();
                $servico = $servicoDAO->findByEstabelecimentoId($id);
    
                $response = $response->withJson($servico);
            }
            else{
                $response = $response->withJson([
                    "message" => "Token inválido",
                    "error" => "true"
                ]);
            }

            return $response;
        }
        
        public function insertServico(Request $request, Response $response, array $args): Response 
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
                    $fieldsNecessary = ['nome', 'valor'];
                    $data = Utilities::treatRequestBody($data, 'PDO');
    
                    $correctFieldsInformed = Utilities::verifyAmountFields($fieldsNecessary, $data);
    
                    if($correctFieldsInformed){
                        $servicoModel = new ServicoModel();
                        $servicoDAO = new ServicoDAO();
    
                        $servicoModel->setNome($data['nome']);
                        $servicoModel->setValor($data['valor']);
                        $servicoModel->setEstabelecimentoId($id);
            
                        $queryStatus = $servicoDAO->insertServico($servicoModel);
            
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
        
        public function updateServico(Request $request, Response $response, array $args): Response 
        {
            $data = $request->getParsedBody();

            if($data && count($data) > 0){
                $fieldsNecessary = ['nome', 'valor', 'id'];
                $data = Utilities::treatRequestBody($data, 'PDO');

                $correctFieldsInformed = Utilities::verifyAmountFields($fieldsNecessary, $data);

                if($correctFieldsInformed){
                    $id = $data['id'];

                    if(is_numeric($id)){
                        $servicoModel = new ServicoModel();
                        $servicoDAO = new ServicoDAO();

                        $servicoModel->setNome($data['nome']);
                        $servicoModel->setValor($data['valor']);
    
                        $queryStatus = $servicoDAO->updateServico($servicoModel, $id);
    
                        if($queryStatus){
                            $response = $response->withJson([
                                "message" => "Serviço atualizado com sucesso",
                                "error" => "false"
                            ]);
                        }
                        else{
                            $response = $response->withJson([
                                "message" => "Erro ao atualizar o serviço",
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
        
        public function deleteServico(Request $request, Response $response, array $args): Response 
        {
            $data = $request->getParsedBody();

            if($data && count($data) > 0){
                $fieldsNecessary = ['id'];
                $data = Utilities::treatRequestBody($data, 'PDO');

                $correctFieldsInformed = Utilities::verifyAmountFields($fieldsNecessary, $data);

                if($correctFieldsInformed){
                    $id = $data['id'];

                    if(is_numeric($id)){
                        $servicoDAO = new ServicoDAO();
                        $queryStatus = $servicoDAO->deleteServico($id);
        
                        if($queryStatus){
                            $response = $response->withJson([
                                "message" => "Serviço deletado com sucesso",
                                "error" => "false"
                            ]);
                        }
                        else{
                            $response = $response->withJson([
                                "message" => "Erro ao deletar o serviço",
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