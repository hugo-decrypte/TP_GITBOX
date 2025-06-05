<?php

namespace gift\appli\webui\actions\abstract;

use Slim\Psr7\Request;
use Slim\Psr7\Response;

/**
 * Classe abstraite représentant une action de contrôleur dans l'application.
 *
 * Toutes les classes héritant de AbstractAction doivent implémenter la méthode __invoke(),
 * qui permet de rendre la classe "appelable" comme un middleware ou une route Slim.
 */

abstract class AbstractAction {
    abstract public function __invoke(Request $request, Response $response, array $args);
}