<?php

namespace App\Http\Controllers;

use App\DetallesEncargo;
use Illuminate\Http\Request;
use App\Encargo;
use App\Http\Requests\EncargoRequest;
use Illuminate\Support\Facades\DB;
use App\Mail\EncargosEmail;
use Illuminate\Support\Facades\Mail;
use MercadoPago;

class EncargoController extends Controller
{
    // Funcion que muestra la vista 
    public function index()
    {
        $blue['encargos'] = Encargo::with('detalles','distribuidor')->get();
        return view('encargos.clientes', $blue);
    }

    // funcion que muestra los detalles del pedido
    public function detallesEncargo(Encargo $encargo)
    {
            $blue['encargos'] = $encargo;
  
            return view('encargos.detallesEncargo', $blue);
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EncargoRequest $request)
    {
        return response()->json('hols');
         // SDK de Mercado Pago
        require base_path('/vendor/autoload.php');
         // Agrega credenciales
        MercadoPago\SDK::setAccessToken('TEST-7110253609417365-110317-d424c5125ab59755a7dcd3ccd1b3d4bb-1011886178');
        
        
        $encargo = new Encargo;
        $encargo->nombre = $request->input('nombre');
        $encargo->domicilio = $request->input('domicilio');
        $encargo->telefono = $request->input('telefono');
        $encargo->correo = $request->input('correo');
        $encargo->horario_de = $request->input('horario_de');
        $encargo->horario_hasta = $request->input('horario_hasta');
        $encargo->total = $request->input('total');
        $encargo->distribuidor_id = $request->input('distribuidor_id');
        $encargo->save();

        $items = array();

        foreach ($request->productos as $key => $producto) {
            $detalles = new DetallesEncargo;
            $detalles->cantidad = $producto['cantidad'];
            $detalles->producto_id = $producto['producto_id'];
            $detalles->encargo_id = $encargo->id;
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
        $preference->back_urls = array(
            "success" => "http://localhost:8080/feedback",
            "failure" => "http://localhost:8080/feedback", 
            "pending" => "http://localhost:8080/feedback"
        );
        $preference->auto_return = "approved";
        $preference->save();

        $response = array(
            'link'      => $preference->init_point,
            'encargo'   => Encargo::with(['detalles', 'distribuidor'])->find($encargo->id)
        );

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
}
