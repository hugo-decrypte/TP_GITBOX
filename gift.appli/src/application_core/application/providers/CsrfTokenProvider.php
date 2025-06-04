<?php

namespace gift\appli\application_core\application\useCases;

class CsrfTokenProvider {

    static function generate(){
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $length = 32;
        $stringSpace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $pieces = [];
        $max = mb_strlen($stringSpace, '8bit') - 1;
        for ($i = 0; $i < $length; ++ $i) {
            $pieces[] = $stringSpace[random_int(0, $max)];
        }
        $token = implode('', $pieces);
        $_SESSION['csrf_token'] = $token;
        return $token;
    }

    static function check($token){
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }

    /*
        <input type="hidden" name="csrf_token" value="{{resultat de la fonction generate de CsrfTokenProvider}}">

        /////////////////////////////////////////////////////////////////////////////////////////////

        if (isset($_POST['csrf_token']) && CsrfTokenProvider::check($_POST['csrf_token'])) {
             // OK : requête authentique
        } else {
            // Erreur CSRF : bloquer la requête
        }
     */

}