<?php

namespace gift\appli\webui\actions\prestations;

use gift\appli\application_core\application\exceptions\DatabaseException;
use gift\appli\application_core\application\use_cases\interfaces\CatalogueServiceInterface;
use gift\appli\webui\actions\Abstract\AbstractAction;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

/**
 * Contrôleur chargé d'afficher la liste de toutes les coffrets_types.
 */


class GetPrestationsAction extends AbstractAction {
    private CatalogueServiceInterface $catalogueService;

    public function __construct(CatalogueServiceInterface $catalogueService) {
        $this->catalogueService = $catalogueService;
    }

    /***
     * Récupère toutes les coffrets et les passe au template Twig.
     **/

    public function __invoke(Request $request, Response $response, array $args) {
        $twig = Twig::fromRequest($request);

        try {
            $prestations = $this->catalogueService->getPrestations();
            $boxes = $this->catalogueService->getBox();
        } catch (DatabaseException $e) {
            return $twig->render($response, 'error/index.html.twig', ["code" => 500, "message" => "Erreur interne du serveur, " . $e->getMessage() . " veuillez essayer plus tard."]);
        }

        return $twig->render($response, 'prestation/index.html.twig', [
            'prestations' => $prestations,
            "boxes" => $boxes
        ]);
    }
}