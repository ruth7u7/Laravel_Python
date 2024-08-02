<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cine extends Model
{
    use HasFactory;
    protected $table = 'Cine';
    protected $fillable = [
                'RazonSocial',
                'Salas',
                'idDistrito',
                'Direccion',
                'Telefonos'

    ];
    protected $primaryKey = 'id';
    
    public function Distrito(){
        return $this->belongsTo(Distrito::class, 'id');
    }

    public function pelicula(){

        return $this->belongsToMany(Pelicula::class, 'CinePelicula', 'n_id_cine', 'n_id_pelicula')
            ->using(CinePelicula::class)
            ->withPivot('d_horarios');
}
}