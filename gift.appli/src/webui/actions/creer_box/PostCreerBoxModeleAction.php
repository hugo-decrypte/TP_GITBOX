<?php

namespace gift\appli\webui\actions\creer_box;

use gift\appli\application_core\application\use_cases\interfaces\CatalogueServiceInterface;
use gift\appli\webui\actions\Abstract\AbstractAction;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class PostCreerBoxModeleAction extends AbstractAction
{
    private CatalogueServiceInterface $catalogueService;

    public function __construct(CatalogueServiceInterface $catalogueService)
    {
        $this->catalogueService = $catalogueService;
    }

    public function __invoke(Request $request, Response $response, array $args): \Psr\Http\Message\ResponseInterface
    {
        $createurId = "9c02505f-af68-4b51-a5b6-e52b1805eee1";

        $data = $request->getParsedBody();
        $libelle = $data['libelle'];
        $description = $data['description'];
        $coffretType = $data['selector'];

        $this->catalogueService->creerBoxModel($createurId, $libelle, $description, $coffretType);

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();

        $url = $routeParser->urlFor('myBox');

        return $response
            ->withHeader('Location', $url)
            ->withStatus(302);
    }
}
