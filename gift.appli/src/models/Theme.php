<?php

namespace gift\appli\models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $table = 'theme';

    public $timestamps = false;

    public function coffrets()
    {
        return $this->hasMany(CoffretType::class, 'theme_id');
    }
}
