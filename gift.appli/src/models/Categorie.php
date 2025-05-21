<?php

namespace gift\appli\models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modèle Eloquent représentant une catégorie.
 * Correspond à la table "categorie" en base de données.
 **
 */

class Categorie extends Model
{
    protected $table = 'categorie';

    public $timestamps = false;
    protected $fillable = ['libelle', 'description'];


    /**
     * Relation Eloquent : une catégorie possède plusieurs prestations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prestations()
    {
        return $this->hasMany(Prestation::class, 'cat_id');
    }
}
