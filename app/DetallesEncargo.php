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

    protected $appends = ['sub_total'];

    public function encargo()
    {
        return $this->belongsTo(Encargo::class);
    }

    public function producto()
    {
        return $this->hasOne(Producto::class,'id','producto_id');
    }

    public function getSubTotalAttribute()
    {
        return (int) $this->cantidad * (int) $this->producto->producto_precio;
    }

}
