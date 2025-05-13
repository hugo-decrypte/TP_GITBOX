<?php

namespace gift\appli\Controllers;
use gift\appli\models\Prestation;
use PhpParser\Error;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class PrestationAction extends AbstractAction {

    public function __invoke(Request $request, Response $response, array $args)
    {
        $res = "";
        if($request->getQueryParams() == null) {
            return new Response(400);
        } else {
            $prestations = Prestation::all()->where('id', '=', $request->getQueryParams()['id']);
            foreach ($prestations as $p){
                $res .= $p->libelle . ' : <br>' . $p->description . '<br> Tarif : ' .  $p->tarif . '<br>';
            }
            if(sizeof($prestations) == 0) {
                return new Response(404);
            }
        }
        $response->getBody()->write($res);
        return $response;

    }
}