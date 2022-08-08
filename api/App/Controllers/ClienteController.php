<?php 
    namespace App\Controllers;

    use Psr\Http\Message\RequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;

    use App\DAO\MySQL\HouseOfBarber\ClienteDAO;
    use App\Models\MySQL\HouseOfBarber\ClienteModel;
    use App\Assets\BaseLib\App\Utilities;

    final class ClienteController{
        public function getClientes(Request $request, Response $response, array $args): Response 
        {
            $clienteDAO = new ClienteDAO();
            $clientes = $clienteDAO->getAll();

            $response = $response->withJson($clientes);
            
            return $response;
        }

        public function getCliente(Request $request, Response $response, array $args): Response 
        {
            if(isset($args['id'])){
                $id = $args['id'];
    
                if(is_numeric($id)){
                    $clienteDAO = new clienteDAO();
                    $cliente = $clienteDAO->findById($id);
        
                    $response = $response->withJson($cliente);
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
        
        public function insertCliente(Request $request, Response $response, array $args): Response 
        {
            $data = $request->getParsedBody();

            if($data && count($data) > 0){
                $fieldsNecessary = ['nome', 'telefone', 'data_nascimento', 'cpf', 'email', 'senha'];
                $data = Utilities::treatRequestBody($data, 'PDO');

                $correctFieldsInformed = Utilities::verifyAmountFields($fieldsNecessary, $data);

                if($correctFieldsInformed){
                    if(filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                        $clienteModel = new ClienteModel();
                        $clienteDAO = new ClienteDAO();

                        $userData = $clienteDAO->findUserByEmail($data['email']);

                        if($userData && count($userData) > 0){
                            $response = $response->withJson([
                                "message" => "O email já está em uso. Por favor, informe um e-mail diferente",
                                "error" => "true"
                            ]);
                        }
                        else {
                            $hashSenha = password_hash($data['senha'], PASSWORD_DEFAULT);
            
                            $clienteModel->setNome($data['nome']);
                            $clienteModel->setTelefone($data['telefone']);
                            $clienteModel->setDataNascimento($data['data_nascimento']);
                            $clienteModel->setCpf($data['cpf']);
                            $clienteModel->setEmail($data['email']);
                            $clienteModel->setSenha($hashSenha);
                
                            $queryStatus = $clienteDAO->insertCliente($clienteModel);
                
                            if($queryStatus){
                                $response = $response->withJson([
                                    "message" => "Cliente inserido com sucesso",
                                    "error" => "false"
                                ]);
                            }
                            else{
                                $response = $response->withJson([
                                    "message" => "Erro ao inserir o cliente",
                                    "error" => "true"
                                ]);
                            }
                        }
                    }
                    else{
                        $response = $response->withJson([
                            "message" => "Informe um email em um formato válido",
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
        
        public function updateCliente(Request $request, Response $response, array $args): Response 
        {
            $data = $request->getParsedBody();

            if($data && count($data) > 0){
                $fieldsNecessary = ['id', 'nome'];
                $data = Utilities::treatRequestBody($data, 'PDO');

                $correctFieldsInformed = Utilities::verifyAmountFields($fieldsNecessary, $data);

                if($correctFieldsInformed){
                    $id = $data['id'];

                    if(is_numeric($id)){
                        if(filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                            if(strlen($data['senha']) >= 8){
                                $clienteModel = new ClienteModel();
                                $clienteDAO = new ClienteDAO();

                                $userData = $clienteDAO->findUserByEmail($data['email']);

                                if($userData && count($userData) > 0){
                                    $response = $response->withJson([
                                        "message" => "O email já está em uso. Por favor, informe um e-mail diferente",
                                        "error" => "true"
                                    ]);
                                }
                                else{
                                    $hashSenha = password_hash($data['senha'], PASSWORD_DEFAULT);
                
                                    $clienteModel->setNome($data['nome']);
                                    $clienteModel->setTelefone($data['telefone']);
                                    $clienteModel->setDataNascimento($data['data_nascimento']);
                                    $clienteModel->setCpf($data['cpf']);
                                    $clienteModel->setEmail($data['email']);
                                    $clienteModel->setSenha($hashSenha);
                
                                    $queryStatus = $clienteDAO->updateCliente($clienteModel, $id);
                
                                    if($queryStatus){
                                        $response = $response->withJson([
                                            "message" => "Cliente atualizado com sucesso",
                                            "error" => "false"
                                        ]);
                                    }
                                    else{
                                        $response = $response->withJson([
                                            "message" => "Erro ao atualizar o cliente",
                                            "error" => "true"
                                        ]);
                                    }
                                }
                            }
                            else{
                                $response = $response->withJson([
                                    "message" => "Informe uma senha com no mínimo 8 caracteres",
                                    "error" => "true"
                                ]);
                            }
                        }
                        else{
                            $response = $response->withJson([
                                "message" => "Informe um email em um formato válido",
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
        
        public function deleteCliente(Request $request, Response $response, array $args): Response 
        {
            $data = $request->getParsedBody();

            if($data && count($data) > 0){
                $fieldsNecessary = ['id'];
                $data = Utilities::treatRequestBody($data, 'PDO');

                $correctFieldsInformed = Utilities::verifyAmountFields($fieldsNecessary, $data);

                if($correctFieldsInformed){
                    $id = $data['id'];

                    if(is_numeric($id)){
                        $clienteDAO = new ClienteDAO();
                        $queryStatus = $clienteDAO->deleteCliente($id);
        
                        if($queryStatus){
                            $response = $response->withJson([
                                "message" => "Cliente deletado com sucesso",
                                "error" => "false"
                            ]);
                        }
                        else{
                            $response = $response->withJson([
                                "message" => "Erro ao deletar o cliente",
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