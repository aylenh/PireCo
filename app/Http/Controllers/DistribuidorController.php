<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Distribuidor;

class DistribuidorController extends Controller
{
    public function save(Request $request){
        $validator = \Validator::make($request->all(),[
           'distribuidor_local'=>'required',
           'distribuidor_correo'=>'required',
           'distribuidor_contacto'=>'required',
           'distribuidor_ubicacion'=>'required',
        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
            Distribuidor::insert([
                'distribuidor_local'=>$request->distribuidor_local,
                'distribuidor_correo'=>$request->distribuidor_correo,
                'distribuidor_contacto'=>$request->distribuidor_contacto,
                'distribuidor_ubicacion'=>$request->distribuidor_ubicacion,
            ]);
            return response()->json(['code'=>1,'msg'=>'Nuevo distribuidor agregado con exito.']);
        }
  } 

    public function fetchDistribuidores(){
        $distribuidores = Distribuidor::all();
        $data = \View::make('distribuidores.all_distribuidores')->with('distribuidores', $distribuidores)->render();
        return response()->json(['code'=>1,'result'=>$data]);

    }

    public function getDistribuidoresDetails(Request $request) {
        $distribuidor = Distribuidor::find($request->distribuidor_id);
        return response()->json(['code'=>1,'result'=>$distribuidor]);
    }

    public function updateDistribuidor(Request $request) {
        $distribuidor_id = $request->pid;
        $distribuidor = Distribuidor::find($distribuidor_id);

        //Validar inputs
        $validator = \Validator::make($request->all(),[
            'distribuidor_local'=>'required',
            'distribuidor_correo'=>'required',
            'distribuidor_contacto'=>'required',
            'distribuidor_ubicacion'=>'required',
        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $distribuidor->update([
                'distribuidor_local'=>$request->distribuidor_local,
                'distribuidor_correo'=>$request->distribuidor_correo,
                'distribuidor_contacto'=>$request->distribuidor_contacto,
                'distribuidor_ubicacion'=>$request->distribuidor_ubicacion,
            ]);
            return response()->json(['code'=>1, 'msg'=>'Distribuidor actualizado con exito!']);
        }
    }

    public function deleteDistribuidor(Request $request) {
        $distribuidor = Distribuidor::find($request->distribuidor_id);

        $query = $distribuidor->delete();
        if($query) {
            return response()->json(['code'=>1, 'msg'=>'Distribuidor se elimino con exito!']);
        }else{
            return response()->json(['code'=>0, 'msg'=>'Algo salio mal']);
        }
    }
}
