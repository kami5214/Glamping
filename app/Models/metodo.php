<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class metodo extends Model
{
    use HasFactory;
    protected $fillable=['met_nombre',
    ];
    protected $primaryKey = 'met_codigo';
}
