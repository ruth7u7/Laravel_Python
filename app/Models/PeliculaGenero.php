<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeliculaGenero extends Model
{
    protected $table = 'peliculagenero';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
                    'n_id_pelicula',
                    'n_id_genero',
    ];

}
