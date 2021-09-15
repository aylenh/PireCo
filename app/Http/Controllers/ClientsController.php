<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('clients', ['generalModul'=> 'Configuraciones', 'parenModul' => 'Altas Generales', 'modulName' => 'Clientes']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return DB::insert('insert into clients (
            rsocial,
            nfanstasia,
            domicilif,
            cuit,
            categoria,
            tipofactura,
            facturarcon,
            contacto,
            domicilioretiro,
            telefonos,
            mail,
            observaciones
        ) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $request->rsocial,
            $request->nfanstasia,
            $request->domicilif,
            $request->cuit,
            $request->categoria,
            $request->tipofactura,
            $request->facturarcon,
            $request->contacto,
            $request->domicilioretiro,
            $request->telefonos,
            $request->mail,
            $request->observaciones
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return DB::table('clients')->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        return DB::table('clients')->where('id', $id)->update([
            'rsocial'            => $request->rsocial,
            'nfanstasia'         => $request->nfanstasia,
            'domicilif'          => $request->domicilif,
            'cuit'               => $request->cuit,
            'categoria'          => $request->categoria,
            'tipofactura'        => $request->tipofactura,
            'facturarcon'        => $request->facturarcon,
            'contacto'           => $request->contacto,
            'domicilioretiro'    => $request->domicilioretiro,
            'telefonos'          => $request->telefonos,
            'mail'               => $request->mail,
            'observaciones'      => $request->observaciones
        ]);
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
        return DB::table('clients')->where('id', $id)->delete();
    }
}
