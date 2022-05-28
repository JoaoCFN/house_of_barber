<?php 
    namespace App\Controllers;

    use Psr\Http\Message\RequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;

    use App\DAO\MySQL\HouseOfBarber\TesteDAO;
    use App\Models\MySQL\HouseOfBarber\TesteModel;
    use App\Assets\BaseLib\App\Utilities;

    final class TesteController{
        public function getTestes(Request $request, Response $response, array $args): Response 
        {
            $testeDAO = new TesteDAO();
            $testes = $testeDAO->getAll();

            $response = $response->withJson($testes);
            
            return $response;
        }

        public function getTeste(Request $request, Response $response, array $args): Response 
        {
            if(isset($args['id'])){
                $id = $args['id'];
    
                if(is_numeric($id)){
                    $testeModel = new TesteModel();
                    $teste = $testeModel->findById($id);
        
                    $response = $response->withJson($teste);
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
        
        public function insertTeste(Request $request, Response $response, array $args): Response 
        {
            $data = $request->getParsedBody();

            if(count($data) > 0){
                $fieldsNecessary = ['nome'];
                $data = Utilities::treatRequestBody($data, 'PDO');

                $correctFieldsInformed = Utilities::verifyAmountFields($fieldsNecessary, $data);

                if($correctFieldsInformed){
                    $testeModel = new TesteModel();
                    $testeDAO = new TesteDAO();
        
                    $testeModel->setNome($data['nome']);
        
                    $queryStatus = $testeDAO->insertTeste($testeModel);
        
                    if($queryStatus){
                        $response = $response->withJson([
                            "message" => "Teste inserida com sucesso",
                            "error" => "false"
                        ]);
                    }
                    else{
                        $response = $response->withJson([
                            "message" => "Erro ao inserir a teste",
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
        
        public function updateTeste(Request $request, Response $response, array $args): Response 
        {
            $data = $request->getParsedBody();

            if(count($data) > 0){
                $fieldsNecessary = ['id', 'nome'];
                $data = Utilities::treatRequestBody($data, 'PDO');

                $correctFieldsInformed = Utilities::verifyAmountFields($fieldsNecessary, $data);

                if($correctFieldsInformed){
                    $id = $data['id'];

                    if(is_numeric($id)){
                        $testeModel = new TesteModel();
                        $testeDAO = new TesteDAO();
    
                        $testeModel->setNome($data['nome']);
    
                        $queryStatus = $testeDAO->updateTeste($testeModel, $id);
    
                        if($queryStatus){
                            $response = $response->withJson([
                                "message" => "Teste atualiza com sucesso",
                                "error" => "false"
                            ]);
                        }
                        else{
                            $response = $response->withJson([
                                "message" => "Erro ao atualizar a teste",
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
        
        public function deleteTeste(Request $request, Response $response, array $args): Response 
        {
            $data = $request->getParsedBody();

            if(count($data) > 0){
                $fieldsNecessary = ['id'];
                $data = Utilities::treatRequestBody($data, 'PDO');

                $correctFieldsInformed = Utilities::verifyAmountFields($fieldsNecessary, $data);

                if($correctFieldsInformed){
                    $id = $data['id'];

                    if(is_numeric($id)){
                        $testeDAO = new TesteDAO();
                        $queryStatus = $testeDAO->deleteTeste($id);
        
                        if($queryStatus){
                            $response = $response->withJson([
                                "message" => "Teste deletada com sucesso",
                                "error" => "false"
                            ]);
                        }
                        else{
                            $response = $response->withJson([
                                "message" => "Erro ao deletar a teste",
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