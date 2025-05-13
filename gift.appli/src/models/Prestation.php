<?php

namespace gift\appli\models;

use Illuminate\Database\Eloquent\Model;

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

    public function coffretTypes()
    {
        return $this->belongsToMany(CoffretType::class, 'coffret2presta', 'presta_id', 'coffret_id');
    }
}
    