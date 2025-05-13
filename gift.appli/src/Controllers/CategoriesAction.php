<?php

namespace gift\appli\Controllers;

use gift\appli\models\Categorie;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class CategoriesAction extends AbstractAction{

    public function __invoke(Request $request, Response $response, array $args) {
        $categories = Categorie::all();
        $first = true;
        foreach ($categories as $category) {
            if (!$first) {
                $response->getBody()->write(" - ");
            } else {
                $first = false;
            }
            $response->getBody()->write("<a href='/categories/{$category->id}'> {$category->libelle}</a>");
        }
        return $response;
    }
}