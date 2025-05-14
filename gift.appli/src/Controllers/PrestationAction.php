<?php

namespace gift\appli\Controllers;
use gift\appli\models\Prestation;
use PhpParser\Error;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class PrestationAction extends AbstractAction {

    private $twig;
    public function __construct($twig){
        $this->twig = $twig;
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        if($request->getQueryParams() == null) {
            return new Response(400);
        } else {
            $prestation = Prestation::all()->where('id', '=', $request->getQueryParams()['id'])->first();
        }
        $html = $this->twig->render('prestation.html.twig', ['prestation' => $prestation]);
        $response->getBody()->write($html);
        return $response;

    }
}