<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NilaiAtribut extends Model
{
    protected $fillable = [
        'name',
        'atribut_id'
    ];

    protected $dates = [];

    public function atribut()
    {
        return $this->belongsTo(Atribut::class, 'atribut_id');
    }
}
