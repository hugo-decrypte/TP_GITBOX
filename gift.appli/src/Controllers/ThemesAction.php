<?php

namespace gift\appli\Controllers;

use gift\appli\models\Theme;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

/**
 * Contrôleur chargé d'afficher la liste des thèmes disponibles.
 */

class ThemesAction extends AbstractAction {
    /**
     * Récupère tous les thèmes depuis la base de données et les affiche à l’aide de Twig.
    **/
    public function __invoke(Request $request, Response $response, array $args) {
        $twig = Twig::fromRequest($request);
        return $twig->render($response, 'theme/index.html.twig', [
            'themes' => Theme::all()
        ]);
    }
}