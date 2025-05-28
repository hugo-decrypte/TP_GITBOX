<?php

namespace gift\appli\webui\actions;

use gift\appli\application_core\domain\entities\Categorie;
use gift\appli\application_core\domain\entities\Prestation;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

/**
 * Contrôleur chargé d'afficher la liste de toutes les catégories.
 */

class CategoriesAction extends AbstractAction{

     /***
      * Récupère toutes les catégories et les passe au template Twig.
      **/

    public function __invoke(Request $request, Response $response, array $args) {
        $twig = Twig::fromRequest($request);
        return $twig->render($response, 'category/index.html.twig', [
            'categories' => Categorie::all(),
            'prestations' => Prestation::all()
        ]);
    }
}