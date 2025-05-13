<?php

namespace gift\appli\Controllers;

use gift\appli\Controllers\AbstractAction;
use gift\appli\models\Categorie;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class CategorieIdAction extends AbstractAction {

    private $twig;
    public function __construct($twig) {
        $this->twig = $twig;
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        $categories = Categorie::all();
        $category = Categorie::where('id','=',$args['id'])->first();

        if($category == null) {
            return new Response(404);
        }

        $html = $this->twig->render('category_by_id.html.twig', ['categories' => $categories,'category' => $category]);
        $response->getBody()->write($html);
        return $response;
    }
}