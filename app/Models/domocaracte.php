<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class domocaracte extends Model
{
    use HasFactory;
    protected $table = 'domo_caracte';
    protected $fillable = ['dom_codigo', 'car_codigo'];


    public function caracteristicas()
    {
        return $this->hasOne('App\Models\caracteristica', 'car_codigo', 'car_codigo');
    }
   
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function domos()
    {
        return $this->hasOne('App\Models\Domo', 'dom_codigo', 'dom_codigo');
    }
   


}
