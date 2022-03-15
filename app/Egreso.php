<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Egreso extends Model
{
    protected $fillable = [
        'monto', 
        'nota', 
        'fecha', 
        'cliente_id',
        'distribuidor_id'
    ];
  
}


