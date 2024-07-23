<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeliculaGenero extends Model
{
    protected $table = 'peliculagenero';
    protected $fillable = [
                    'n_id_pelicula',
                    'n_id_genero',
    ];
    protected $primaryKey = 'id';
}
