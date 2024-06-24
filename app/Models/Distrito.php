<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    use HasFactory;
    protected $table = 'Distritos';
    protected $fillable = [
        'Detalle'
    ];
    protected $primaryKey = 'id';
    
}
