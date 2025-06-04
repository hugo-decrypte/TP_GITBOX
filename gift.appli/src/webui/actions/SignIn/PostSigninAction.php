<?php

namespace gift\appli\webui\actions\SignIn;

use gift\appli\application_core\application\exceptions\DatabaseException;
use gift\appli\webui\actions\Abstract\AbstractAction;
use gift\appli\webui\providers\interfaces\AuthnProviderInterface;
use MongoDB\Driver\Exception\AuthenticationException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class PostSigninAction extends AbstractAction {
    private AuthnProviderInterface $authnProvider;
    public function __construct(AuthnProviderInterface $authnProvider) {
        $this->authnProvider = $authnProvider;
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        $twig = Twig::fromRequest($request);
        $data = $request->getParsedBody();
        $email = $data['email'];
        $password = $data['password'];

        try{
            $this->authnProvider->signin($email, $password);
        } catch(DatabaseException $e) {
            return $twig->render($response, 'error/index.html.twig', ["code" => 500, "message" => "Erreur interne du serveur, " . $e->getMessage() . " Veuillez essayer plus tard."]);
        } catch(AuthenticationException $e) {
            return $twig->render($response, 'error/index.html.twig', ["code" => 500, "message" => "Erreur lors de l'authentification, " . $e->getMessage() . " Veuillez essayer plus tard."]);
        }

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        // Générer l'URL depuis le nom de route
        $url = $routeParser->urlFor('homepage');
        // Rediriger
        return $response
            ->withHeader('Location', $url)
            ->withStatus(302);
    }
}