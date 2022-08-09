<?php 
    namespace App\Controllers;

    use Psr\Http\Message\RequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;

    use App\DAO\MySQL\HouseOfBarber\EstabelecimentoDAO;
    use App\Models\MySQL\HouseOfBarber\EstabelecimentoModel;
    use App\Assets\BaseLib\App\Utilities;

    final class EstabelecimentoController{
        public function getEstabelecimentos(Request $request, Response $response, array $args): Response 
        {
            $estabelecimentoDAO = new EstabelecimentoDAO();
            $estabelecimentos = $estabelecimentoDAO->getAll();

            $response = $response->withJson($estabelecimentos);
            
            return $response;
        }

        public function getEstabelecimento(Request $request, Response $response, array $args): Response 
        {
            if(isset($args['id'])){
                $id = $args['id'];
    
                if(is_numeric($id)){
                    $estabelecimentoDAO = new EstabelecimentoDAO();
                    $estabelecimento = $estabelecimentoDAO->findById($id);
        
                    $response = $response->withJson($estabelecimento);
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
        
        public function insertEstabelecimento(Request $request, Response $response, array $args): Response 
        {
            $data = $request->getParsedBody();

            if($data && count($data) > 0){
                $fieldsNecessary = ['nome_admin', 'telefone_admin', 'cpf_admin', 'email', 'senha', 'nome', 'telefone', 'cnpj'];
                $data = Utilities::treatRequestBody($data, 'PDO');

                $correctFieldsInformed = Utilities::verifyAmountFields($fieldsNecessary, $data);

                if($correctFieldsInformed){
                    if(filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                        if(strlen($data['senha']) >= 8){
                            $estabelecimentoModel = new EstabelecimentoModel();
                            $estabelecimentoDAO = new EstabelecimentoDAO();

                            $userData = $estabelecimentoDAO->findUserByEmail($data['email']);

                            if($userData && count($userData) > 0){                               
                                $response = $response->withJson([
                                    "message" => "O email já está em uso. Por favor, informe um e-mail diferente",
                                    "error" => "true"
                                ]);
                            }
                            else{
                                $hashSenha = password_hash($data['senha'], PASSWORD_DEFAULT);
                
                                $estabelecimentoModel->setNomeAdmin($data['nome_admin']);
                                $estabelecimentoModel->setTelefoneAdmin($data['telefone_admin']);
                                $estabelecimentoModel->setCpfAdmin($data['cpf_admin']);
                                $estabelecimentoModel->setEmail($data['email']);
                                $estabelecimentoModel->setSenha($hashSenha);
                                $estabelecimentoModel->setNome($data['nome']);
                                $estabelecimentoModel->setTelefone($data['telefone']);
                                $estabelecimentoModel->setCnpj($data['cnpj']);
                                
                                $queryData = $estabelecimentoDAO->insertEstabelecimento($estabelecimentoModel);
                                $queryStatus = $queryData[0];
                                $insertedId = $queryData[1];
                    
                                if($queryStatus){
                                    $response = $response->withJson([
                                        "message" => "Estabelecimento cadastrado com sucesso",
                                        "establishment_id" => $insertedId,
                                        "error" => "false"
                                    ]);
                                }
                                else{
                                    $response = $response->withJson([
                                        "message" => "Erro ao inserir o estabelecimento",
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
        
        public function updateEstabelecimento(Request $request, Response $response, array $args): Response 
        {
            $data = $request->getParsedBody();

            if($data && count($data) > 0){
                $fieldsNecessary = ['nome_admin', 'telefone_admin', 'cpf_admin', 'email', 'senha', 'nome', 'telefone', 'cnpj'];
                $data = Utilities::treatRequestBody($data, 'PDO');

                $correctFieldsInformed = Utilities::verifyAmountFields($fieldsNecessary, $data);

                if($correctFieldsInformed){
                    $id = $data['id'];

                    if(is_numeric($id)){
                        if(filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                            $estabelecimentoModel = new EstabelecimentoModel();
                            $estabelecimentoDAO = new EstabelecimentoDAO();

                            $userData = $estabelecimentoDAO->findUserByEmail($data['email']);

                            if($userData && count($userData) > 0){
                                $response = $response->withJson([
                                    "message" => "O email já está em uso. Por favor, informe um e-mail diferente",
                                    "error" => "true"
                                ]);
                            }
                            else{
                                $hashSenha = password_hash($data['senha'], PASSWORD_DEFAULT);
            
                                $estabelecimentoModel->setNomeAdmin($data['nome_admin']);
                                $estabelecimentoModel->setTelefoneAdmin($data['telefone_admin']);
                                $estabelecimentoModel->setCpfAdmin($data['cpf_admin']);
                                $estabelecimentoModel->setEmail($data['email']);
                                $estabelecimentoModel->setSenha($hashSenha);
                                $estabelecimentoModel->setNome($data['nome']);
                                $estabelecimentoModel->setTelefone($data['telefone']);
                                $estabelecimentoModel->setCnpj($data['cnpj']);
            
                                $queryStatus = $estabelecimentoDAO->updateEstabelecimento($estabelecimentoModel, $id);
            
                                if($queryStatus){
                                    $response = $response->withJson([
                                        "message" => "Estabelecimento atualizado com sucesso",
                                        "error" => "false"
                                    ]);
                                }
                                else{
                                    $response = $response->withJson([
                                        "message" => "Erro ao atualizar o estabelecimento",
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
        
        public function deleteEstabelecimento(Request $request, Response $response, array $args): Response 
        {
            $data = $request->getParsedBody();

            if($data && count($data) > 0){
                $fieldsNecessary = ['id'];
                $data = Utilities::treatRequestBody($data, 'PDO');

                $correctFieldsInformed = Utilities::verifyAmountFields($fieldsNecessary, $data);

                if($correctFieldsInformed){
                    $id = $data['id'];

                    if(is_numeric($id)){
                        $estabelecimentoDAO = new EstabelecimentoDAO();
                        $queryStatus = $estabelecimentoDAO->deleteEstabelecimento($id);
        
                        if($queryStatus){
                            $response = $response->withJson([
                                "message" => "Estabalecimento deletado com sucesso",
                                "error" => "false"
                            ]);
                        }
                        else{
                            $response = $response->withJson([
                                "message" => "Erro ao deletar o estabalecimento",
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