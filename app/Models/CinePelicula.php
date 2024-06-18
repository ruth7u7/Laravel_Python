<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CinePelicula extends Model
{
    use HasFactory;
    protected $table = 'CinePelicula';
    protected $fillable = [
        'idCine',
        'idPelicula',
        'Sala',
        'Horarios'
    ];
    protected $primaryKey = 'id';

    public function Cine(){
        return $this->hasMany(Cine::class, 'id');
    }

    public function Pelicula(){
        return $this->hasMany(Pelicula::class, 'id');
    }
}
