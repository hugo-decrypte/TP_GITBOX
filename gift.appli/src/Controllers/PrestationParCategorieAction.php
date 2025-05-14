<?php

namespace gift\appli\Controllers;

use gift\appli\models\Prestation;
use gift\appli\models\Categorie;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class PrestationParCategorieAction extends AbstractAction {

    public function __invoke(Request $request, Response $response, array $args): Response {
        $categorieId = $args['id'];
        $prestations = Prestation::where('cat_id', '=', $categorieId)->get();
        $categorie = Categorie::find($categorieId);

        $view = Twig::fromRequest($request);
        return $view->render($response, 'category_prestations.html.twig', [
            "categories" => Categorie::all(),
            'prestations' => $prestations,
            'category' => $categorie,
        ]);
    }
}

