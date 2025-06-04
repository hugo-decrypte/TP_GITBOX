<?php

namespace gift\appli\application_core\application\providers;

use gift\appli\application_core\application\providers\interfaces\AuthnProviderInterface;
use gift\appli\application_core\application\useCases\AuthnService;
use gift\appli\application_core\domain\entities\User;

class SessionAuthnProvider implements AuthnProviderInterface {
    public function getSignedInUser(): array
    {
        if (isset($_SESSION["email"])) {
            $id = $_SESSION["email"];
            return User::where('user_id', '=', $id)->toArray();
        } else {
            return [];
        }
    }

    public function signin($id,$mdp): bool
    {
        $authnService = new AuthnService();
        return $authnService ->verifyCredentials($id, $mdp);
    }
}