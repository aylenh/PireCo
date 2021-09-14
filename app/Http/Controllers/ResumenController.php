<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ResumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('resumen', ['generalModul'=> 'General', 'parenModul' => 'General', 'modulName' => 'Remitos'
        ,'clientes' => DB::table('clients')->get()
        ,'clientId' => null]);
    }

    public function render($day)
    {
        # Date format change (ufff! easy-peasy cuz is just equal)
        $dayExploded = explode('-', $day);
        $daySpanishFormat = $dayExploded[2].'/'.$dayExploded[1].'/'.$dayExploded[0];

        # Get business wich saled this day
        $salesByClient = array();
        foreach(DB::select("SELECT DISTINCT(idCLient) Cliente FROM clientsbyserviceremitos WHERE fecha = '".$daySpanishFormat."'") as $result):

            # Get companies name
            $company = DB::table('clients')->select('nfanstasia')->where('id', $result->Cliente)->first();
            $salesByClient[$result->Cliente]['Name'] = $company->nfanstasia;

            # Get total sales
            $totalSales = DB::select("SELECT SUM((quantity * price)) Suma FROM clientsbyserviceremitos WHERE idCLient = '".$result->Cliente."' AND fecha = '".$daySpanishFormat."'");
            $salesByClient[$result->Cliente]['Total'] = $totalSales[0]->Suma;

            # Get total remitos
            $totalRemitos = DB::select("SELECT GROUP_CONCAT(remito ORDER BY remito ASC SEPARATOR ', ') Remitos FROM clientsbyserviceremitos WHERE idCLient = '".$result->Cliente."' AND fecha = '".$daySpanishFormat."'");
            $salesByClient[$result->Cliente]['Remtios'] = $totalRemitos[0]->Remitos;
            
        endforeach;

        return view('resumen', ['generalModul'=> 'General', 'parenModul' => 'General', 'modulName' => 'Remitos'
            ,'clientes' => DB::table('clients')->get()
            ,'day' => $day
            ,'salesByClient' => $salesByClient
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $dataService = explode(' - $', $request->servicio);
        return DB::insert('insert into clientsbyserviceremitos (
            idCLient,
            fecha,
            remito,
            guia,
            counter,
            quantity,
            price
        ) values (?, ?, ?, ?, ?, ?, ?)', [
            $request->client,
            $request->fecha,
            $request->remito,
            $request->guia,
            $dataService[0],
            $request->cantidad,
            $dataService[1]
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
        //
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
        return DB::table('clientsbyserviceremitos')->where('id', $id)->delete();
    }
}
