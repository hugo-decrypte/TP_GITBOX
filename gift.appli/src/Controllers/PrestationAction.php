<?php

namespace gift\appli\Controllers;
use gift\appli\models\Prestation;
use PhpParser\Error;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class PrestationAction extends AbstractAction {
    public function __invoke(Request $request, Response $response, array $args)
    {
        $twig = Twig::fromRequest($request);
        if($request->getQueryParams() == null) {
            return new Response(400);
        } else {
            $prestation = Prestation::all()->where('id', '=', $request->getQueryParams()['id'])->first();
        }
        return $twig->render($response,'prestation.html.twig', ['prestation' => $prestation]);

    }
}