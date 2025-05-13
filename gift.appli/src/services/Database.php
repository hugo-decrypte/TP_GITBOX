<?php

namespace gift\appli\services;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database
{
    public static function connect($iniFile)
    {
        $config = parse_ini_file($iniFile, true)['database'];
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver' => $config['driver'],
            'host' => $config['host'],
            'database' => $config['database'],
            'username' => $config['username'],
            'password' => $config['password'],
            'charset' => $config['charset'],
            'collation' => $config['collation'],
        ]);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}
