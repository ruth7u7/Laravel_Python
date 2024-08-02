<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    
    protected $table = 'Sala';
    protected $primaryKey = 'n_id_sala';
    public $incrementing = true;
    protected $keyType = 'integer';
    public $timestamps = false;

    protected $fillable = [
        'Nombres',
        'Correo',
        'Contrasena',
    ];

    protected $casts = [
        'n_id_cliente' => 'integer'
    ];

    public function Sala()
    {
        return $this->belongsTo(Sala::class, 'n_id_sala');
    }
}
