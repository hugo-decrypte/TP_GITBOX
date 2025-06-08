<?php

namespace gift\appli\webui\actions;

use gift\appli\application_core\application\exceptions\DatabaseException;
use gift\appli\application_core\application\use_cases\interfaces\CatalogueServiceInterface;
use gift\appli\webui\actions\Abstract\AbstractAction;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class PostValidateBoxAction extends AbstractAction {
    private CatalogueServiceInterface $catalogueService;

    public function __construct(CatalogueServiceInterface $catalogueService) {
        $this->catalogueService = $catalogueService;
    }

    public function __invoke(Request $request, Response $response, array $args) {
        $twig = Twig::fromRequest($request);

        try {
            $data = $request->getParsedBody();
            $id = $data['id'];
            $this->catalogueService->validateBox($id);
            $boxes = $this->catalogueService->getBox();
        } catch (DatabaseException $e) {
            return $twig->render($response, 'error/index.html.twig', [
                "code" => 500,
                "message" => "Erreur interne du serveur, " . $e->getMessage() . " Veuillez essayez plus tard."]);
        }

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();

        // Générer l'URL depuis le nom de route
        $url = $routeParser->urlFor('myBox');

        // Rediriger
        return $response
            ->withHeader('Location', $url)
            ->withStatus(302);
    }
}