<?php

namespace gift\appli\application_core\application\useCases\interfaces;

use gift\appli\application_core\domain\entities\User;

interface AuthnProviderInterface {
    public function getSignedInUser(): array;
    public function signin($id, $mdp): bool;
}