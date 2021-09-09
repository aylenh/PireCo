<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distribuidor extends Model
{
    protected $table = 'distribuidores';
    protected $fillable = ['distribuidor_local', 'distribuidor_correo', 'distribuidor_contacto', 'distribuidor_imagen', 'distribuidor_ubicacion'];
}
