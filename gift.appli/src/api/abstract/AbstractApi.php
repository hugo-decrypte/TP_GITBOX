<?php

namespace gift\appli\api\abstract;

use Slim\Psr7\Request;
use Slim\Psr7\Response;

abstract class AbstractApi {
    abstract public function __invoke(Request $request, Response $response, array $args);
}