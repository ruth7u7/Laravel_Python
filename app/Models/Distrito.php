<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    protected $table = 'Distrito';
    protected $primaryKey = 'n_id_distrito';
    public $incrementing = true;
    protected $keyType = 'integer';
    public $timestamps = false;

    protected $fillable = [
        'Detalle'
];
    protected $casts = [
        'n_id_distrito' => 'integer'
    ];

    public function Cine()
    {
        return $this->belongsTo(Cine::class, 'n_id_cine');
    }
}