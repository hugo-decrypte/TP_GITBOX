<?php


use DI\Container;
use gift\appli\application_core\application\providers\CsrfTokenProvider;
use gift\appli\application_core\application\providers\interfaces\CsrfTokenProviderInterface;
use gift\appli\application_core\application\useCases\CatalogueService;
use gift\appli\application_core\application\useCases\FormBuilder;
use gift\appli\application_core\application\useCases\interfaces\CatalogueServiceInterface;
use gift\appli\application_core\application\useCases\interfaces\FormBuilderInterface;
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
$container->set(FormBuilderInterface::class, \DI\autowire(FormBuilder::class));
$container->set(CsrfTokenProviderInterface::class, \DI\autowire(CsrfTokenProvider::class));

AppFactory::setContainer($container);
$app = AppFactory::create();

$app->add(TwigMiddleware::create($app, $twig));
$app = (require_once __DIR__ . '/routes.php')($app);

return $app;