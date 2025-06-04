<?php
use gift\appli\webui\actions\CategoriesAction;
use gift\appli\webui\actions\CoffretsAction;
use gift\appli\webui\actions\GetCreerBoxModeleAction;
use gift\appli\webui\actions\GetCreerBoxPersoAction;
use gift\appli\webui\actions\CreerCoffretAction;
use gift\appli\webui\actions\GetSigninAction;
use gift\appli\webui\actions\HomeAction;
use gift\appli\webui\actions\MyBoxAction;
use gift\appli\webui\actions\PostCreerBoxPersoAction;
use gift\appli\webui\actions\PostSigninAction;
use gift\appli\webui\actions\Prestations;
use gift\appli\webui\actions\ThemesAction;

return function ($app) {

    //-----------GET-----------//
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
    $app->get('/CreerCoffret', CreerCoffretAction::class)
        ->setName('CreerCoffret');

    $app->get('/creer-box-perso', GetCreerBoxPersoAction::class)
        ->setName('creer_box_perso');

    $app->get('/creer-box-modele', GetCreerBoxModeleAction::class)
        ->setName('creer_box_modele');
    $app->get('/signin', GetSigninAction::class)
        ->setName('signin');
    $app->get('/creer-compte', GetCreerCompteAction::class)
        ->setName('creer_compte');

    //-----------POST-----------//
    $app->post('/creer-box-perso', PostCreerBoxPersoAction::class)
        ->setName('post_creer_box_perso');
    $app->post('/signin', PostSigninAction::class)
        ->setName('post_signin');
    $app->post('/prestations', PostAjouterPrestationBoxAction::class)
        ->setName('prestations');
    $app->post('/creer-compte', PostCreerCompteAction::class)
        ->setName('post_creer_compte');

    return $app;
};