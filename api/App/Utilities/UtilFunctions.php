<?php 
    namespace App\Utilities;

    use Slim\Http\UploadedFile;
    use App\DAO\MySQL\HouseOfBarber\AutenticarDAO;
    use App\Models\MySQL\HouseOfBarber\AutenticarModel;

    abstract class UtilFunctions{
        public static function moveUploadedFile($directory, UploadedFile $uploadedFile): string
        {
            $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
            $basename = bin2hex(random_bytes(8).uniqid());
            $filename = sprintf('%s.%0.8s', $basename, $extension);

            $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

            return $filename;
        }

        public static function userAuth(string $perfil, string $email, string $senha, array $userData): array
        {
            if($userData && count($userData) > 0){
                $hashSenha = $userData[0]['senha'];

                if(password_verify($senha, $hashSenha)){
                    $token = md5(uniqid() . mt_rand());

                    $autenticarModel = new AutenticarModel();
                    $autenticarDAO = new AutenticarDAO();

                    $autenticarModel->setEmail($email);
                    $autenticarModel->setToken($token);

                    $queryStatus = $autenticarDAO->insertToken($autenticarModel);

                    if($queryStatus){
                        return [
                            "message" => "Autenticado com sucesso",
                            "token" => $token,
                            "duration" => "Até o final do dia vigente",
                            "user_data" => $userData,
                            "type_access" => $perfil,
                            "error" => "false"
                        ];
                    }
                    else{
                       return [
                            "message" => "Ooops, houve um erro interno ao logar. Entre em contato com o administrador",
                            "error" => "true"
                        ];
                    }
                }
                else{
                    return [
                        "message" => "Senha incorreta",
                        "error" => "true"
                    ];
                }
            }
            else{
                return [
                    "message" => "Estabelecimento não cadastro. Por favor, realize seu cadastro.",
                    "error" => "true"
                ];
            }
        }
    }