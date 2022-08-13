<?php
    namespace App\Controllers;

    use Psr\Http\Message\RequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;

    use App\DAO\MySQL\HouseOfBarber\AutenticarDAO;
    use App\Models\MySQL\HouseOfBarber\AutenticarModel;
    use App\DAO\MySQL\HouseOfBarber\EstabelecimentoDAO;
    use App\Assets\BaseLib\App\Utilities;
    use App\DAO\MySQL\HouseOfBarber\ClienteDAO;
    use App\Utilities\UtilFunctions;

    final class AutenticarController
    {
        public function autenticar(Request $request, Response $response, array $args): Response
        {
            $data = $request->getParsedBody();

            if ($data && count($data) > 0) {
                $fieldsNecessary = ['perfil', 'email', 'senha'];

                $data = Utilities::treatRequestBody($data);
                $correctFieldsInformed = Utilities::verifyAmountFields($fieldsNecessary, $data);

                if ($correctFieldsInformed) {
                    $perfil = $data['perfil'];
                    $email = $data['email'];
                    $senha = $data['senha'];

                    if($perfil == "" || $email == "" || $senha == ""){
                        $response = $response->withJson([
                            "message" => "Informe os campos necessários para a realização do login",
                            "error" => "true"
                        ]);
                    }
                    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $response = $response->withJson([
                            "message" => "Informe um email válido",
                            "error" => "true"
                        ]);
                    }
                    else if(strlen($senha) < 8){
                        $response = $response->withJson([
                            "message" => "A senha deve conter no mínimo 8 caracteres",
                            "error" => "true"
                        ]);
                    }
                    else{
                        if($perfil == "ESTABELECIMENTO"){
                            $estabelecimentoDAO = new EstabelecimentoDAO();

                            $userData = $estabelecimentoDAO->findUserByEmail($email);
                            
                            $response = $response->withJson(UtilFunctions::userAuth($perfil, $senha, $userData));
                        }
                        else if($perfil == "CLIENTE"){
                            $clienteDAO = new ClienteDAO();

                            $userData = $clienteDAO->findUserByEmail($email);

                            $response = $response->withJson(UtilFunctions::userAuth($perfil, $senha, $userData));
                        }
                        else{
                            $response = $response->withJson([
                                "message" => "Informe um perfil do usuário válido",
                                "error" => "true"
                            ]);
                        }
                    }
                } 
                else {
                    $response = $response->withJson([
                        "message" => "Informe os campos necessários para a realização do login",
                        "error" => "true"
                    ]);
                }
            } 
            else {
                $response = $response->withJson([
                    "message" => "Informe os campos necessários para a realização do login",
                    "error" => "true"
                ]);
            }

            return $response;
        }

        public function verificar(Request $request, Response $response): string
        {
            $headers = $request->getHeaders();

            $autenticarDAO = new AutenticarDAO();
            $autenticarModel = new AutenticarModel();

            if(isset($headers['HTTP_TOKEN'])){
                $token = $headers['HTTP_TOKEN'][0];
                
                $autenticarModel->setToken($token);
                $tokenExists = $autenticarDAO->findToken($autenticarModel);

                if($tokenExists > 0) {
                    $message = "Token válido";
                } 
                else {
                    $message = "Token inválido. Realize a sua autenticação.";
                }
            } 
            else {
                $message = "Informe o token de acesso";
            }

            return $message;
        }
    }
