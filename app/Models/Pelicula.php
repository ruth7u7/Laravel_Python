<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pelicula extends Model
{
    use HasFactory;
    protected $table = 'Pelicula';
    protected $fillable = [
                    'v_titulo',
                    'd_fechaestreno',
                    'v_director',
                    'n_id_Clasificacion',
                    'n_id_Estado',
                    'd_duracion',
                    'v_link',
                    'v_reparto',
                    'v_sinopsis',
    ];
    protected $primaryKey = 'id';
}
