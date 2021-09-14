<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DateTime;
use DatePeriod;
use DateInterval;
use Collection;

class RemitosprintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('remitosprint', ['generalModul'=> 'General', 'parenModul' => 'General', 'modulName' => 'Imprimir Remitos'
        ,'clientes' => DB::table('clients')->get()
        ,'clientId' => null]);
    }

    public function render($client, $day, $day2)
    {
        # Date format change (ufff! easy-peasy cuz is just equal)
        $dayExploded = explode('-', $day);
        $daySpanishFormat = $dayExploded[2].'/'.$dayExploded[1].'/'.$dayExploded[0];

        $day2Exploded = explode('-', $day2);
        $day2SpanishFormat = $dayExploded[2].'/'.$dayExploded[1].'/'.$dayExploded[0];

        # Get total of this client
        # This should be refactorized, cuz, it's not efficient in this way
        $end = new DateTime( $day2Exploded[0].'-'.$day2Exploded[1].'-'.$day2Exploded[2] );
        $end = $end->modify( '+1 day' ); 
        $period = new DatePeriod(
            new DateTime( $dayExploded[0].'-'.$dayExploded[1].'-'.$dayExploded[2] ),
            new DateInterval('P1D'),
            $end
       );

       $allItems = collect();

       foreach ($period as $key => $value) {
            /* dump($value->format('d/m/Y')); */
            /*  dump((DB::table('clientsbyserviceremitos')->where('idCLient', $client)->where('fecha','=', $value->format('d/m/Y'))->get())); */
            $allItems = $allItems->merge(DB::table('clientsbyserviceremitos')->where('idCLient', $client)->where('fecha','=', $value->format('d/m/Y'))->get());
       }

       /* dd($allItems); */

        return view('remitosprint', ['generalModul'=> 'General', 'parenModul' => 'General', 'modulName' => 'Imprimir Remitos'
            ,'clientes' => DB::table('clients')->get()
            ,'clientId' => $client
            ,'day' => $day
            ,'day2' => $day2
            ,'finalAmmount' => 0
            ,'columnsServices' => DB::table('clientsbyservice')->where('idCLient', $client)->get()
            ,'countColumns' => 0
            ,'servicesRemitos' => $allItems
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
        $dayExploded = explode('/', $request->fecha);

        return DB::insert('insert into clientsbyserviceremitos (
            idCLient,
            nombre,
            fecha,
            remito,
            guia,
            counter,
            quantity,
            price,

            localidad,
            provincia,
            adicionales
        ) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $request->client,
            $request->nombre,
            $request->fecha,
            $request->remito,
            $request->guia,
            $dataService[0],
            $request->cantidad,
            $dataService[1],
            
            $request->localidad,
            $request->provincia,
            $request->adicionales
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
