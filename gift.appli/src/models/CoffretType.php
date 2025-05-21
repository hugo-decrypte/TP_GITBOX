<?php

namespace gift\appli\models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modèle Eloquent représentant un type de coffret.
 * Correspond à la table "coffret_type" en base de données.
 */

class CoffretType extends Model
{
    protected $table = 'coffret_type';

    public $timestamps = false;
    protected $fillable = ['libelle', 'description', 'theme_id'];

    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * définie une relation N-N
     */


    /**
     * Relation Eloquent Many-to-Many avec les prestations.
     *
     * Définit la relation N-N entre CoffretType et Prestation via la table pivot 'coffret2presta'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function prestations()
    {
        return $this->belongsToMany(Prestation::class, 'coffret2presta', 'coffret_id', 'presta_id');
    }
}
