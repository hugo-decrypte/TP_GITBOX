<?php

namespace gift\appli\webui\providers\interfaces;

interface AuthnProviderInterface {
    public function getSignedInUser(): array;
    public function signin($email, $mdp);
}