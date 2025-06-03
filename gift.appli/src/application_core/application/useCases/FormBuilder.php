<?php

namespace gift\appli\application_core\application\useCases;

use gift\appli\application_core\application\useCases\interfaces\FormBuilderInterface;

class FormBuilder implements interfaces\FormBuilderInterface {
    public function buildCreerBoxPersoForm(): array {
        return [
            'actionRoute' => 'post_creer_box_perso',
            'submit_button' => 'Créer la Box',
            'inputs' => [
                [
                    'name' => 'libelle',
                    'label' => 'Libellé de la Box',
                    'type' => 'text',
                    'placeholder' => 'Libellé de la box'
                ],
                [
                    'name' => 'description',
                    'label' => 'Description',
                    'type' => 'textarea',
                    'placeholder' => 'Description de la box'
                ]
            ],
            'selects' => []
        ];
    }
}