<?php

namespace gift\appli\application_core\application\use_cases\interfaces;

interface CatalogueServiceInterface {
    public function getCategories(): array;
    public function getCategorieById(int $id): array;
    public function getPrestationById(string $id): array;
    public function getPrestationsbyCategorie(int $categ_id):array;
    public function getThemesCoffrets(): array;
    public function getCoffretById(int $id): array;
    public function getPrestations(): array;
    public function creerBoxVide(string $createurId, string $libelle, string $description) : array;

    public function getBox(): array;

    public function addPrestationBox(string $idBox, string $prestationId, int $quantite) : void;

    public function validateBox(String $id);
}