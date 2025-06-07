<?php

namespace gift\appli\application_core\application\use_cases;

use gift\appli\application_core\application\use_cases\interfaces\CatalogueServiceInterface;
use gift\appli\application_core\application\use_cases\interfaces\FormBuilderInterface;

class FormBuilder implements FormBuilderInterface {

    public function __construct(private CatalogueServiceInterface $catalogueService){}

    public function buildCreerBoxPersoForm(): array {
        return [
            'actionRoute' => 'post_creer_box_perso',
            'submit_button' => 'Créer la Box',
            'links' => [],
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
        $arrayCoffret = $this->catalogueService->getCoffretType();
        $options = [];
        foreach($arrayCoffret as $coffret){
            $options[] = [
                "label" => $coffret['libelle'],
                "value" => $coffret['id']
            ];
        }

        return [
            'actionRoute' => 'post_creer_box_modele',
            'submit_button' => "Créer la Box",
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
            'selects' => [
                [
                    'name' => 'selector',
                    'label' => 'Séléctionnez le coffret type',
                    'options' => $options
                ]
            ]
        ];
    }

    public function buildSignInForm(): array {
        return [
            'actionRoute' => 'post_signin',
            'submit_button' => "Se connecter",
            'links' => [
                [
                    "label" => "Pas encore de compte ? Créez en un dès maintenant !",
                    "route" => "creer_compte"
                ]
            ],
            'inputs' => [
                [
                    'name' => 'email',
                    'label' => 'Email',
                    'type' => 'text',
                    'placeholder' => 'exemple@mail.com',
                    'required' => true
                ],
                [
                    'name' => 'password',
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
            'actionRoute' => 'post_creer_compte',
            'submit_button' => "S'enregistrer",
            'links' => [
                [
                    "label" => "Déjà un compte ? Connectez vous dès maintenant !",
                    "route" => "signin"
                ]
            ],
            'inputs' => [
                [
                    'name' => 'email',
                    'label' => 'Email',
                    'type' => 'text',
                    'placeholder' => 'exemple@mail.com',
                    'required' => true
                ],
                [
                    'name' => 'password',
                    'label' => 'Mot de passe',
                    'type' => 'password',
                    'placeholder' => 'Renseigner votre mot de passe',
                    "required" => true,
                ],
                [
                    'name' => 'repeat_password',
                    'label' => 'Mot de passe',
                    'type' => 'password',
                    'placeholder' => 'Renseigner votre mot de passe à nouveau',
                    "required" => true,
                ]
            ],
            'selects' => []
        ];
    }
}