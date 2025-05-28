<?php

namespace gift\appli\Controllers;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;



/**
 * Contrôleur de la page d'accueil de l'application.
 */

class CreerCoffretAction extends AbstractAction {

    public function __invoke(Request $request, Response $response, array $args)
    {
        $twig = Twig::fromRequest($request);
        return $twig->render($response,'coffret_creer.html.twig');
    }
}