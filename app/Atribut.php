<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atribut extends Model
{
    protected $fillable = [
        'name',
    ];
    public function nilai()
    {
        return $this->hasMany(NilaiAtribut::class, 'atribut_id');
    }
}
