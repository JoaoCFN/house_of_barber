<?php 
    namespace App\Controllers;

    use Psr\Http\Message\RequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;

    use App\DAO\MySQL\HouseOfBarber\EnderecoDAO;
    use App\Models\MySQL\HouseOfBarber\EnderecoModel;
    use App\Assets\BaseLib\App\Utilities;
use App\DAO\MySQL\HouseOfBarber\AutenticarDAO;
use App\Models\MySQL\HouseOfBarber\AutenticarModel;

    final class EnderecoController{
        public function getEnderecos(Request $request, Response $response, array $args): Response 
        {
            $enderecoDAO = new EnderecoDAO();
            $enderecos = $enderecoDAO->getAll();

            $response = $response->withJson($enderecos);
            
            return $response;
        }

        public function getEndereco(Request $request, Response $response, array $args): Response 
        {
            if(isset($args['id'])){
                $id = $args['id'];
    
                if(is_numeric($id)){
                    $enderecoDAO = new EnderecoDAO();
                    $endereco = $enderecoDAO->findById($id);
        
                    $response = $response->withJson($endereco);
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
        
        public function insertEndereco(Request $request, Response $response, array $args): Response 
        {
            $data = $request->getParsedBody();

            if($data && count($data) > 0){
                $fieldsNecessary = ['estabelecimento_id', 'cep', 'estado', 'cidade', 'bairro', 'rua', 'numero'];
                $data = Utilities::treatRequestBody($data, 'PDO');

                $correctFieldsInformed = Utilities::verifyAmountFields($fieldsNecessary, $data);

                if($correctFieldsInformed){ 
                    $enderecoDAO = new EnderecoDAO();
                    $enderecoModel = new EnderecoModel();
                
                    $enderecoModel->setEstabelecimentoId($data['estabelecimento_id']);
                    $enderecoModel->setCep($data['cep']);
                    $enderecoModel->setEstado($data['estado']);
                    $enderecoModel->setCidade($data['cidade']);
                    $enderecoModel->setBairro($data['bairro']);
                    $enderecoModel->setRua($data['rua']);
                    $enderecoModel->setNumero($data['numero']);
                    
                    $queryStatus = $enderecoDAO->insertEndereco($enderecoModel);
        
                    if($queryStatus){
                        $response = $response->withJson([
                            "message" => "Endereço inserido com sucesso",
                            "error" => "false"
                        ]);
                    }
                    else{
                        $response = $response->withJson([
                            "message" => "Erro ao inserir o endereço",
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

            return $response;
        }
        
        public function updateEndereco(Request $request, Response $response, array $args): Response 
        {
            $headers = $request->getHeaders();

            if(isset($headers['HTTP_TOKEN'])){
                $token = $headers['HTTP_TOKEN'][0];
                
                $autenticarDAO = new AutenticarDAO();
                $autenticarModel = new AutenticarModel();

                $autenticarModel->setToken($token);

                $tokenData = $autenticarDAO->findUserByToken($autenticarModel);

                if($tokenData && count($tokenData) > 0){
                    $data = $request->getParsedBody();

                    if($data && count($data) > 0){
                        $fieldsNecessary = ['cep', 'estado', 'cidade', 'bairro', 'rua', 'numero'];
                        $data = Utilities::treatRequestBody($data, 'PDO');

                        $correctFieldsInformed = Utilities::verifyAmountFields($fieldsNecessary, $data);

                        if($correctFieldsInformed){
                            $id = $tokenData[0]["id_usuario"];

                            $enderecoDAO = new EnderecoDAO();
                            $enderecoModel = new EnderecoModel();
                        
                            $enderecoModel->setCep($data['cep']);
                            $enderecoModel->setEstado($data['estado']);
                            $enderecoModel->setCidade($data['cidade']);
                            $enderecoModel->setBairro($data['bairro']);
                            $enderecoModel->setRua($data['rua']);
                            $enderecoModel->setNumero($data['numero']);
                        
                            $queryStatus = $enderecoDAO->updateEndereco($enderecoModel, $id);

                            if($queryStatus){
                                $response = $response->withJson([
                                    "message" => "Endereço atualizado com sucesso",
                                    "error" => "false"
                                ]);
                            }
                            else{
                                $response = $response->withJson([
                                    "message" => "Erro ao atualizar o endereço",
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
                }
                else{
                    $response = $response->withJson([
                        "message" => "Token inválido",
                        "error" => "true"
                    ]);
                }
            }
            else{
                $response = $response->withJson([
                    "message" => "Informe o token do usuário logado",
                    "error" => "true"
                ]);
            }

            return $response;
        }
        
        public function deleteEndereco(Request $request, Response $response, array $args): Response 
        {
            $data = $request->getParsedBody();

            if($data && count($data) > 0){
                $fieldsNecessary = ['id'];
                $data = Utilities::treatRequestBody($data, 'PDO');

                $correctFieldsInformed = Utilities::verifyAmountFields($fieldsNecessary, $data);

                if($correctFieldsInformed){
                    $id = $data['id'];

                    if(is_numeric($id)){
                        $enderecoDAO = new EnderecoDAO();
                        $queryStatus = $enderecoDAO->deleteEndereco($id);
        
                        if($queryStatus){
                            $response = $response->withJson([
                                "message" => "Endereço deletado com sucesso",
                                "error" => "false"
                            ]);
                        }
                        else{
                            $response = $response->withJson([
                                "message" => "Erro ao deletar o endereço",
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