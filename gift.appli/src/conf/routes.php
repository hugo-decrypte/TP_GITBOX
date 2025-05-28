<?php


use gift\appli\webui\actions\CategoriesAction;
use gift\appli\webui\actions\CoffretsAction;
use gift\appli\webui\actions\HomeAction;
use gift\appli\webui\actions\Prestations;
use gift\appli\webui\actions\ThemesAction;

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