<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    use HasFactory;
    protected $fillable=['cli_cedula','cli_nombre', 'cli_apellido', 'cli_correo', 'cli_celular', 'cli_ciudad','cli_estado',
    ];
    protected $primaryKey = 'id'; 


}
