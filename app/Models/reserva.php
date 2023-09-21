<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reserva extends Model
{
    use HasFactory;
    protected $fillable=['res_fecha_ini', 'res_fecha_fin', 'res_fecha_registro','res_cantidad_per', 'res_descuento',
     'res_total','usu_cedula','dom_codigo','cli_cedula'];
     protected $attributes = [
        'res_estado' => 'confirmada', // Valor predeterminado para res_estado
    ];
    
    public function getFormattedPriceAttribute()
    {
        return number_format($this->attributes['res_total'], 2);
    }
     public function usuario()
    {
        return $this->belongsTo(User::class, 'usu_cedula', 'id');
    }

    public function cliente()
    {
        return $this->belongsTo(cliente::class, 'cli_cedula', 'id');
    }

    public function domo()
    {
        return $this->belongsTo(Domo::class, 'dom_codigo', 'dom_codigo');
    }

    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'detalle_servi', 'res_codigo', 'ser_codigo')
        ->withPivot('ser_codigo');
    }
}
