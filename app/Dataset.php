<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dataset extends Model
{
    protected $casts = [
        'data' => 'array'
    ];

    protected $fillable = [
        'data'
    ];

    protected $dates = [];
}
