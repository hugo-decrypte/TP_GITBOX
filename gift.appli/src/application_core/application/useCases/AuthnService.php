<?php

namespace gift\appli\application_core\application\useCases;

use gift\appli\application_core\application\useCases\interfaces\AuthnServiceInterface;
use gift\appli\application_core\domain\entities\User;
use MongoDB\Driver\Exception\AuthenticationException;

class AuthnService implements AuthnServiceInterface {
    public function register($id, $mdp)
    {
        if($this->verifyCredentials($id, $mdp)) {
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
        if(User::where('id','=', $id)->count() == 0) {
            //l'utilisater n'existe pas
            return true;
        } else {
            //l'utilisateur existe
            return false;
        }
    }
}