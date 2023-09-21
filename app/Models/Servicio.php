<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class servicio extends Model
{
    use HasFactory;
    protected $fillable = ['ser_nombre', 'ser_estado', 'ser_precio','ser_cantidad'
    ];
    protected $primaryKey = 'ser_codigo'; 
    public function getFormattedPriceAttribute()
    {
        return number_format($this->attributes['ser_precio'], 2);
    }
    public function reservas()
{
    //return $this->belongsToMany(Domo::class, 'domo_caracte');
    return $this->belongsToMany(reserva::class, 'detalle_servi', 'ser_codigo', 'res_codigo')
    ->withPivot('res_codigo');
}
}
