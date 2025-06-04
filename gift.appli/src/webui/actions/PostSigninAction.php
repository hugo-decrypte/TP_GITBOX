<?php

namespace gift\appli\webui\actions;

use gift\appli\application_core\application\exceptions\DatabaseException;
use gift\appli\application_core\application\providers\SessionAuthnProvider;
use MongoDB\Driver\Exception\AuthenticationException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class PostSigninAction extends AbstractAction{

    public function __invoke(Request $request, Response $response, array $args)
    {
        $twig = Twig::fromRequest($request);
        $data = $request->getParsedBody();
        $email = $data['email'];
        $password = $data['password'];

        try{
            $provider = new SessionAuthnProvider();
            $provider->signin($email, $password);
        } catch(DatabaseException $e) {
            return $twig->render($response, 'error/index.html.twig', ["code" => 500, "message" => "Erreur interne du serveur, " . $e->getMessage() . " Veuillez essayer plus tard."]);
        } catch(AuthenticationException $e) {
            return $twig->render($response, 'error/index.html.twig', ["code" => 500, "message" => "Erreur lors de l'authentification, " . $e->getMessage() . " Veuillez essayer plus tard."]);
        }
        return $twig->render($response, 'home/index.html.twig');
    }
}