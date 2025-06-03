<?php
namespace gift\appli\application_core\application\providers;
use Ramsey\Uuid\Uuid;

class CsrfTokenProvider {

    static function generate(){
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $token = Uuid::uuid4()->toString();
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
        <input type="hidden" name="csrf_token" value="{{ token }}">

        /////////////////////////////////////////////////////////////////////////////////////////////

        if (isset($_POST['csrf_token']) && CsrfTokenProvider::check($_POST['csrf_token'])) {
             // OK : requête authentique
        } else {
            // Erreur CSRF : bloquer la requête
        }
     */

}