<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
class CineTarifa extends Pivot
{
    protected $table = 'CineTarifa';
    protected $fillable = [
        'idCine',
        'DiasSemana',
        'Precio',
    ];

    
    public function Cine() {
        return $this->belongsTo(Cine::class, 'id');
    }
}
