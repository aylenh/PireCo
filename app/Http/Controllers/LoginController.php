<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login', [
            'generalModul'=> 'Login', 'parenModul' => 'Login', 'modulName' => 'Login'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(DB::table('users')->where(['user' => $request->user, 'password' => $request->password])->count() == 1):
            session(['logged' => $request->user]);
            # Save profile type
            session(['profiletype' => DB::table('users')->where(['user' => $request->user, 'password' => $request->password])->first()->profiletype]);
            return DB::table('users')->where(['user' => $request->user, 'password' => $request->password])->first()->profiletype;
        endif;
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
        session()->forget('logged');
        session()->forget('profiletype');
        session()->forget('superadmin');
        return 1;
    }

    public function superAdmin(Request $request)
    {
        if($request->password == 'dhd2021'):
            session(['superadmin' => true]);
            return 1;
        else:
            return 0;
        endif;
    }
}
