<?php

use gift\appli\utils\Eloquent;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

/**
 * Initialise la connexion à la base de données via Eloquent.
 * Le fichier 'db.ini' contient les paramètres de configuration.
 */
Eloquent::init(__DIR__ . '/db.ini');

/**
 * Crée une instance de Twig pour le rendu des vues.
 * @var \Slim\Views\Twig $twig Instance de Twig avec le répertoire des vues.
 */
$twig = Twig::create(
    __DIR__ . '/../views',
    ['cache' => 'path/to/cache-dir',
        'auto_reload' => true]
);

/**
 * Crée une instance de l'application Slim.
 * @var \Slim\App $app Application Slim.
 */
$app = AppFactory::create();

/**
 * Ajoute le middleware Twig à l'application Slim.
 * Permet de rendre les vues Twig dans les routes.
 */
$app->add(TwigMiddleware::create($app, $twig));

/**
 * Inclut et exécute le fichier de définition des routes.
 *
 * @var \Slim\App $app Application mise à jour avec les routes définies.
 */
$app = (require_once __DIR__ . '/routes.php');
