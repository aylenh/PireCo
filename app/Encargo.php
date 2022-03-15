<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encargo extends Model
{
    protected $fillable = [
        'nombre', 
        'domicilio', 
        'telefono', 
        'pago', 
        'correo', 
        'horario_de', 
        'horario_hasta', 
        'total',
        'distribuidor_id',
        'payed'
    ];

    public function detalles()
    {
        return $this->hasMany(DetallesEncargo::class);
    }

    public function inventarios()
    {
        return $this->hasMany(Inventario::class);
    }

    public function distribuidor()
    {
        return $this->belongsTo(Distribuidor::class);
    }
  
}


