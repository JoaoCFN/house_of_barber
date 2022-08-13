<?php 
    namespace config;

    use App\Assets\BaseLib\App\Utilities;
    use App\DAO\MySQL\HouseOfBarber\AutenticarDAO;
    use App\Models\MySQL\HouseOfBarber\AutenticarModel;

    use Psr\Http\Message\RequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;

    $verifyAuthCliente = function(Request $request, Response $response, $next): Response
    {
        if(isset($_COOKIE["user_token"])){
            $userTokenCookie = Utilities::treatRequestBody([$_COOKIE["user_token"]])[0];

            $autenticarDAO = new AutenticarDAO();
            $autenticarModel = new AutenticarModel();

            $autenticarModel->setToken($userTokenCookie);

            $userData = $autenticarDAO->findUserByToken($autenticarModel);

            if($userData && $userData[0]["perfil"] == "CLIENTE"){
                $response = $next($request, $response);
            }
            else{
                setcookie("user_token", "", time() - 3600, "/");
                
                $response = $response->withRedirect('/house_of_barber');
            }
        }
        else{
            setcookie("user_token", "", time() - 3600, "/");

            $response = $response->withRedirect('/house_of_barber');
        }

        return $response;
    };

    $verifyAuthBarbearia = function(Request $request, Response $response, $next): Response
    {
        if(isset($_COOKIE["user_token"])){
            $userTokenCookie = Utilities::treatRequestBody([$_COOKIE["user_token"]])[0];

            $autenticarDAO = new AutenticarDAO();
            $autenticarModel = new AutenticarModel();

            $autenticarModel->setToken($userTokenCookie);

            $userData = $autenticarDAO->findUserByToken($autenticarModel);

            if($userData && $userData[0]["perfil"] == "ESTABELECIMENTO"){
                $response = $next($request, $response);
            }
            else{
                setcookie("user_token", "", time() - 3600, "/");
                
                $response = $response->withRedirect('/house_of_barber');
            }
        }
        else{
            setcookie("user_token", "", time() - 3600, "/");

            $response = $response->withRedirect('/house_of_barber');
        }

        return $response;
    };