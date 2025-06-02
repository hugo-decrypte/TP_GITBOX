<?php

namespace gift\appli\application_core\application\useCases;

use gift\appli\application_core\application\exceptions\DatabaseException;
use gift\appli\application_core\application\useCases\interfaces\CatalogueServiceInterface;
use gift\appli\application_core\domain\entities\Categorie;
use gift\appli\application_core\domain\entities\CoffretType;
use gift\appli\application_core\domain\entities\Prestation;
use gift\appli\application_core\domain\entities\Theme;

class CatalogueService implements CatalogueServiceInterface {

    public function getCategories(): array {
        try {
            return Categorie::all()->toArray();
        } catch (\Throwable $e) {
            throw new DatabaseException("Erreur lors de la récupération de la catégorie.");
        }
    }

    public function getCategorieById(int $id): array {
        try {
            return Categorie::where('id', $id)->first()->toArray();
        } catch (\Throwable $e) {
            throw new DatabaseException("Erreur lors de la récupération de la catégorie par son identifiant.");
        }

    }

    public function getPrestationById(string $id): array {
        try {
            return Prestation::where('id', $id)->first()->toArray();
        } catch (\Throwable $e) {
            throw new DatabaseException("Erreur lors de la récupération de la prestation par son identifiant.");
        }
    }

    public function getPrestationsbyCategorie(int $categ_id): array {
        try {
            return Prestation::where("cat_id", $categ_id)->get()->toArray();
        } catch (\Throwable $e) {
            throw new DatabaseException("Erreur lors de la récupération des prestations par sa catégorie.");
        }
    }

    public function getThemesCoffrets(): array {
        try {
            return Theme::with('coffrets.prestations')->get()->toArray();
        } catch (\Throwable $e) {
            throw new DatabaseException("Erreur lors de la récupération des themes de coffrets.");
        }
    }

    public function getCoffretById(int $id): array {
        try {
            return CoffretType::where('id', $id)->first()->toArray();
        } catch (\Throwable $e) {
            throw new DatabaseException("Erreur lors de la récupération d'un coffret par son identidiant.");
        }
    }
}