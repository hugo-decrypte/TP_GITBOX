<?php

namespace gift\appli\application_core\application\use_cases;

use gift\appli\application_core\application\use_cases\interfaces\AuthnServiceInterface;
use gift\appli\application_core\domain\entities\User;
use MongoDB\Driver\Exception\AuthenticationException;

class AuthnService implements AuthnServiceInterface {
    public function register($email, $mdp) : array
    {
        if(User::where('id','=', $email)->count() == 0) {
            $mdpHash = password_hash($mdp, PASSWORD_BCRYPT);
            $user = new User();
            $user->id = \Ramsey\Uuid\Uuid::uuid4()->toString();
            $user->user_id = $email;
            $user->password = $mdpHash;
            $user->save();
            return $user->toArray();
        } else {
            throw new AuthenticationException("Cet utilisateur existe déjà.");
        }
    }

    public function verifyCredentials($email, $mdp): bool {
        $user = User::where('user_id','=', $email)->first();
        if($user == null) {
            throw new AuthenticationException("TEMPORAIRE A SUPPRIMER. Utilisateur inexistant.");
            //throw new AuthenticationException("Erreur lors de l'authentification.");
        } else {
            if (!password_verify($mdp,$user->password)) {
                throw new AuthenticationException("pas meme");
                //throw new AuthenticationException("Erreur lors de l'authentification.");
            } else {
                return true;
            }
        }
    }
}