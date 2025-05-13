<?php


use gift\appli\Controllers\CategorieIdAction;
use gift\appli\Controllers\CategoriesAction;
use gift\appli\models\Categorie;
use gift\appli\models\Prestation;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


return function ($app) {
    $app->get('/categories', new CategoriesAction());
    $app->get('/categories/{id}', new CategorieIdAction());

    $app->get('/prestation', function (Request $request, Response $response, array $args){
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
    });
    return $app;
};