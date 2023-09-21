<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalleservi extends Model
{
    use HasFactory;
    protected $table = 'detalle_servi';
    protected $fillable = ['res_codigo', 'ser_codigo'];


    public function servicios()
    {
        return $this->hasOne('App\Models\Servicio', 'ser_codigo', 'ser_codigo');
    }
   
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function reservas()
    {
        return $this->hasOne('App\Models\reserva', 'res_codigo', 'res_codigo');
    }
}
