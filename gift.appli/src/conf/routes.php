<?php


use gift\appli\Controllers\CategorieIdAction;
use gift\appli\Controllers\CategoriesAction;
use gift\appli\models\Categorie;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use gift\appli\Controllers\PrestationAction;


return function ($app) {
    $app->get('/categories', new CategoriesAction());
    $app->get('/categories/{id}', new CategorieIdAction());

    $app->get('/prestation', new PrestationAction());
    return $app;
};