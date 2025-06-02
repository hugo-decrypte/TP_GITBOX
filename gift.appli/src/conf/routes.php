<?php


use gift\appli\webui\actions\CategoriesAction;
use gift\appli\webui\actions\CoffretsAction;
use gift\appli\webui\actions\HomeAction;
use gift\appli\webui\actions\MyBoxAction;
use gift\appli\webui\actions\Prestations;
use gift\appli\webui\actions\ThemesAction;
use gift\appli\webui\actions\CreerCoffretAction;

return function ($app) {
    $app->get('/', HomeAction::class)
        ->setName('homepage');
    $app->get('/categories', CategoriesAction::class)
        ->setName('categories');
    $app->get('/themes', ThemesAction::class)
        ->setName("themes");
    $app->get('/prestations', Prestations::class)
        ->setName('prestations');
    $app->get('/creerCoffret', CreerCoffretAction::class)
        ->setName('creerCoffret');
    $app->get('/mes-box', MyBoxAction::class)
        ->setName("myBox");
    return $app;
};