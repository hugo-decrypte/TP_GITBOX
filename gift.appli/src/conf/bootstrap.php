<?php


use gift\appli\utils\Eloquent;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

try {
    Eloquent::init(__DIR__ . '/db.ini');
} catch (Exception $e) {
}

try {
    $twig = Twig::create(__DIR__ . '/../views',
        ['cache' => 'path/to/cache-dir',
            'auto_reload' => true]);
} catch (\Twig\Error\LoaderError $e) {
}


$app = AppFactory::create();

$app->add(TwigMiddleware::create($app, $twig));
$app = (require_once __DIR__ . '/routes.php')($app);

return $app;