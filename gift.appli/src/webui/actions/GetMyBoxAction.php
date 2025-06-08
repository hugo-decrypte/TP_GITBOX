<?php

namespace gift\appli\webui\actions;

use gift\appli\application_core\application\exceptions\DatabaseException;
use gift\appli\application_core\application\use_cases\interfaces\CatalogueServiceInterface;
use gift\appli\webui\actions\Abstract\AbstractAction;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class GetMyBoxAction extends AbstractAction {
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

        $boxesValidated = array_filter($boxes, fn($box) => $box["statut"] != 0);
        $boxesNotValidated = array_filter($boxes, fn($box) => $box["statut"] == 0);

        return $twig->render($response, 'box/index.html.twig', [
            'boxesValidated' => $boxesValidated,
            'boxesNotValidated' => $boxesNotValidated
        ]);
    }
}