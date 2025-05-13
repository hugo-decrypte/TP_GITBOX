<?php


use gift\appli\models\Categorie;
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
            $response->getBody()->write("<a href='/categorie/{$category->id}'> {$category->libelle}</a>");
        }
        return $response;
    });
    return $app;
};