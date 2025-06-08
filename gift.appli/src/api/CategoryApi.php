<?php
namespace gift\appli\api;

use gift\appli\api\abstract\AbstractApi;
use gift\appli\application_core\application\use_cases\interfaces\CatalogueServiceInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;


class CategoryApi extends AbstractApi {

    public function __construct(private CatalogueServiceInterface $catalogueService){}

    public function __invoke(Request $request, Response $response, array $args) {
        $categories = $this->catalogueService->getCategories();

        $collection = [
            "type" => "collection",
            "count" => count($categories),
            "categories" => []
        ];

        foreach ($categories as $cat) {
            $collection["categories"][] = [
                "categorie" => [
                    "id" => $cat['id'],
                    "libelle" => $cat['libelle'],
                    "description" => $cat['description']
                ],
                "links" => [
                    "self" => [ "href" => "/api/categories/{$cat['id']}/prestations" ]
                ]
            ];
        }

        $response->getBody()->write(json_encode($collection));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Access-Control-Allow-Origin', '*') // CORS
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET')
            ->withStatus(200);
    }
}
