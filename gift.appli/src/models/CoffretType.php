<?php

namespace gift\appli\models;

use Illuminate\Database\Eloquent\Model;



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

    public function prestations()
    {
        return $this->belongsToMany(Prestation::class, 'coffret2presta', 'coffret_id', 'presta_id');
    }
}
