<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Distribuidor;

class ApiDistribuidorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Distribuidor::all();
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
        $distribuidor = new Distribuidor;
        $distribuidor->distribuidor_local = $request->input('distribuidor_local');
        $distribuidor->distribuidor_correo = $request->input('distribuidor_correo');
        $distribuidor->distribuidor_contacto = $request->input('distribuidor_contacto');
        $distribuidor->distribuidor_ubicacion = $request->input('distribuidor_ubicacion');
        $distribuidor->save();

        return('Distribuidor guardado con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Distribuidor::findOrFail($id)->get();
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
        $distribuidor = Distribuidor::findOrFail($id);
        $distribuidor->delete();
        
        return('Distribuidor borrado con exito!');
    }
}
