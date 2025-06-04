<?php

namespace gift\appli\application_core\application\providers\interfaces;

interface CsrfTokenProviderInterface {
    static function generate() : string;
    static function check($token) : bool;
}