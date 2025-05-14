<?php

namespace gift\appli\Controllers;

use gift\appli\models\Theme;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class ThemesAction extends AbstractAction {
    public function __invoke(Request $request, Response $response, array $args) {
        $twig = Twig::fromRequest($request);
        return $twig->render($response, 'theme.html.twig', [
            'themes' => Theme::all()
        ]);
    }
}