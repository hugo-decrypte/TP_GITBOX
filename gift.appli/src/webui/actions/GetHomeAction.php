<?php

namespace gift\appli\webui\actions;

use gift\appli\webui\actions\Abstract\AbstractAction;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

/**
 * Contrôleur de la page d'accueil de l'application.
 */
class GetHomeAction extends AbstractAction {
    public function __invoke(Request $request, Response $response, array $args)
    {
        $twig = Twig::fromRequest($request);
        return $twig->render($response,'home/index.html.twig');
    }
}