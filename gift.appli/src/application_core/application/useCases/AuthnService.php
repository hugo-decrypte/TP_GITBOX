<?php

namespace gift\appli\application_core\application\useCases;

use gift\appli\application_core\application\useCases\interfaces\AuthnServiceInterface;
use gift\appli\application_core\domain\entities\User;
use MongoDB\Driver\Exception\AuthenticationException;

class AuthnService implements AuthnServiceInterface {
    public function register($id, $mdp)
    {
        if(($this->verifyCredentials($id, $mdp))&&(User::where('id','=', $id)->count() == 0)) {
            $mdpHash = password_hash($mdp);
            $user = new User();
            $user->id = $id;
            $user->mdp = $mdpHash;
            $user->save();
        } else {
            throw new AuthenticationException("Erreur lors de l'enregistrement de l'utilisateur.");
        }
    }

    public function verifyCredentials($id, $mdp): bool
    {
        $user = User::where('id','=', $id)->first();
        if($user == null) {
            throw new AuthenticationException("Erreur lors de l'authentification.");
        } else {
            $mdpHash = password_hash($mdp);
            if ($mdpHash != $user->mdp) {
                throw new AuthenticationException("Erreur lors de l'authentification.");
            } else {
                return true;
            }
        }
    }
}