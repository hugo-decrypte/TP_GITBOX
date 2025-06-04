<?php

use gift\appli\webui\actions\CoffretsAction;
use gift\appli\webui\actions\CreerBox\GetCreerBoxModeleAction;
use gift\appli\webui\actions\CreerBox\GetCreerBoxPersoAction;
use gift\appli\webui\actions\CreerBox\GetCreerCoffretAction;
use gift\appli\webui\actions\CreerBox\PostCreerBoxPersoAction;
use gift\appli\webui\actions\GetCategoriesAction;
use gift\appli\webui\actions\GetHomeAction;
use gift\appli\webui\actions\GetMyBoxAction;
use gift\appli\webui\actions\GetPrestationsActions;
use gift\appli\webui\actions\GetThemesAction;
use gift\appli\webui\actions\SignIn\GetSigninAction;
use gift\appli\webui\actions\SignIn\PostSigninAction;

return function ($app) {

    //-----------GET-----------//
    $app->get('/', GetHomeAction::class)
        ->setName('homepage');
    $app->get('/categories', GetCategoriesAction::class)
        ->setName('categories');
    $app->get('/themes', GetThemesAction::class)
        ->setName("themes");
    $app->get('/prestations', GetPrestationsActions::class)
        ->setName('prestations');
    $app->get('/creerCoffret', GetCreerCoffretAction::class)
        ->setName('creerCoffret');
    $app->get('/mes-box', GetMyBoxAction::class)
        ->setName("myBox");
    $app->get('/CreerCoffret', GetCreerCoffretAction::class)
        ->setName('CreerCoffret');

    $app->get('/creer-box-perso', GetCreerBoxPersoAction::class)
        ->setName('creer_box_perso');

    $app->get('/creer-box-modele', GetCreerBoxModeleAction::class)
        ->setName('creer_box_modele');
    $app->get('/signin', GetSigninAction::class)
        ->setName('signin');

    //-----------POST-----------//
    $app->post('/creer-box-perso', PostCreerBoxPersoAction::class)
        ->setName('post_creer_box_perso');
    $app->post('/signin', PostSigninAction::class)
        ->setName('post_signin');
    return  $app;
};