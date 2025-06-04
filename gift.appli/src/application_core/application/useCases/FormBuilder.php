<?php

namespace gift\appli\application_core\application\useCases;

use gift\appli\application_core\application\useCases\interfaces\FormBuilderInterface;

class FormBuilder implements FormBuilderInterface {
    public function buildCreerBoxPersoForm(): array {
        return [
            'actionRoute' => 'post_creer_box_perso',
            'submit_button' => 'Créer la Box',
            'inputs' => [
                [
                    'name' => 'libelle',
                    'label' => 'Libellé de la Box',
                    'type' => 'text',
                    'placeholder' => 'Libellé de la box',
                    'required' => true
                ],
                [
                    'name' => 'description',
                    'label' => 'Description',
                    'type' => 'textarea',
                    'placeholder' => 'Description de la box',
                    "required" => true,
                ]
            ],
            'selects' => []
        ];
    }

    public function buildCreerBoxModelForm() : array{
        return [
            'actionRoute' => 'post_creer_box_model',
            'submit_button' => "",
            'inputs' => [],
            'selects' => []
        ];
    }

    public function buildSignInForm(): array {
        return [
            'actionRoute' => 'post_signin',
            'submit_button' => "Se connecter",
            'inputs' => [
                [
                    'name' => 'email',
                    'label' => 'Email',
                    'type' => 'text',
                    'placeholder' => 'exemple@mail.com',
                    'required' => true
                ],
                [
                    'name' => 'Mot de passe',
                    'label' => 'Mot de passe',
                    'type' => 'password',
                    'placeholder' => 'Renseigner votre mot de passe',
                    "required" => true,
                ]
            ],
            'selects' => []
        ];
    }

    public function buildRegisterForm(): array {
        return [
            'actionRoute' => 'post_register',
            'submit_button' => "",
            'inputs' => [],
            'selects' => []
        ];
    }
}