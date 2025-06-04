<?php

use gift\appli\webui\actions\CreerBox\GetCreerBoxModeleAction;
use gift\appli\webui\actions\CreerBox\GetCreerBoxPersoAction;
use gift\appli\webui\actions\CreerBox\GetCreerCoffretAction;
use gift\appli\webui\actions\CreerBox\PostCreerBoxPersoAction;
use gift\appli\webui\actions\GetCategoriesAction;
use gift\appli\webui\actions\GetHomeAction;
use gift\appli\webui\actions\GetMyBoxAction;
use gift\appli\webui\actions\GetThemesAction;
use gift\appli\webui\actions\Prestations\GetPrestationsAction;
use gift\appli\webui\actions\Prestations\PostAjouterPrestationBoxAction;
use gift\appli\webui\actions\Register\GetCreerCompteAction;
use gift\appli\webui\actions\Register\PostCreerCompteAction;
use gift\appli\webui\actions\SignIn\GetSigninAction;
use gift\appli\webui\actions\SignIn\PostSigninAction;
use gift\appli\webui\actions\ValidateBoxAction;

return function ($app) {

    //-----------GET-----------//
    $app->get('/', GetHomeAction::class)
        ->setName('homepage');
    $app->get('/categories', GetCategoriesAction::class)
        ->setName('categories');
    $app->get('/themes', GetThemesAction::class)
        ->setName("themes");
    $app->get('/prestations', GetPrestationsAction::class)
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
    $app->post('/mes-box', ValidateBoxAction::class)
        ->setName("myBox");

    return $app;
};