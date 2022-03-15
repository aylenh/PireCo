<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $fillable = [
        'cantidad',
        'distribuidor_id',
        'cel_cliente',
        'bidon10',
        'bidon20',
        'pago', 
        'correo_cliente',
        'nombre',
        'created_at', 
        'updated_at', 
    ];

    public function encargo()
    {
        return $this->belongsTo(Encargo::class);
    }

    public function producto()
    {
        return $this->hasOne(Producto::class,'id','producto_id');
    }

    public function distribuidores()
    {
        return $this->belongsTo(Distribuidor::class,'distribuidor_id','id');
    }

}
