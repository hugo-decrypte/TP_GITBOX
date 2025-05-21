<?php


use gift\appli\Controllers\CategorieIdAction;
use gift\appli\Controllers\CategoriesAction;
use gift\appli\Controllers\HomeAction;
use gift\appli\Controllers\PrestationAction;
use gift\appli\Controllers\PrestationParCategorieAction;
use gift\appli\Controllers\ThemeIdAction;
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
        ->setName('categories');
    $app->get('/categories/{id}', CategorieIdAction::class)
        ->setName('categoryById');
    $app->get('/prestation', PrestationAction::class)
        ->setName('prestation');
    $app->get('/categories/{id}/prestations', PrestationParCategorieAction::class)
        ->setName('prestationsByCategory');
    $app->get('/themes', ThemesAction::class)
        ->setName("themes");
    $app->get('/theme/{id}', ThemeIdAction::class);

    $app->get('/', HomeAction::class)
        ->setName('homepage');

    return $app;
};