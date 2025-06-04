<?php

namespace gift\appli\application_core\application\useCases;

use Faker\Core\Uuid;
use gift\appli\application_core\application\exceptions\DatabaseException;
use gift\appli\application_core\application\useCases\interfaces\CatalogueServiceInterface;
use gift\appli\application_core\domain\entities\Box;
use gift\appli\application_core\domain\entities\Categorie;
use gift\appli\application_core\domain\entities\CoffretType;
use gift\appli\application_core\domain\entities\Prestation;
use gift\appli\application_core\domain\entities\Theme;
use Illuminate\Support\Str;

class CatalogueService implements CatalogueServiceInterface {

    public function getCategories(): array {
        try {
            return Categorie::with("prestations")->get()->toArray();
        } catch (\Throwable $e) {
            throw new DatabaseException("Erreur lors de la récupération des catégories.");
        }
    }

    public function getPrestations(): array {
        try {
            return Prestation::all()->toArray();
        } catch (\Throwable $e) {
            throw new DatabaseException("Erreur lors de la récupération des prestations.");
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
            throw new DatabaseException("Erreur lors de la récupération des themes avec leurs coffrets.");
        }
    }

    public function getCoffretById(int $id): array {
        try {
            return CoffretType::where('id', $id)->first()->toArray();
        } catch (\Throwable $e) {
            throw new DatabaseException("Erreur lors de la récupération d'un coffret par son identidiant.");
        }
    }

    public function getBox(): array {
        try {
            return Box::with("prestations")->get()->toArray();
        } catch (\Throwable $e) {
            throw new DatabaseException("Erreur lors de la récupération des box.");
        }
    }

    public function creerBoxVide(string $createurId, string $libelle, string $description): array
    {
        try {
            $box = new Box();
            $box->id = \Ramsey\Uuid\Uuid::uuid4()->toString();
            $box->token = \Ramsey\Uuid\Uuid::uuid4()->toString();
            $box->libelle = $libelle;
            $box->description = $description;
            $box->montant = 0.00;
            $box->kdo = false;
            $box->message_kdo = 'Message par défaut pour la box vide';
            $box->statut = 0;
            $box->createur_id = $createurId;

            $box->save();

            return $box->toArray();
        } catch (\Exception $e) {
            throw new DatabaseException("Erreur lors de la création de la box vide: " . $e->getMessage());
        }
    }

    /**
     * Ajoute une prestation à une box.
     *
     * @param string $boxId L'ID de la box.
     * @param string $prestationId L'ID de la prestation.
     * @param int $quantite La quantité de la prestation.
     * @return array
     */
    public function addPrestationBox(string $boxId, string $prestationId, int $quantite = 1): void
    {
        // Trouver la box et la prestation
        $box = Box::find($boxId);
        $prestation = Prestation::find($prestationId);

        if ($box && $prestation) {
            // Attacher la prestation à la box avec la quantité
            $box->prestations()->attach($prestationId, ['quantite' => $quantite]);
        } else {
            throw new \RuntimeException("Box ou Prestation non trouvée.");
        }

    }

}