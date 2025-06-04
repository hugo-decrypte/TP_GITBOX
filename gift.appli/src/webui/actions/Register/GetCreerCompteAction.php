<?php

namespace gift\appli\webui\actions\Register;

use gift\appli\webui\actions\Abstract\AbstractAction;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class GetCreerCompteAction extends AbstractAction {


    public function __invoke(Request $request, Response $response, array $args)
    {
        $twig = Twig::fromRequest($request);
        return $twig->render($response, 'signin/creer_compte.html.twig');
    }
}