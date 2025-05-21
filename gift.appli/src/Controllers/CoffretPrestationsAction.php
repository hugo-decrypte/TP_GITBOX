<?php

namespace gift\appli\Controllers;

use gift\appli\models\CoffretType;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;
use Slim\Exception\HttpNotFoundException;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class CoffretPrestationsAction extends AbstractAction {
    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function __invoke(Request $request, Response $response, array $args): \Psr\Http\Message\ResponseInterface
    {
        $id = $args['id'];

        $coffret = CoffretType::with('prestations')->find($id);
        if (!$coffret) {
            throw new HttpNotFoundException($request, "Coffret introuvable");
        }

        $twig = Twig::fromRequest($request);
        return $twig->render($response, 'coffret_prestations.html.twig', [
            'coffret' => $coffret,
            'prestations' => $coffret->prestations
        ]);
    }
}
