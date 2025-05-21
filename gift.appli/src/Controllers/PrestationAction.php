<?php

namespace gift\appli\Controllers;
use gift\appli\models\Prestation;
use Illuminate\Support\ItemNotFoundException;
use PhpParser\Error;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpInternalServerErrorException;
use Slim\Exception\HttpNotFoundException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;


/**
 * Contrôleur chargé de gérer l'affichage ou le traitement d'une prestation.
 */

class PrestationAction extends AbstractAction {

      /**
       * Méthode invoquée automatiquement par Slim lorsqu'une route correspond à cette action.
       *
       * @param Request $request L'objet représentant la requête HTTP entrante.
       * @param Response $response L'objet représentant la réponse HTTP à renvoyer.
       * @param array $args Les arguments de la route, souvent les paramètres d'URL.
       **/

    public function __invoke(Request $request, Response $response, array $args)
    {
        try {
            $twig = Twig::fromRequest($request);
            $prestation = Prestation::all()->where('id', '=', $request->getQueryParams()['id'])->firstOrFail();
        }
        catch( HttpBadRequestException ) {
            return new Response(400);
        } catch( HttpInternalServerErrorException ) {
            return new Response(500);
        } catch( ItemNotFoundException ) {
            return new Response(404);
        }
        return $twig->render($response,'prestation.html.twig', ['prestation' => $prestation]);

    }
}