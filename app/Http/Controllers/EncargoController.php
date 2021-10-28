<?php

namespace App\Http\Controllers;

use App\DetallesEncargo;
use Illuminate\Http\Request;
use App\Encargo;
use Illuminate\Support\Facades\DB;
use App\Mail\EncargosEmail;
use Illuminate\Support\Facades\Mail;

class EncargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Encargo::all();
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
    public function store(Request $request)
    {

        //MercadoPago

        $validated = $request->validate([

            'nombre' => 'required',
            'domicilio' => 'required',
            'telefono' => 'required',
            'correo',
            'horario_de' => 'required',
            'horario_hasta' => 'required',
            'total' => 'required',
        ]);
        
        $encargo = new Encargo;
        $encargo->nombre = $request->input('nombre');
        $encargo->domicilio = $request->input('domicilio');
        $encargo->telefono = $request->input('telefono');
        $encargo->correo = $request->input('correo');
        $encargo->horario_de = $request->input('horario_de');
        $encargo->horario_hasta = $request->input('horario_hasta');
        $encargo->total = $request->input('total');
        $encargo->save();

        foreach ($request->productos as $key => $producto) {
            $detalles = new DetallesEncargo;
            $detalles->cantidad = $producto['cantidad'];
            $detalles->producto_id = $producto['producto_id'];
            $detalles->encargo_id = $encargo->id;
            $detalles->save();
        }

        return response()->json(Encargo::with('detalles')->find($encargo->id));
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
