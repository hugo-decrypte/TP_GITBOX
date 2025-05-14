<?php

namespace gift\appli\Controllers;

use gift\appli\Controllers\AbstractAction;
use gift\appli\models\Categorie;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class HomeAction extends AbstractAction {

    public function __invoke(Request $request, Response $response, array $args)
    {
        $twig = Twig::fromRequest($request);
        return $twig->render($response,'home.html.twig');
    }
}