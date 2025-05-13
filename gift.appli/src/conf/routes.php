<?php


use gift\appli\Controllers\CategorieIdAction;
use gift\appli\Controllers\CategoriesAction;
use gift\appli\Controllers\PrestationAction;


return function ($app) {
    $app->get('/categories', new CategoriesAction());
    $app->get('/categories/{id}', new CategorieIdAction());
return function ($app, $twig) {
    $app->get('/categories', new CategoriesAction($twig));
    $app->get('/prestation', new PrestationAction());
    return $app;
};