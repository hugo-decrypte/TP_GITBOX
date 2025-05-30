<?php

namespace gift\appli\webui\actions;

use gift\appli\application_core\application\useCases\interfaces\CatalogueServiceInterface;
use gift\appli\application_core\domain\entities\Theme;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

/**
 * Contrôleur chargé d'afficher la liste des thèmes disponibles.
 */

class ThemesAction extends AbstractAction {
    private CatalogueServiceInterface $catalogueService;

    public function __construct(CatalogueServiceInterface $catalogueService) {
        $this->catalogueService = $catalogueService;
    }
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