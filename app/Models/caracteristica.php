<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class caracteristica extends Model
{
    use HasFactory;
    protected $fillable=['car_estado', 'car_descripcion', 'car_nombre', 'car_precio',
   
];
protected $primaryKey = 'car_codigo';


public function getFormattedPriceAttribute()
{
    return number_format($this->attributes['car_precio'], 2);
}

public function domos()
{
    //return $this->belongsToMany(Domo::class, 'domo_caracte');
    return $this->belongsToMany(Domo::class, 'domo_caracte', 'car_codigo', 'dom_codigo')
    ->withPivot('dom_codigo');
}


}


