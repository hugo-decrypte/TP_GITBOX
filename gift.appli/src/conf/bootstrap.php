<?php


use DI\Container;
use gift\appli\application_core\application\use_cases\AuthnService;
use gift\appli\application_core\application\use_cases\CatalogueService;
use gift\appli\application_core\application\use_cases\FormBuilder;
use gift\appli\application_core\application\use_cases\interfaces\AuthnServiceInterface;
use gift\appli\application_core\application\use_cases\interfaces\CatalogueServiceInterface;
use gift\appli\application_core\application\use_cases\interfaces\FormBuilderInterface;
use gift\appli\infrastructure\Eloquent;
use gift\appli\webui\providers\CsrfTokenProvider;
use gift\appli\webui\providers\interfaces\AuthnProviderInterface;
use gift\appli\webui\providers\interfaces\CsrfTokenProviderInterface;
use gift\appli\webui\providers\SessionAuthnProvider;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Twig\Error\LoaderError;

session_start();

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
$container->set(AuthnProviderInterface::class, \DI\autowire(SessionAuthnProvider::class));
$container->set(AuthnServiceInterface::class, \DI\autowire(AuthnService::class));

AppFactory::setContainer($container);
$app = AppFactory::create();


$app->add(function ($request, $handler) use ($app, $twig) {
    $container = $app->getContainer();

    /** @var \gift\appli\webui\providers\interfaces\AuthnProviderInterface $authnProvider */
    $authnProvider = $container->get(AuthnProviderInterface::class);

    // Récupérer l'utilisateur à partir de l'email stocké en session
    $user = $authnProvider->getSignedInUser();

    // Injecter dans Twig
    $twig->getEnvironment()->addGlobal('user', $user);

    return $handler->handle($request);
});


$app->add(TwigMiddleware::create($app, $twig));
$app = (require_once __DIR__ . '/routes.php')($app);

return $app;