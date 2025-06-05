<?php

namespace gift\appli\application_core\application\use_cases\interfaces;

interface FormBuilderInterface {
    public function buildCreerBoxPersoForm(): array;
    public function buildCreerBoxModelForm() : array;
    public function buildSignInForm(): array;
    public function buildRegisterForm(): array;
}