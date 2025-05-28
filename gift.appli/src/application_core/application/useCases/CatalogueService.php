<?php

namespace gift\appli\application_core\application\useCases;

use gift\appli\application_core\domain\entities\Categorie;
use gift\appli\application_core\domain\entities\CoffretType;
use gift\appli\application_core\domain\entities\Prestation;
use gift\appli\application_core\domain\entities\Theme;

class CatalogueService implements CatalogueServiceInterface {

    public function getCategories(): array {
        return Categorie::all()->toArray();
    }

    public function getCategorieById(int $id): array {
        return Categorie::where('id', $id)->first()->toArray();
    }

    public function getPrestationById(string $id): array {
        return Prestation::where('id', $id)->first()->toArray();
    }

    public function getPrestationsbyCategorie(int $categ_id): array {
        return Prestation::where("cat_id", $categ_id)->get()->toArray();
    }

    public function getThemesCoffrets(): array {
        return Theme::with('coffrets')->get()->toArray();
    }

    public function getCoffretById(int $id): array {
        return CoffretType::where('id', $id)->first()->toArray();
    }
}