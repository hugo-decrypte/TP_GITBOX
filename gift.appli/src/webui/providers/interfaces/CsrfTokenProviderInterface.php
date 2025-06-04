<?php

namespace gift\appli\webui\providers\interfaces;

interface CsrfTokenProviderInterface {
    static function generate() : string;
    static function check($token) : bool;
}