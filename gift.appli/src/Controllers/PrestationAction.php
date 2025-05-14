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

class PrestationAction extends AbstractAction {
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