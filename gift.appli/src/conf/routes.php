<?php


use gift\appli\Controllers\CategorieIdAction;
use gift\appli\Controllers\CategoriesAction;
use gift\appli\Controllers\HomeAction;
use gift\appli\Controllers\PrestationAction;
use gift\appli\Controllers\PrestationParCategorieAction;

return function ($app) {
    $app->get('/categories', CategoriesAction::class)
        ->setName('categories');

    $app->get('/categories/{id}', CategorieIdAction::class)
        ->setName('categoryById');

    $app->get('/prestation', PrestationAction::class)
        ->setName('prestation');

    $app->get('/categories/{id}/prestations', PrestationParCategorieAction::class)
        ->setName('prestationsByCategory');

    $app->get('/', HomeAction::class)
        ->setName('homepage');

    return $app;
};