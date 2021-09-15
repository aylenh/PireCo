<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard', [
            'generalModul'=> 'Dashboard', 'parenModul' => 'Dashboard', 'modulName' => 'Dashboard'
            ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $response, $id = 0)
    {
        if(!$response->subquery):
            $allFree = ($response->allFree) ? ">" : "=";

            if($response->id != 0):
                # Normal place
                return json_encode(DB::select("
                    SELECT 
                        Sq1.*
                    FROM
                    (
                        SELECT
                            hr1.* 
                        FROM
                            hr hr1
                        WHERE
                            hr1.id 
                        IN (
                            SELECT 
                                pv.idHR
                            FROM 
                                placesvisited pv
                            WHERE
                                pv.idPlace = '".$response->id."'
                            GROUP BY 
                                pv.idHR
                            HAVING 
                                COUNT(pv.idHR) % 2
                        )
                    ) Sq1
                "));
            else:
                # Common place where's nowhere hr
                return json_encode(DB::select("
                SELECT
                    hr1.*, (SELECT pv2.comment FROM placesvisited pv2 WHERE pv2.idHR = hr1.id ORDER BY id DESC LIMIT 1) Salida
                FROM
                    hr hr1
                WHERE
                    hr1.id 
                NOT IN (
                    SELECT 
                        pv.idHR
                    FROM 
                        placesvisited pv
                    GROUP BY 
                        pv.idHR, pv.idPlace
                    HAVING 
                        COUNT(pv.idHR) % 2
                )          
                "));
            endif;
        else:
            
            $exploded = explode(':', 
                json_encode(DB::select("
                    SELECT
                        COUNT(idPlace) Count
                    FROM
                    (
                        SELECT 
                            pv.idPlace
                        FROM 
                            placesvisited pv
                        WHERE
                            pv.idHR = '".$response->hr."'
                        AND
                            pv.idPlace != '".$response->id."'
                        GROUP BY 
                            pv.idPlace
                        HAVING 
                            COUNT(pv.idPlace) % 2
                    ) Sq2
                ")
            ));

            return substr($exploded[1], 0, -2);

        endif;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        return DB::insert('insert into placesvisited (idPlace, idHR, comment, created_at, updated_at) values (?, ?, ?, ?, ?)', [
            $request->placeId, 
            $request->id, 
            'Forzado desde Dashboard',
            \Carbon\Carbon::now(),
            \Carbon\Carbon::now()
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
        //
    }
}
