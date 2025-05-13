<?php


use gift\appli\models\Categorie;
use gift\appli\models\Prestation;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


return function ($app) {
    $app->get('/categories', function (Request $request, Response $response, array $args) {
        $categories = Categorie::all();
        $first = true;
        foreach ($categories as $category) {
            if (!$first) {
                $response->getBody()->write(" - ");
            } else {
                $first = false;
            }
            $response->getBody()->write("<a href='/categories/{$category->id}'> {$category->libelle}</a>");
        }
        return $response;
    });

    $app->get('/categories/{id}', function (Request $request, Response $response, array $args) {
        $categories = Categorie::all()->where('id','=',$args['id']);
        $res = "";
        foreach ($categories as $category) {
            $res .= $category->libelle . "<br>";
            $res .= "Description : " . $category->description . "<br>";
        }
        $response->getBody()->write($res);
        return $response;
    });

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