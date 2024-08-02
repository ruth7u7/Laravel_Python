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

    protected $casts = [
        'n_id_pelicula' => 'integer',
        'n_id_genero' => 'integer'
    ];

    public function Pelicula(){
        return $this->belongsToMany(Pelicula::class, 'n_id_pelicula');
    }

    public function Genero(){
        return $this->belongsToMany(Genero::class, 'n_id_genero');
    }

}
