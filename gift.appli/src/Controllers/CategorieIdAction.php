<?php

namespace gift\appli\Controllers;

use gift\appli\Controllers\AbstractAction;
use gift\appli\models\Categorie;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class CategorieIdAction extends AbstractAction {

    public function __invoke(Request $request, Response $response, array $args)
    {
        $categories = Categorie::all()->where('id','=',$args['id']);
        $res = "";
        foreach ($categories as $category) {
            $res .= $category->libelle . "<br>";
            $res .= "Description : " . $category->description . "<br>";
        }
        $response->getBody()->write($res);
        return $response;
    }
}