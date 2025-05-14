<?php


use gift\appli\Controllers\CategorieIdAction;
use gift\appli\Controllers\CategoriesAction;
use gift\appli\Controllers\HomeAction;
use gift\appli\Controllers\PrestationAction;


return function ($app) {
    $app->get('/categories', CategoriesAction::class);
    $app->get('/categories/{id}', CategorieIdAction::class);
    $app->get('/prestation', PrestationAction::class);
    $app->get('/categories/{id}/prestations', \gift\appli\Controllers\PrestationParCategorieAction::class)
        ->setName('prestations.parCategorie');

    $app->get('/', HomeAction::class);
    return $app;
};