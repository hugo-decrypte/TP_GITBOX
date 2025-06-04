<?php
namespace gift\appli\webui\providers;
use gift\appli\webui\providers\interfaces\CsrfTokenProviderInterface;
use Ramsey\Uuid\Uuid;

class CsrfTokenProvider implements CsrfTokenProviderInterface{

    static function generate() : string{
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $token = Uuid::uuid4()->toString();
        $_SESSION['csrf_token'] = $token;

        return $token;
    }

    static function check($token) : bool{
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