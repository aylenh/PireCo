<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ResumenmonthlyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cc = array();
        # Get clients
        foreach(DB::table('clients')->get() as $client):
            # Get cc movements of each client
            $ccMovements = DB::table('cc')->where('idClient', $client->id)->orderByRaw('id ASC')->get();
            $cc[$client->nfanstasia]['movements'] = $ccMovements;
            $cc[$client->nfanstasia]['id'] = $client->id;
        endforeach;

        return view('resumenmonthly', ['generalModul'=> 'General', 'parenModul' => 'General', 'modulName' => 'Remitos'
        ,'clientes' => DB::table('clients')->get()
        ,'clientId' => null
        ,'cc' => $cc]);
    }

    public function render($day)
    {
        $cc = array();
        # Get clients
        foreach(DB::table('clients')->get() as $client):
            # Get cc movements of each client
            $ccMovements = DB::table('cc')->where('idClient', $client->id)->orderByRaw('id ASC')->get();
            $cc[$client->nfanstasia]['movements'] = $ccMovements;
            $cc[$client->nfanstasia]['id'] = $client->id;
        endforeach;



        # Date format change (ufff! easy-peasy cuz is just equal)
        $dayExploded = explode('-', $day);
        $daySpanishFormat = '/'.$dayExploded[1].'/'.$dayExploded[0];

        $dateExploded = explode('-', $day);
        $dateFinal = $dateExploded[0].'-'.$dateExploded[1];

        # Get business wich saled this day
        $salesByClient = array();
        foreach(DB::select("SELECT DISTINCT(idCLient) Cliente FROM clientsbyserviceremitos WHERE fecha LIKE '%".$daySpanishFormat."'") as $result):

            # Get companies name
            $company = DB::table('clients')->select('nfanstasia')->where('id', $result->Cliente)->first();
            $salesByClient[$result->Cliente]['Name'] = $company->nfanstasia;

            # Get total sales
            $totalSales = DB::select("SELECT SUM(price) Suma FROM clientsbyserviceremitos WHERE idCLient = '".$result->Cliente."' AND fecha LIKE '%".$daySpanishFormat."'");
            $salesByClient[$result->Cliente]['Total'] = $totalSales[0]->Suma;

            # Get total remitos
            $totalRemitos = DB::select("SELECT GROUP_CONCAT(remito ORDER BY remito ASC SEPARATOR ', ') Remitos FROM clientsbyserviceremitos WHERE idCLient = '".$result->Cliente."' AND fecha LIKE '%".$daySpanishFormat."'");
            $salesByClient[$result->Cliente]['Remtios'] = $totalRemitos[0]->Remitos;

            # Check if was billed
            $billedCheck = DB::select("SELECT COUNT(id) Cuenta FROM cc WHERE idClient = '".$result->Cliente."' AND month = '".$dateFinal ."'");
            $salesByClient[$result->Cliente]['Billed'] = $billedCheck[0]->Cuenta;
            
        endforeach;

        return view('resumenmonthly', ['generalModul'=> 'General', 'parenModul' => 'General', 'modulName' => 'Remitos'
            ,'clientes' => DB::table('clients')->get()
            ,'day' => $day
            ,'salesByClient' => $salesByClient
            ,'cc' => $cc
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $dateExploded = explode('-', $request->date);
        $dateFinal = $dateExploded[0].'-'.$dateExploded[1];

        return DB::insert('insert into cc (
            idClient,
            month,
            date,
            concept,
            ammount,
            type
        ) values (?, ?, ?, ?, ?, ?)', [
            $request->id,
            $dateFinal,
            $request->fecha,
            $request->numero,
            $request->monto,
            'debe'
        ]);

    }

    public function addrecibo(Request $request)
    {
        return DB::insert('insert into cc (
            idClient,
            month,
            date,
            concept,
            ammount,
            type
        ) values (?, ?, ?, ?, ?, ?)', [
            $request->id,
            '',
            $request->fecha,
            $request->numero,
            $request->monto,
            'haber'
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
