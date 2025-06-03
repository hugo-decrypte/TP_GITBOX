<?php

namespace gift\appli\webui\actions;

use gift\appli\application_core\application\exceptions\DatabaseException;
use gift\appli\application_core\application\useCases\interfaces\CatalogueServiceInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

/**
 * Action chargée de créer une nouvelle box personnalisée vide.
 */
class PostCreerBoxPersoAction extends AbstractAction
{
    private CatalogueServiceInterface $catalogueService;

    public function __construct(CatalogueServiceInterface $catalogueService)
    {
        $this->catalogueService = $catalogueService;
    }

    /**
     * Crée une nouvelle box personnalisée vide et retourne une réponse JSON.
     */
    public function __invoke(Request $request, Response $response, array $args): \Psr\Http\Message\ResponseInterface
    {
        // Récupérer l'ID du créateur depuis la requête ou le contexte utilisateur
        $createurId = "9c02505f-af68-4b51-a5b6-e52b1805eee1";

        // Récupérer les données du formulaire
        $data = $request->getParsedBody();
        $libelle = $data['libelle'] ?? 'Nouvelle Box Vide';
        $description = $data['description'] ?? 'Description par défaut de la box vide';

        // Utiliser le service pour créer une box vide avec les données du formulaire
        $this->catalogueService->creerBoxVide($createurId, $libelle, $description);

        $twig = Twig::fromRequest($request);
        return $twig->render($response, 'home/index.html.twig');
    }
}
