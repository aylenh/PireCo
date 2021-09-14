<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CashOutcome extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        # Row exist?
        if(DB::table('cashoutcome')->count() == 0):
            DB::insert('insert into cashoutcome (
                service1,
                price1,
                service2,
                price2,
                service3,
                price3,
                service4,
                price4,
                service5,
                price5,
                service6,
                price6,
                service7,
                price7,
                service8,
                price8,
                service9,
                price9,
                service10,
                price10,
                service11,
                price11,
                service12,
                price12,
                service13,
                price13,
                service14,
                price14,
                service15,
                price15,

                service16,
                price16,
                service17,
                price17,
                service18,
                price18,
                service19,
                price19,
                service20,
                price20,
            ) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
    
                '',
                '',
    
                '',
                '',
    
                '',
                '',
    
                '',
                '',
    
                '',
                '',
    
                '',
                '',
    
                '',
                '',
    
                '',
                '',
    
                '',
                '',
    
                '',
                '',

                '',
                '',

                '',
                '',

                '',
                '',

                '',
                '',

                '',
                ''
            ]);
        endif;

        return view('cashoutcome', ['generalModul'=> 'Configuraciones', 'parenModul' => 'Altas Generales', 'modulName' => 'Egresos por Caja'
        ,'clientes' => DB::table('clients')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return;
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
        return DB::table('cashoutcome')->select('cashoutcome.*')->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        return DB::table('cashoutcome')->update([
            'service1'         => $request->service1,
            'price1'          => $request->price1,

            'service2'         => $request->service2,
            'price2'          => $request->price2,

            'service3'         => $request->service3,
            'price3'          => $request->price3,

            'service4'         => $request->service4,
            'price4'          => $request->price4,

            'service5'         => $request->service5,
            'price5'          => $request->price5,

            'service6'         => $request->service6,
            'price6'          => $request->price6,

            'service7'         => $request->service7,
            'price7'          => $request->price7,

            'service8'         => $request->service8,
            'price8'          => $request->price8,

            'service9'         => $request->service9,
            'price9'          => $request->price9,

            'service10'         => $request->service10,
            'price10'          => $request->price10,

            'service11'         => $request->service11,
            'price11'          => $request->price11,

            'service12'         => $request->service12,
            'price12'          => $request->price12,

            'service13'         => $request->service13,
            'price13'          => $request->price13,

            'service14'         => $request->service14,
            'price14'          => $request->price14,

            'service15'         => $request->service15,
            'price15'          => $request->price195,

            /*  */

            'service16'         => $request->service16,
            'price16'          => $request->price16,

            'service17'         => $request->service17,
            'price17'          => $request->price17,

            'service18'         => $request->service18,
            'price18'          => $request->price18,

            'service19'         => $request->service19,
            'price19'          => $request->price19,

            'service20'         => $request->service20,
            'price20'          => $request->price20
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
        return DB::table('cashoutcome')->where('id', $id)->delete();
    }
}
