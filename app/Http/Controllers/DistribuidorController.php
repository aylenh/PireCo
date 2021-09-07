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
           'distribuidor_imagen'=>'required|image'
        ],[
            'distribuidor_imagen.required'=>'Distribuidor image is required',
            'distribuidor_imagen.image'=>'Distribuidor file must be an image',
        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
            $path = 'files/';
            $file = $request->file('distribuidor_imagen');
            $file_name = time().'_'.$file->getClientOriginalName();

         //    $upload = $file->storeAs($path, $file_name);
         $upload = $file->storeAs($path, $file_name, 'public');
            
            if($upload){
                Distribuidor::insert([
                    'distribuidor_local'=>$request->distribuidor_local,
                    'distribuidor_correo'=>$request->distribuidor_correo,
                    'distribuidor_contacto'=>$request->distribuidor_contacto,
                    'distribuidor_imagen'=>$file_name,
                ]);
                return response()->json(['code'=>1,'msg'=>'Nuevo distribuidor agregado con exito.']);
                
            }
        }
  } 

    public function fetchDistribuidores(){
        $distribuidores = Distribuidor::all();
        $data = \View::make('distribuidores.all_distribuidores')->with('distribuidores', $distribuidores)->render();
        return response()->json(['code'=>1,'result'=>$data]);

    }
}
