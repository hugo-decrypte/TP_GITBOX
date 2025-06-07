<?php
namespace gift\appli\api;

use gift\appli\api\abstract\AbstractApi;
use gift\appli\application_core\application\use_cases\interfaces\CatalogueServiceInterface;
use \Slim\Psr7\Request;
use \Slim\Psr7\Response;


class BoxApi extends AbstractApi {

    public function __construct(private CatalogueServiceInterface $catalogueService){}

    public function __invoke(Request $request, Response $response, array $args) {

        $boxId = $args['id'];
        $box = $this->catalogueService->getBoxById($boxId);
        $prestationsData = $this->catalogueService->getPrestationsByBox($boxId);

        $prestations = [];
        foreach ($prestationsData as $presta) {
            $prestations[] = [
                'libelle' => $presta['libelle'],
                'description' => $presta['description'],
                'contenu' => [
                    'box_id' => $box['id'],
                    'presta_id' => $presta['id'],
                    'quantite' => $presta['quantite'] ?? 1
                ]
            ];
        }

        $collection = [
            "type" => "resource",
            "box" => [
                "id" => $box['id'],
                "libelle" => $box['libelle'],
                "description" => $box['description'],
                "message_kdo" => $box['message_kdo'],
                "statut" => $box['statut'],
                "prestations" => $prestations
            ]
        ];

        $response->getBody()->write(json_encode($collection));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Access-Control-Allow-Origin', '*') // CORS
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET')
            ->withStatus(200);
    }
}
