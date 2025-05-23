<?php

namespace gift\appli\Controllers;

use gift\appli\models\Theme;
use Illuminate\Support\ItemNotFoundException;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpInternalServerErrorException;
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
        try {
            $twig = Twig::fromRequest($request);
            return $twig->render($response, 'theme.html.twig', [
                'themes' => Theme::all()
            ]);
        }
        catch( HttpBadRequestException ){
            return $twig->render($response, 'erreur404.html.twig');
            //return new Response(400);
        } catch( HttpInternalServerErrorException ) {
            return new Response(500);
        } catch( ItemNotFoundException ) {
            return $twig->render($response, 'erreur404.html.twig');
        }
    }
}