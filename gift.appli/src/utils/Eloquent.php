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

class Eloquent
{


    public static function init($filename): void
    {


        $db = new DB();
        $db->addConnection(parse_ini_file($filename));
        $db->setAsGlobal();
        $db->bootEloquent();

    }


}