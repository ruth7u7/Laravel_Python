<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    protected $table = 'pelicula';
    protected $primaryKey = 'n_id_pelicula';
    public $incrementing = true;
    protected $keyType = 'integer';
    public $timestamps = false;

    protected $fillable = [
        'v_titulo',
        'd_fechaestreno',
        'v_director',
        'n_id_clasificacion',
        'n_id_estado',
        'n_duracion',
        'v_link',
        'v_reparto',
        'v_sinopsis'
    ];

    protected $casts = [
        'n_id_pelicula' => 'integer',
        'd_fechaestreno' => 'date:d-m-Y',
        'n_id_clasificacion' => 'integer',
        'n_id_estado' => 'integer',
        'n_duracion' => 'integer',
    ];

    public function cine()
        {
        return $this->belongsToMany(Cine::class, 'CinePelicula', 'n_id_pelicula', 'n_id_cine')
            ->using(CinePelicula::class)
            ->withPivot('d_horarios');
        }

    public function cinePelicula()
        {
        return $this->hasMany(CinePelicula::class, 'n_id_pelicula');
        }
}