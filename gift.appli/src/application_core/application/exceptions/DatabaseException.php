<?php

namespace gift\appli\application_core\application\exceptions;

class DatabaseException extends \RuntimeException {

     public String $string;

    public function __construct(string $string)
    {
        parent::__construct($string);
    }
}