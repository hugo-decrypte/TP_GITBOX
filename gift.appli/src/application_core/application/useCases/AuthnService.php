<?php

namespace gift\appli\application_core\application\useCases;

use gift\appli\application_core\application\useCases\interfaces\AuthnServiceInterface;
use gift\appli\application_core\domain\entities\User;
use MongoDB\Driver\Exception\AuthenticationException;
use function Symfony\Component\Clock\now;

class AuthnService implements AuthnServiceInterface {
    public function register($id, $mdp): array
    {
        if(User::where('user_id','=', $id)->count() == 0) {
            $mdpHash = password_hash($mdp, PASSWORD_BCRYPT);
            $user = new User();
            $user->id = \Ramsey\Uuid\Uuid::uuid4()->toString();
            $user->user_id = $id;
            $user->password = $mdpHash;
            $user->save();
            return $user->toArray();
        } else {
            throw new AuthenticationException("Cet utilisateur existe déjà.");
        }
    }

    public function verifyCredentials($id, $mdp): bool
    {
        $user = User::where('user_id','=', $id)->first();
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