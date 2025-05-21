<?php
/**
 * File:  Eloquents.php
 * Creation Date: 27/12/2022
 * description: classe Eloquent, service de connexion à la base de données
 *
 * @author: canals
 */

namespace gift\appli\utils;

use Illuminate\Database\Capsule\Manager as DB ;

class Eloquent {

    /**
     * Initialise la connexion à la base de données en utilisant un fichier de configuration INI.
     * Cette méthode configure et démarre Eloquent ORM avec les paramètres définis dans le fichier.
     *
     * @param string $filename Chemin vers le fichier de configuration INI contenant les paramètres de connexion.
     *
     * @return void
     *
     * @throws \Exception Si le fichier de configuration est invalide ou inaccessible.
     */

    public static function init($filename): void {
        $db = new DB();
        $db->addConnection(parse_ini_file($filename));
        $db->setAsGlobal();
        $db->bootEloquent();
    }
}