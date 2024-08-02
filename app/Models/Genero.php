<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    protected $table = 'Genero';
    protected $primaryKey = 'n_id_genero';
    public $incrementing = true;
    protected $keyType = 'integer';
    public $timestamps = false;

    protected $fillable = [
        'Detalle'
];
    protected $casts = [
        'n_id_genero' => 'integer'
    ];
}