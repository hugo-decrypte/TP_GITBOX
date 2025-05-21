<?php


use gift\appli\Controllers\CategorieIdAction;
use gift\appli\Controllers\CategoriesAction;
use gift\appli\Controllers\HomeAction;
use gift\appli\Controllers\PrestationAction;
use gift\appli\Controllers\PrestationParCategorieAction;
use gift\appli\Controllers\ThemesAction;


/**
 * Déclaration des routes de l'application Slim.
 *
 * Ce fichier retourne une fonction anonyme qui reçoit l'instance de l'application
 * et y enregistre toutes les routes nécessaires.
 *
 * @param \Slim\App $app L'application Slim sur laquelle on enregistre les routes
 *
 * @return void
 */

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