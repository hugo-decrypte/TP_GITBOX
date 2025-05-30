<?php


use DI\Container;
use gift\appli\application_core\application\useCases\CatalogueService;
use gift\appli\application_core\application\useCases\interfaces\CatalogueServiceInterface;
use gift\appli\infrastructure\Eloquent;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Twig\Error\LoaderError;

try {
    Eloquent::init(__DIR__ . '/db.ini');
} catch (Exception $e) {
}

try {
    $twig = Twig::create(__DIR__ . '/../webui/views/',
        ['cache' => 'path/to/cache-dir',
            'auto_reload' => true]);
} catch (LoaderError $e) {
}

$container = new Container();
$container->set(CatalogueServiceInterface::class, \DI\autowire(CatalogueService::class));

AppFactory::setContainer($container);
$app = AppFactory::create();

$app->add(TwigMiddleware::create($app, $twig));
$app = (require_once __DIR__ . '/routes.php')($app);

return $app;