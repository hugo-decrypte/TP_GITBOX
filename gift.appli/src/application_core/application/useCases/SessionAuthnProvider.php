<?php

namespace gift\appli\application_core\application\useCases;

use gift\appli\application_core\application\useCases\interfaces\AuthnProviderInterface;
use gift\appli\application_core\domain\entities\User;
use MongoDB\Driver\Exception\AuthenticationException;

class SessionAuthnProvider implements AuthnProviderInterface {
    public function getSignedInUser(): array
    {
        if (isset($_SESSION["email"])) {
            $id = $_SESSION["email"];
            return User::where('id', '=', $id)->toArray();
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