<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $fillable = [
        'producto_botella', 
        'producto_descartable', 
        'producto_litros', 
        'producto_precio',
        'imagen',
        'cantidad'
    ];

    public function detalles()
    {
        return $this->belongsTo(DetallesEncargo::class);
    }

    public function encargos()
    {
        return $this->hasMany(Encargo::class);
    }

    public function inventarios()
    {
        return $this->hasMany(Inventario::class);
    }
}
