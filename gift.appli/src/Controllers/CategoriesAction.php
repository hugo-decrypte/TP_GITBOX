<?php

namespace gift\appli\Controllers;

use gift\appli\models\Categorie;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class CategoriesAction extends AbstractAction{
    private $twig;
    public function __construct($twig) {
        $this->twig = $twig;
    }

    public function __invoke(Request $request, Response $response, array $args) {
        $html = $this->twig->render('categories.html.twig', ['categories' => Categorie::all()]);
        $response->getBody()->write($html);
        return $response;
    }
}