<?php


use gift\appli\utils\Eloquent;
use Slim\Factory\AppFactory;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

Eloquent::init(__DIR__.'/db.ini');

$loader = new FilesystemLoader(__DIR__.'/../views');
$twig = new Environment($loader, ['debug' => true]);

$app = AppFactory::create();
$app = (require_once __DIR__ . '/routes.php')($app, $twig);

return $app;