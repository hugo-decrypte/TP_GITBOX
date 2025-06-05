<?php

namespace gift\appli\webui\actions\creer_box;

use gift\appli\webui\actions\abstract\AbstractAction;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;


/**
 * Contrôleur de la page d'accueil de l'application.
 */

class GetCreerCoffretAction extends AbstractAction {

    public function __invoke(Request $request, Response $response, array $args) : Response{
        $twig = Twig::fromRequest($request);
        return $twig->render($response,'coffret_creer.html.twig');
    }
}