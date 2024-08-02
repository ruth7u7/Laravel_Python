<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CinePelicula extends Pivot
{
    use HasFactory;
    protected $table = 'CinePelicula';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'n_id_cine',
        'n_id_pelicula',
        'd_horarios'
    ];

    protected $casts = [
        'n_id_cine' => 'integer',
        'n_id_pelicula' => 'integer',
        'd_horarios' => 'date: H:i:s d-m-Y'
    ];

    public function cine()
    {
        return $this->belongsTo(Cine::class, 'n_id_cine');
    }
    
    public function pelicula()
    {
        return $this->belongsTo(Pelicula::class, 'n_id_pelicula');
    }
}
