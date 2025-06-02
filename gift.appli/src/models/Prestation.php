<?php

namespace gift\appli\models;


use Illuminate\Database\Eloquent\Model;

/**
 * Modèle Eloquent représentant une prestation.
 * Correspond à la table "prestation" en base de données.
 **/

class Prestation extends Model {

    protected $table = 'prestation';

    public $timestamps = false;
    protected $fillable = ['libelle', 'description', 'url', 'unite', 'tarif', 'img', 'cat_id'];

    public $incrementing = false;
    protected $keyType = 'string';

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'cat_id');
    }


    /**
     * Relation Many-to-Many avec le modèle Box.
     * Une prestation peut appartenir à plusieurs boxes.
     */
    public function boxes()
    {
        return $this->belongsToMany(Box::class, 'box2presta', 'presta_id', 'box_id');
    }


    /**
     * Relation Eloquent Many-to-Many vers les types de coffret.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function coffretTypes()
    {
        return $this->belongsToMany(CoffretType::class, 'coffret2presta', 'presta_id', 'coffret_id');
    }
}
