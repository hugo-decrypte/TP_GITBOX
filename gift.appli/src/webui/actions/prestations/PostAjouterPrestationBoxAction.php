<?php

namespace gift\appli\webui\actions\prestations;

use gift\appli\application_core\application\use_cases\interfaces\CatalogueServiceInterface;
use gift\appli\webui\actions\Abstract\AbstractAction;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class PostAjouterPrestationBoxAction extends AbstractAction
{
    private CatalogueServiceInterface $catalogueService;

    public function __construct(CatalogueServiceInterface $catalogueService)
    {
        $this->catalogueService = $catalogueService;
    }

    public function __invoke(Request $request, Response $response, array $args): \Psr\Http\Message\ResponseInterface
    {
        // Récupérer les données du formulaire
        $data = $request->getParsedBody();

        // Récupérer l'ID de la prestation
        $prestationId = $data['prestation_id'] ?? null;

        // Récupérer les IDs des boxes cochées
        $boxes = $data['boxes'] ?? [];

        // Pour chaque box cochée, ajouter la prestation à la box
        $quantite = 1; // Quantité par défaut

        foreach ($boxes as $boxId) {
            $this->catalogueService->addPrestationBox($boxId, $prestationId, $quantite);
        }

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('prestations');

        // Rediriger
        return $response
            ->withHeader('Location', $url)
            ->withStatus(302);
    }
}
