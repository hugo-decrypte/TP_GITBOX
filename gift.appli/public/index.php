<?php

use gift\appli\utils\Eloquent;
use Slim\Factory\AppFactory;

require __DIR__ . '/../src/vendor/autoload.php';

Eloquent::init('../src/conf/db.ini');
$app = AppFactory::create();
$app = (require_once __DIR__ . '/../src/conf/routes.php')($app);


//$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
//    $name = $args['name'];
//    $response->getBody()->write("Hello, $name");
//    return $response;
//});

$app->run();