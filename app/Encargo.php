<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encargo extends Model
{
    protected $fillable = [
        'nombre', 
        'domicilio', 
        'telefono', 
        'correo', 
        'horario_de', 
        'horario_hasta', 
        'total'];

    public function detalles()
    {
        return $this->hasMany(DetallesEncargo::class);
    }
}
