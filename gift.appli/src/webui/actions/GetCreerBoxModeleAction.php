<?php

namespace gift\appli\webui\actions;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class GetCreerBoxModeleAction extends AbstractAction
{
    public function __invoke(Request $request, Response $response, array $args)
    {
        $twig = Twig::fromRequest($request);
        return $twig->render($response, 'formCreerCoffretAvecModel.html.twig');
    }
}