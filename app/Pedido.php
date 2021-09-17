<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = ['pedido_detalle', 'pedido_monto', 'pedido_pago', 'pedido_distribuidora'];
}
