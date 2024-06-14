<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CinePelicula extends Model
{
    use HasFactory;
    protected $fillable = [
        'idCine',
        'idPelicula',
        'Sala',
        'Horarios'
    ];

    public function Cine(){
        return $this->hasMany(Cine::class, 'id');
    }

    public function Pelicula(){
        return $this->hasMany(Pelicula::class, 'id');
    }
}
