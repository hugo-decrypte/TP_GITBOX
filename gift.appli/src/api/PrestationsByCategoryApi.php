<?php
namespace gift\appli\api;

use gift\appli\api\abstract\AbstractApi;
use gift\appli\application_core\application\use_cases\interfaces\CatalogueServiceInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;


class PrestationsByCategoryApi extends AbstractApi {

    public function __construct(private CatalogueServiceInterface $catalogueService){}

    public function __invoke(Request $request, Response $response, array $args) {
        $prestations = $this->catalogueService->getPrestations();

        $collection = [
            "type" => "collection",
            "count" => count($prestations),
            "prestations" => []
        ];

        foreach ($prestations as $prestation) {
            $collection["prestations"][] = [
                "id" => $prestation['id'],
                "libelle" => $prestation['libelle'],
                "tarif" => $prestation['tarif'],
                "unite" => $prestation['unite'],
                "description" => $prestation['description']
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
