<?php

namespace gift\appli\webui\actions;

use gift\appli\application_core\application\exceptions\DatabaseException;
use gift\appli\application_core\application\useCases\interfaces\CatalogueServiceInterface;
use gift\appli\webui\actions\Abstract\AbstractAction;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

/**
 * Contrôleur chargé d'afficher la liste des thèmes disponibles.
 */

class GetThemesAction extends AbstractAction {
    private CatalogueServiceInterface $catalogueService;

    public function __construct(CatalogueServiceInterface $catalogueService) {
        $this->catalogueService = $catalogueService;
    }
    /**
     * Récupère tous les thèmes depuis la base de données et les affiche à l’aide de Twig.
    **/
    public function __invoke(Request $request, Response $response, array $args) {
        $twig = Twig::fromRequest($request);
        try {
            $themes = $this->catalogueService->getThemesCoffrets();
        } catch (DatabaseException $e) {
            return $twig->render($response, 'error/index.html.twig', ["code" => 500, "message" => "Erreur interne du serveur, " . $e->getMessage() . " veuillez essayer plus tard."]);
        }

        return $twig->render($response, 'theme/index.html.twig', [
            'themes' => $themes
        ]);
    }
}