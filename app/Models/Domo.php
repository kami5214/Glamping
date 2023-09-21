<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Domo extends Model
{
    use HasFactory;
    protected $fillable = ['dom_nombre', 'dom_estado', 'dom_precio','dom_ubicacion','dom_descripcion','dom_capacidad'
    ];
    protected $primaryKey = 'dom_codigo'; //holi kami :D

    public function getFormattedPriceAttribute()
    {
        return number_format($this->attributes['dom_precio'], 2);
    }
    
    public function caracteristicas()
{
    //return $this->belongsToMany(caracteristica::class, 'domo_caracte');
    return $this->belongsToMany(caracteristica::class, 'domo_caracte', 'dom_codigo', 'car_codigo')
    ->withPivot('car_codigo');
}


}
