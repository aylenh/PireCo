<?php

namespace App\Http\Controllers\Api;

use App\DetallesEncargo;
use App\DetallesInventarios;
use App\Producto;
use App\Encargo;
use App\Inventario;
use App\Http\Controllers\Controller;
use App\Http\Requests\EncargoRequest;
use Illuminate\Http\Request;
use App\Mail\EncargosEmail;
use Illuminate\Support\Facades\Mail;
use MercadoPago;
use Illuminate\Support\Facades\DB;

class EncargoController extends Controller
{
    public function __construct()
    {
        MercadoPago\SDK::setAccessToken(env('MP_ACCESS_TOKEN'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Encargo::with('detalles')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EncargoRequest $request)
    {
        $encargo = new Encargo;
        $encargo->nombre = $request->input('nombre');
        $encargo->domicilio = $request->input('domicilio');
        $encargo->telefono = $request->input('telefono');
        $encargo->correo = $request->input('correo');
        $encargo->horario_de = $request->input('horario_de');
        $encargo->horario_hasta = $request->input('horario_hasta');
        $encargo->total = $request->input('total');

        $inventario = new Inventario;

        if(!isset($request->directo)){
            $encargo->distribuidor_id = $request->input('distribuidor_id');
            $distribuidor = Inventario::where('distribuidor_id', $request->input('distribuidor_id'))->first();
        }
      
        $encargo->save();
        $cliente = Inventario::where('cel_cliente', $request->input('telefono'))->first();
        

        $items = array();

        foreach ($request->productos as $key => $producto) {
            $detalles = new DetallesEncargo();
            $detalles->cantidad = $producto['cantidad'];
            $detalles->producto_id = $producto['producto_id'];
            $detalles->encargo_id = $encargo->id;

            if(!isset($request->directo)){
                if(empty($distribuidor)){
                    $inventario->cel_cliente = $request->input('telefono');
                    $inventario->correo_cliente = $request->input('correo');
                    $inventario->distribuidor_id = $request->input('distribuidor_id');
                    $inventario->estado = 1;
                    $inventario->nombre = $request->input('nombre');

    
                    if($producto['producto_id'] == 1){
                        $inventario->bidon10 = $producto['cantidad'];
                    }else if($producto['producto_id'] == 2){
                        $inventario->bidon20 = $producto['cantidad'];
                    }
                    $inventario->save();
                }else{
                    if ($request->input('distribuidor_id') == $distribuidor->distribuidor_id) {
                        
                        if($producto['producto_id'] == 1){
                            $distribuidor->bidon10 = $distribuidor->bidon10 + $producto['cantidad'];
                        }else if($producto['producto_id'] == 2){
                            $distribuidor->bidon20 = $distribuidor->bidon20+$producto['cantidad'];
                        }
                        $distribuidor->update();
                    }
                }
            }else {
                if(empty($cliente)){
                    $inventario->cel_cliente = $request->input('telefono');
                    $inventario->correo_cliente = $request->input('correo');
                    $inventario->estado = 1;
                    $inventario->nombre = $request->input('nombre');
    
                    if($producto['producto_id'] == 1){
                        $inventario->bidon10 = $producto['cantidad'];
                    }else if($producto['producto_id'] == 2){
                        $inventario->bidon20 = $producto['cantidad'];
                    }
                    $inventario->save();
                }else{
                    if ($request->input('telefono') == $cliente->cel_cliente) {
                        
                        if($producto['producto_id'] == 1){
                            $cliente->bidon10 = $cliente->bidon10 + $producto['cantidad'];
                        }else if($producto['producto_id'] == 2){
                            $cliente->bidon20 = $cliente->bidon20+$producto['cantidad'];
                        }
                        $cliente->update();
                    }
                }
            }
           

            $consulta = Producto::where("id",$detalles->producto_id)->get();
            foreach ($consulta as $con) {
                $cantidad = $con->cantidad - $detalles->cantidad;
            }
            $fin = intval($cantidad);
            Producto::where("id",$detalles->producto_id)->update(["cantidad" => $fin]);
            
            $detalles->save();

            $item = new MercadoPago\Item();
            $item->title = $detalles->producto->producto_botella;
            $item->quantity = $detalles->cantidad;
            $item->unit_price = $detalles->producto->producto_precio;
            array_push($items, $item);
        }

        // Crea un objeto de preferencia
        $preference = new MercadoPago\Preference();
        $preference->items = $items;
        $preference->notification_url = url('/mercadopago/notification');
        $preference->external_reference = $encargo->id;
        $preference->save();

        if($preference->error)
        {
            $response = array(
                'error' => $preference->error
            );
        }else{
            $response = array(
                'link'      => $preference->init_point,
                'encargo'   => Encargo::with(['detalles', 'distribuidor'])->find($encargo->id)
            );
        }

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Encargo::findOrFail($id)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $encargo = Encargo::findOrFail($id);
        $encargo->delete();
        
        return response()->json('Encargo eliminado con exito!');
    }

    public function payCash(Encargo $encargo, Request $request){
        $request->validate([
            'correo' => 'required|email'
        ]);

        $correo = new EncargosEmail($encargo);
        Mail::to($request->correo)->send($correo);

        return response()->json(array(
            'message' => 'El Correo fue enviado con exito para el encargo '.$encargo->id.'!'
        ));
    }
}
