<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CashController extends Controller
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

        return view('cash', ['generalModul'=> 'General', 'parenModul' => 'General', 'modulName' => 'Caja Diaria'
        ,'mainview' => true
        ,'clientes' => DB::table('clients')->get()
        ]);
    }

    public function render($day)
    {

        # Explode date to other format
        $dateF = explode('-', $day);

        # Get previus close before today (doesn't matter if is yesterday or a week ago)
        $previusClose = DB::table('cash')
            ->whereRaw("dateamerformat < '".$day."'")
            ->where('concept', 'LIKE', 'Cierre y Ajuste de Caja%')
            ->orderby('id', 'DESC')
            ->first();

        /* dd($previusClose); */

        # Count Cierres to block button if closes had been made
        $countClose = DB::table('cash')
            ->whereRaw("dateamerformat = '".date('Y-m-d')."'")
            ->where('concept', 'LIKE', 'Cierre y Ajuste de Caja%')
            ->count();

        # Count Cierres to block button if closes had been made
        $countCloseThisDay = DB::table('cash')
        ->whereRaw("dateamerformat = '".$day."'")
        ->where('concept', 'LIKE', 'Cierre y Ajuste de Caja%')
        ->count();

        # Exist closes after today?
        $countClosesAfterToday = DB::table('cash')
        ->whereRaw("dateamerformat > '".$day."'")
        ->where('concept', 'LIKE', 'Cierre y Ajuste de Caja%')
        ->count();

        # Get Incomes Resume
        $incomesResume = DB::select("SELECT concept, SUM(finalammout) Suma FROM cash WHERE type = 'haber' AND date = '".$dateF[2]."/".$dateF[1]."/".$dateF[0]."' GROUP BY concept;");

        # Get Outcomes Resume
        $outcomesResume = DB::select("SELECT concept, SUM(finalammout) Suma FROM cash WHERE type = 'debe' AND date = '".$dateF[2]."/".$dateF[1]."/".$dateF[0]."' GROUP BY concept;");

        # Get Monthly Incomes
        $incomesResumeMonthly = DB::select("SELECT SUM(finalammout) Suma FROM cash WHERE type = 'haber' AND date LIKE '%"."/".$dateF[1]."/".$dateF[0]."'");

        # Get Monthly Outcomes
        $outcomesResumeMonthly = DB::select("SELECT SUM(finalammout) Suma FROM cash WHERE type = 'debe' AND date LIKE '%"."/".$dateF[1]."/".$dateF[0]."'");

        # Get Incomes Count by MercadoPago
        /* $mpResume = DB::select("SELECT concept, SUM(finalammout) Suma FROM cash WHERE type = 'haber' AND paymentmethod != 'Mercadopago' AND date = '".$dateF[2]."/".$dateF[1]."/".$dateF[0]."' GROUP BY concept;"); */
        $mpResume = DB::select("
        SELECT 
            paymentmethod, SUM(finalammout) Suma 
        FROM cash 
        WHERE 
            type = 'haber' 
            AND paymentmethod != 'Efectivo' 
            AND date = '".$dateF[2]."/".$dateF[1]."/".$dateF[0]."' GROUP BY paymentmethod
        ");

        # Get Cash movements of the day
        return view('cash', ['generalModul'=> 'General', 'parenModul' => 'General', 'modulName' => 'Caja Diaria'
            ,'mainview' => false
            ,'incomes' => DB::table('cashincome')->get()
            ,'outcomes' => DB::table('cashoutcome')->get()
            ,'day' => $day
            ,'movements' => DB::table('cash')->whereRaw("date = '".$dateF[2]."/".$dateF[1]."/".$dateF[0]."'")->orderby('id','ASC')->get()
            ,'prevC' => $previusClose
            ,'countClose' => $countClose
            ,'countCloseThisDay' =>  $countCloseThisDay
            ,'countClosesAfterToday' => $countClosesAfterToday
            ,'incomesResume' => $incomesResume
            ,'outcomesResume' => $outcomesResume
            ,'mpResume' => $mpResume

            ,'incomesResumeMonthly' => $incomesResumeMonthly
            ,'outcomesResumeMonthly' => $outcomesResumeMonthly
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addincome(Request $request)
    {

        # Get exploded the concept an de ammount
        if(strpos($request->concept, ' - $') !== false):
            $exIncome = explode(' - $', $request->concept);
            $ammount = $request->ammount;
        else:
            $ammount = 1;
            $exIncome[0] = $request->concept;
            $exIncome[1] = $request->ammount;
        endif;

        $formadepago = ($request->formadepagodigitalselector) ? $request->formadepagodigitalselector : 'Efectivo';

        if($request->lastAmmount == ""):
            $result = 0;
        else:
            $result = $request->lastAmmount;
        endif;

        if(isset($request->day)):
            $day = $request->day; 
            # Create spanish day format
            $dayE = explode('-', $day);
            $daySpanish = $dayE[2].'/'.$dayE[1].'/'.$dayE[0];
        else:
            $day = date('Y-m-d');
            $daySpanish = date('d/m/Y');
        endif;

        return DB::insert('insert into cash (
            date,
            dateamerformat,
            concept,
            paymentmethod,
            qtty,
            ammount,
            finalammout,
            type,
            result
        ) values (?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $daySpanish,
            $day,
            $exIncome[0].' ('.$request->ingresos_observaciones.')',
            $formadepago,
            $ammount,
            $request->monto,
            ($ammount * $request->monto),
            'haber',
            $result
        ]);

    }

    public function addoutcome(Request $request)
    {

        # Get exploded the concept an de ammount
        $formadepago = ($request->ingreso_mercadopago) ? 'Mercadopago' : 'Efectivo';

        if($request->lastAmmount == ""):
            $result = 0;
        else:
            $result = $request->lastAmmount;
        endif;

        if(isset($request->day)):
            $day = $request->day; 
            # Create spanish day format
            $dayE = explode('-', $day);
            $daySpanish = $dayE[2].'/'.$dayE[1].'/'.$dayE[0];
        else:
            $day = date('Y-m-d');
            $daySpanish = date('d/m/Y');
        endif;

        return DB::insert('insert into cash (
            date,
            dateamerformat,
            concept,
            paymentmethod,
            qtty,
            ammount,
            finalammout,
            type,
            result
        ) values (?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $daySpanish,
            $day,
            $request->concept.' ('.$request->egreso_observaciones.')',
            '',
            1,
            $request->ammount,
            $request->ammount,
            'debe',
            $result
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
