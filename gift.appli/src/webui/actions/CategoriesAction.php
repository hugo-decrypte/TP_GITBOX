<?php

namespace gift\appli\webui\actions;

use gift\appli\application_core\application\exceptions\DatabaseException;
use gift\appli\application_core\application\useCases\interfaces\CatalogueServiceInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

/**
 * Contrôleur chargé d'afficher la liste de toutes les catégories.
 */

class CategoriesAction extends AbstractAction{
    private CatalogueServiceInterface $catalogueService;

    public function __construct(CatalogueServiceInterface $catalogueService) {
        $this->catalogueService = $catalogueService;
    }

     /***
      * Récupère toutes les catégories et les passe au template Twig.
      **/

    public function __invoke(Request $request, Response $response, array $args) {
        $twig = Twig::fromRequest($request);

        try {
            $categories = $this->catalogueService->getCategories();
        } catch (DatabaseException $e) {
            return $twig->render($response, 'error/index.html.twig', ["code" => 500, "message" => "Erreur interne du serveur, " . $e->getMessage() . " veuillez essayez plus tard."]);
        }

        return $twig->render($response, 'category/index.html.twig', [
            'categories' => $categories
        ]);
    }
}