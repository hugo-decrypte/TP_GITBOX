<?php

namespace gift\appli\Controllers;
use gift\appli\models\Prestation;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class PrestationAction extends AbstractAction {

    public function __invoke(Request $request, Response $response, array $args)
    {
        $res = "";
        if($request->getQueryParams() == null) {
            $res .= "Aucun id renseigné";
        } else {
            $prestation = Prestation::all()->where('id', '=', $request->getQueryParams()['id']);
            foreach ($prestation as $p){
                $res .= $p->libelle . ' : <br>' . $p->description . '<br> Tarif : ' .  $p->tarif . '<br>';
            }
        }
        $response->getBody()->write($res);
        return $response;
    }
}