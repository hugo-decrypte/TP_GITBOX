<?php

namespace gift\appli\webui\actions;

use gift\appli\application_core\application\useCases\interfaces\CatalogueServiceInterface;
use gift\appli\application_core\domain\entities\CoffretType;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

/**
 * Contrôleur chargé d'afficher la liste de toutes les coffrets_types.
 */

class CoffretsAction extends AbstractAction {
    private CatalogueServiceInterface $catalogueService;

    public function __construct(CatalogueServiceInterface $catalogueService) {
        $this->catalogueService = $catalogueService;
    }

    /***
     * Récupère toutes les coffrets et les passe au template Twig.
     **/
    public function __invoke(Request $request, Response $response, array $args) {
        $twig = Twig::fromRequest($request);
        return $twig->render($response, 'coffret/index.html.twig', [
            'coffrets' => CoffretType::all()
        ]);
    }
}