<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallesEncargo extends Model
{
    
    protected $fillable = [
        'cantidad',
        'encargo_id',
        'producto_id'
    ];

    public function encargo()
    {
        return $this->belongsTo(Encargo::class);
    }

    public function producto()
    {
        return $this->hasOne(Producto::class);
    }

}
