<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    use HasFactory;
    protected $fillable = [
                    'Titulo',
                    'FechaEstreno',
                    'Director',
                    'Generos',
                    'idClasificacion',
                    'idEstado',
                    'Duracion',
                    'Link',
                    'Reparto',
                    'Sinopsis',
    ];
}
