<?php 
    namespace config;

    use App\Controllers\AutenticarController;
    use Psr\Http\Message\RequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;

    $verifyAuth = function(Request $request, Response $response, $next): Response
    {
        $autenticarController = new AutenticarController();
        $message = $autenticarController->verificar($request, $response);

        if($message == 'Token válido'){
            $response = $next($request, $response);
        }
        else{
            $response = $response->withJson([
                "message" => $message,
                "error" => "true"
            ], 401);
        }

        return $response;
    };