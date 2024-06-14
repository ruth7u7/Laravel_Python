<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CineTarifa extends Model
{
    use HasFactory;
    protected $fillable = [
        'idCine',
        'diasSemana',
        'Precio',
    ];
     public function Cine() {
        return $this->belongsTo(Cine::class, 'id');
     }
}
