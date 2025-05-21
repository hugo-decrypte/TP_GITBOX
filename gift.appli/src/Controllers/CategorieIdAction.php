<?php

namespace gift\appli\Controllers;

use gift\appli\Controllers\AbstractAction;
use gift\appli\models\Categorie;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Contrôleur pour afficher les détails d'une catégorie spécifique.
 */
class CategorieIdAction extends AbstractAction {

    /**
     * Méthode d'invocation automatique de la route.
     *
     * Récupère une catégorie par son identifiant et génère la vue correspondante.
     *
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function __invoke(Request $request, Response $response, array $args)
    {
        $categories = Categorie::all();
        $category = Categorie::where('id','=',$args['id'])->first();

        if($category == null) {
            return new Response(404);
        }

        $twig = Twig::fromRequest($request);
        return $twig->render($response,'category_by_id.html.twig', [
            'categories' => $categories,
            'category' => $category
        ]);
    }
}