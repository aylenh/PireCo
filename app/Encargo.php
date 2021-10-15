<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encargo extends Model
{
    protected $fillable = ['nombre', 'domicilio', 'telefono', 'horario_de', 'horario_hasta', 'bidon_20', 'bidon_10', 'botella_1', 'total'];
}
