<?php


use gift\appli\models\Categorie;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use gift\appli\Controllers\PrestationAction;


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

    $app->get('/prestation', new PrestationAction());
    return $app;
};