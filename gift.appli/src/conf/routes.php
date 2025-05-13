<?php


use gift\appli\Controllers\CategorieIdAction;
use gift\appli\Controllers\CategoriesAction;
use gift\appli\Controllers\PrestationAction;


return function ($app, $twig) {
    $app->get('/categories', new CategoriesAction($twig));
    $app->get('/categories/{id}', new CategorieIdAction($twig));
    $app->get('/prestation', new PrestationAction());
    return $app;
};