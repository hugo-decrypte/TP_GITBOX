<?php

namespace gift\appli\Controllers;

use gift\appli\models\Prestation;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

/**
 * Contrôleur chargé d'afficher la liste de toutes les coffrets_types.
 */

class Prestations extends AbstractAction {

    /***
     * Récupère toutes les coffrets et les passe au template Twig.
     **/

    public function __invoke(Request $request, Response $response, array $args) {
        $twig = Twig::fromRequest($request);
        return $twig->render($response, 'prestation/index.html.twig', [
            'prestations' => Prestation::all()
        ]);
    }
}