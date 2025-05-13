<?php


use gift\appli\utils\Eloquent;
use Slim\Factory\AppFactory;

Eloquent::init(__DIR__.'/db.ini');
$app = AppFactory::create();
$app = (require_once __DIR__ . '/routes.php')($app);

return $app;