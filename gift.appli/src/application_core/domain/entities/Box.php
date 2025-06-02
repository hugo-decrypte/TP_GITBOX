<?php

namespace gift\appli\application_core\domain\entities;

use gift\appli\models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Modèle Eloquent représentant une box créé par l'utilisateur.
 * Correspond à la table "box" en base de données.
 */

class Box extends Model
{
    protected $table = 'box';
    protected $fillable = [
        'token',
        'libelle',
        'description',
        'montant',
        'kdo',
        'message_kdo',
        'statut',
        'libelle',
        'created_at',
        'updated_at',
        'createur_id'
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * Relation avec le modèle User.
     * Une box appartient à un utilisateur.
     */
    public function createur()
    {
        return $this->belongsTo(User::class, 'createur_id');
    }


    /**
     * Relation Many-to-Many avec le modèle Prestation.
     * Une box peut avoir plusieurs prestations.
     */
    public function prestations()
    {
        return $this->belongsToMany(Prestation::class, 'box2presta', 'box_id', 'presta_id');
    }
}
