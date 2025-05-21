<?php


use gift\appli\Controllers\CategorieIdAction;
use gift\appli\Controllers\CategoriesAction;
use gift\appli\Controllers\HomeAction;
use gift\appli\Controllers\PrestationAction;
use gift\appli\Controllers\PrestationParCategorieAction;
use gift\appli\Controllers\ThemesAction;

return function ($app) {
    $app->get('/categories', CategoriesAction::class)
        ->setName('categories.all');

    $app->get('/categories/{id}', CategorieIdAction::class)
        ->setName('categorie.parId');

    $app->get('/prestation', PrestationAction::class)
        ->setName('prestation.single');

    $app->get('/categories/{id}/prestations', PrestationParCategorieAction::class)
        ->setName('prestations.parCategorie');
    $app->get('/theme', ThemesAction::class);

    $app->get('/', HomeAction::class)
        ->setName('Home.page');

    return $app;
};