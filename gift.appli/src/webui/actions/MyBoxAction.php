<?php

namespace gift\appli\webui\actions;

use gift\appli\application_core\application\exceptions\DatabaseException;
use gift\appli\application_core\application\useCases\interfaces\CatalogueServiceInterface;
use gift\appli\webui\actions\AbstractAction;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class MyBoxAction extends AbstractAction {
    private CatalogueServiceInterface $catalogueService;

    public function __construct(CatalogueServiceInterface $catalogueService) {
        $this->catalogueService = $catalogueService;
    }

    public function __invoke(Request $request, Response $response, array $args) {
        $twig = Twig::fromRequest($request);

        try {
            $boxes = $this->catalogueService->getBox();
        } catch (DatabaseException $e) {
            return $twig->render($response, 'error/index.html.twig', [
                "code" => 500,
                "message" => "Erreur interne du serveur, " . $e->getMessage() . " veuillez essayez plus tard."]);
        }
        return $twig->render($response, 'box/index.html.twig', [
            'boxes' => $boxes
        ]);
    }
}