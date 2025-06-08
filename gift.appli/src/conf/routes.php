<?php

use gift\appli\api\BoxApi;
use gift\appli\api\CategoryApi;
use gift\appli\webui\actions\creer_box\GetCreerBoxModeleAction;
use gift\appli\webui\actions\creer_box\GetCreerBoxPersoAction;
use gift\appli\webui\actions\creer_box\GetCreerCoffretAction;
use gift\appli\webui\actions\creer_box\PostCreerBoxPersoAction;
use gift\appli\webui\actions\creer_box\PostCreerBoxModeleAction;
use gift\appli\webui\actions\GetCategoriesAction;
use gift\appli\webui\actions\GetHomeAction;
use gift\appli\webui\actions\GetMyBoxAction;
use gift\appli\webui\actions\GetThemesAction;
use gift\appli\webui\actions\prestations\GetPrestationsAction;
use gift\appli\webui\actions\prestations\PostAjouterPrestationBoxAction;
use gift\appli\webui\actions\register\GetCreerCompteAction;
use gift\appli\webui\actions\register\PostCreerCompteAction;
use gift\appli\webui\actions\sign_in\GetSigninAction;
use gift\appli\webui\actions\sign_in\PostSigninAction;
use gift\appli\webui\actions\sign_in\GetSignOutAction;
use gift\appli\webui\actions\ValidateBoxAction;

return function ($app) {

    //-----------GET-----------//
    $app->get('/', GetHomeAction::class)
        ->setName('homepage');
    $app->get('/categories', GetCategoriesAction::class)
        ->setName('categories');
    $app->get('/themes', GetThemesAction::class)
        ->setName("themes");
    $app->get('/prestations', GetPrestationsAction::class);
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
    $app->get('/signout', GetSignOutAction::class)
        ->setName('signout');

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
    $app->post('/creer-box-modele', PostCreerBoxModeleAction::class)
        ->setName('post_creer_box_modele');

    //-----------API-----------//
    $app->get('/api/categories', CategoryApi::class)
        ->setName('api_categories');
    $app->get('/api/box/{id}', BoxApi::class)
        ->setName('api_categories');
    return $app;
};