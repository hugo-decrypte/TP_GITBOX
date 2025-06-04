<?php

namespace gift\appli\webui\actions\SignIn;

use gift\appli\webui\actions\Abstract\AbstractAction;
use gift\appli\webui\providers\interfaces\AuthnProviderInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class GetSignOutAction extends AbstractAction {
    private AuthnProviderInterface $authnProvider;
    public function __construct(AuthnProviderInterface $authnProvider) {
        $this->authnProvider = $authnProvider;
    }

    public function __invoke(Request $request, Response $response, array $args) {
        $this->authnProvider->signOut();

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        // Générer l'URL depuis le nom de route
        $url = $routeParser->urlFor('homepage');
        // Rediriger
        return $response
            ->withHeader('Location', $url)
            ->withStatus(302);
    }
}