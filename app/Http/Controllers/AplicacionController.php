<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Pedido;


class AplicacionController extends Controller
{
    public function index()
    {
        $pedidos = DB::table('pedidos')->select('pedido_detalle', 'pedido_monto', 'pedido_pago', 'pedido_distribuidora')->get();
        return view('pedidos.clientes')->with('pedidos', $pedidos);
    }
}
