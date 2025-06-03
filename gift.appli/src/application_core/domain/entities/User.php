<?php

namespace gift\appli\application_core\domain\entities;

use gift\appli\application_core\domain\entities\Box;
use Illuminate\Database\Eloquent\Model;

/**
 * Modèle Eloquent représentant un utilisateur.
 * Correspond à la table "user" en base de données.
 */

class User extends Model
{
    protected $table = 'user';
    protected $fillable = [
        'user_id',
        'password',
        'role'
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * Relation avec le modèle Box.
     * Un utilisateur peut avoir plusieurs boxes.
     */
    public function boxes()
    {
        return $this->hasMany(Box::class, 'createur_id');
    }
}
