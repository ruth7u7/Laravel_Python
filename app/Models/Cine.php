<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cine extends Model
{
    use HasFactory;
    protected $fillable = [
                'RazonSocial',
                'Salas',
                'idDistrito',
                'Direccion',
                'Telefonos'

    ];
    public function Distrito(){
        return $this->belongsTo(Distrito::class, 'id');
    }
}
