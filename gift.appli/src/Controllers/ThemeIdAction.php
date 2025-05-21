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
        $coffrets = Theme::whereHas('coffrets',function($query) {
                                                    $query->select('libelle','description');
                                                })
                            ->where('id','=',$args['id'])
                            ->get();

        if($theme == null) {
            return new Response(404);
        }

        $twig = Twig::fromRequest($request);
        return $twig->render($response,'theme_by_id.html.twig', [
            'coffrets' => $coffrets,
            'theme' => $theme
        ]);
    }
}