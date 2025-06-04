<?php

namespace gift\appli\webui\actions\CreerBox;


use gift\appli\application_core\application\useCases\interfaces\CatalogueServiceInterface;
use gift\appli\models\Box;
use gift\appli\webui\actions\Abstract\AbstractAction;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;


/**
 * Contrôleur de la page d'accueil de l'application.
 */

class GetCreerCoffretAction extends AbstractAction {
    private CatalogueServiceInterface $catalogueService;

    public function __construct(CatalogueServiceInterface $catalogueService) {
        $this->catalogueService = $catalogueService;
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        $twig = Twig::fromRequest($request);
        return $twig->render($response,'coffret_creer.html.twig');
    }
}