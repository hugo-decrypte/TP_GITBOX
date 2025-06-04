<?php

namespace gift\appli\application_core\application\useCases\interfaces;

interface AuthnServiceInterface {
    public function register($email, $mdp);
    public function verifyCredentials($email, $mdp): bool;
}