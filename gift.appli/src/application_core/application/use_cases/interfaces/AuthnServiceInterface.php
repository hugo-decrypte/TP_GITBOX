<?php

namespace gift\appli\application_core\application\use_cases\interfaces;

interface AuthnServiceInterface {
    public function register($email, $mdp);
    public function verifyCredentials($email, $mdp): bool;
}