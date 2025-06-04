<?php

namespace gift\appli\application_core\application\providers\interfaces;

interface AuthnProviderInterface {
    public function getSignedInUser(): array;
    public function signin($id, $mdp): bool;
}