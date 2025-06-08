<?php

declare(strict_types=1);

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use gift\appli\infrastructure\Eloquent;
use gift\appli\models\Categorie;
use gift\appli\models\CoffretType;
use gift\appli\models\Prestation;
use Illuminate\Database\Eloquent\ModelNotFoundException;

try {
    Eloquent::init('../conf/db.ini');
} catch (Exception $e) {
}

// Récupérer toutes les catégories
$categories = Categorie::all();
echo "<h2> Test sur les catégories</h2>";
foreach ($categories as $categorie) {
    echo $categorie->id . ' - ' . $categorie->libelle . PHP_EOL . "<br>";
}
echo "<br>";

$prestations = Prestation::all();
// Afficher les prestations
echo "<h2> Test sur les présentations</h2>";
foreach ($prestations as $prestation) {
    echo "id: " . $prestation->id . "<br>";
    echo "Libellé: " . $prestation->libelle . "<br>";
    echo "Description: " . $prestation->description . "<br>";
    echo "Tarif: " . $prestation->tarif . "<br>";
    echo "Unité: " . $prestation->unite . "<br>";
    echo "----------------------------------------<br><br>";
}


// Vérifier si l'identifiant est fourni en paramètre
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Récupérer la prestation par son identifiant
        $prestation = Prestation::find($id);

        if (!$prestation) {
            throw new ModelNotFoundException('Prestation pas trouvée');
        }

        // Afficher les détails de la prestation
        echo "<h2>Détails de la prestation</h2>";
        echo "Libellé: " . $prestation->libelle . "<br>";
        echo "Description: " . $prestation->description . "<br>";
        echo "Tarif: " . $prestation->tarif . "<br>";
        echo "Unité: " . $prestation->unite . "<br>";
    } catch (ModelNotFoundException $e) {
        // Gérer le cas où aucune prestation n'est trouvée
        echo "<h2>Erreur</h2>";
        echo $e->getMessage();
    }
} else {
    echo "<h2>Erreur</h2>";
    echo "Aucun identifiant de prestation fourni.";
}

$coffretsType = CoffretType::all();
// Afficher les prestations
echo "<h2> Test sur les présentations</h2>";
foreach ($coffretsType as $coffretType) {
    echo "id: " . $coffretType->id . "<br>";
    echo "Libellé: " . $coffretType->libelle . "<br>";
    echo "Description: " . $coffretType->description . "<br>";
    echo "----------------------------------------<br><br>";
}


// Récupérer tous les types de coffrets
$coffretTypes = CoffretType::all();

// Parcourir chaque type de coffret et afficher ses prestations
foreach ($coffretTypes as $coffretType) {
    echo "<h2>Coffret Type: " . $coffretType->libelle . "</h2>";
    echo "<p>Description: " . $coffretType->description . "</p>";

    // Récupérer les prestations associées à ce type de coffret
    $prestations = $coffretType->prestations;

        echo "<h3>Prestations suggérées :</h3>";
        echo "<ul>";
        foreach ($prestations as $prestation) {
            echo "<li>";
            echo "<strong>Libellé:</strong> " . $prestation->libelle . "<br>";
            echo "<strong>Description:</strong> " . $prestation->description . "<br>";
            echo "<strong>Tarif:</strong> " . $prestation->tarif . "<br>";
            echo "<strong>Unité:</strong> " . $prestation->unite . "<br>";
            echo "</li>";
        }
        echo "</ul>";
}