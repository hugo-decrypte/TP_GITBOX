<?php
namespace gift\appli\api;

use gift\appli\api\abstract\AbstractApi;
use gift\appli\application_core\application\use_cases\interfaces\CatalogueServiceInterface;
use \Slim\Psr7\Request;
use \Slim\Psr7\Response;


class PrestationsApi extends AbstractApi {

    public function __construct(private CatalogueServiceInterface $catalogueService){}

    public function __invoke(Request $request, Response $response, array $args) {
        $prestations = $this->catalogueService->getPrestations();

        $collection = [
            "type" => "collection",
            "count" => count($prestations),
            "categories" => []
        ];

        foreach ($prestations as $presta) {
            $collection["prestations"][] = [
                "prestation" => [
                    "id" => $presta['id'],
                    "libelle" => $presta['libelle'],
                    "description" => $presta['description'],
                    "url" => $presta['url'],
                    "unite" => $presta['unite'],
                    "tarif" => $presta['tarif'],
                    "img" => $presta['img'],
                    "cat_id" => $presta['cat_id']
                ],
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
