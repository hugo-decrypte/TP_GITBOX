<?php

namespace gift\appli\application_core\application\useCases\interfaces;

interface AuthnServiceInterface {
    public function register($id, $mdp);
    public function verifyCredentials($id, $mdp): bool;
}