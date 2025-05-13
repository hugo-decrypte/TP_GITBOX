<?php


use gift\appli\models\Categorie;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


return function ($app) {
    $app->get('/categories', function (Request $request, Response $response, array $args) {
        $categories = Categorie::all();
        $res = "";
        foreach ($categories as $category) {
            $res .= $category->libelle . "<br>";
        }
        $response->getBody()->write($res);
        return $response;
    });
    return $app;
};