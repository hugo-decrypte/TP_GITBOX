<?php


use gift\appli\Controllers\CategoriesAction;
use gift\appli\Controllers\CoffretsAction;
use gift\appli\Controllers\HomeAction;
use gift\appli\Controllers\Prestations;
use gift\appli\Controllers\ThemesAction;


return function ($app) {
    $app->get('/', HomeAction::class)
        ->setName('homepage');
    $app->get('/categories', CategoriesAction::class)
        ->setName('categories');
    $app->get('/themes', ThemesAction::class)
        ->setName("themes");
    $app->get('/coffrets', CoffretsAction::class)
        ->setName('coffrets');
    $app->get('/prestations', Prestations::class)
        ->setName('prestations');
    $app->get('/creerCoffret', Prestations::class)
        ->setName('creerCoffret');


    return $app;
};