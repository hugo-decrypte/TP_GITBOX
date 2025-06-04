<?php

namespace gift\appli\webui\actions\Register;

use gift\appli\application_core\application\exceptions\DatabaseException;
use gift\appli\application_core\application\useCases\AuthnService;
use gift\appli\webui\actions\Abstract\AbstractAction;
use MongoDB\Driver\Exception\AuthenticationException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class PostCreerCompteAction extends AbstractAction {

    public function __invoke(Request $request, Response $response, array $args)
    {
        $twig = Twig::fromRequest($request);
        $data = $request->getParsedBody();
        $email = $data['email'];
        $password = $data['password'];

        try{
            $authn = new AuthnService();
            $authn->register($email,$password);
        } catch(DatabaseException $e) {
            return $twig->render($response, 'error/index.html.twig', ["code" => 500, "message" => "Erreur interne du serveur, " . $e->getMessage() . " Veuillez essayer plus tard."]);
        } catch(AuthenticationException $e) {
            return $twig->render($response, 'error/index.html.twig', ["code" => 500, "message" => $e->getMessage()]);
        }


        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        // Générer l'URL depuis le nom de route
        $url = $routeParser->urlFor('signin');
        // Rediriger
        return $response
            ->withHeader('Location', $url)
            ->withStatus(302);
    }
}