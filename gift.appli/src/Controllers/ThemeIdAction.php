<?php

namespace gift\appli\Controllers;

use gift\appli\models\Categorie;
use gift\appli\models\Theme;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ThemeIdAction extends AbstractAction {

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function __invoke(Request $request, Response $response, array $args)
    {
        $theme = Theme::where('id','=',$args['id'])->first();
        $twig = Twig::fromRequest($request);
        if($theme == null) {
            return $twig->render($response, 'erreur404.html.twig');
        }

        $coffrets = $theme->coffrets;

        return $twig->render($response,'theme_by_id.html.twig', [
            'coffrets' => $coffrets,
            'themes' => Theme::all()
        ]);
    }
}