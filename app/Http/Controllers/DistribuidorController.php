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
                    'distribuidor_ubicacion'=>$request->distribuidor_ubicacion,
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

    public function getDistribuidoresDetails(Request $request) {
        $distribuidor = Distribuidor::find($request->distribuidor_id);
        return response()->json(['code'=>1,'result'=>$distribuidor]);
    }

    public function updateDistribuidor(Request $request) {
        $distribuidor_id = $request->pid;
        $distribuidor = Distribuidor::find($distribuidor_id);
        $path = 'files/';

        //Validar inputs
        $validator = \Validator::make($request->all(),[
            'distribuidor_local'=>'required',
            'distribuidor_correo'=>'required',
            'distribuidor_contacto'=>'required',
            'distribuidor_ubicacion'=>'required',
            'distribuidor_imagen_update'=>'image',
        ],[
        'distribuidor_imagen_update' => "Distribuidor imagen debe ser una imagen" 
        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{

            if($request->hasFile('distribuidor_imagen_update')){
                $file_path = $path.$distribuidor->distribuidor_imagen;
                //Eliminar imagen anterior
                if($distribuidor->distribuidor_imagen != null && \Storage::disk('public')->exists($file_path)){
                    \Storage::disk('public')->delete($file_path);
                }
                //Subir nueva imagen
                $file = $request->file('distribuidor_imagen_update');
                $file_name = time().'_'.$file->getClientOriginalName();
                $upload = $file->storeAs($path, $file_name, 'public');

                if($upload) {
                    $distribuidor->update([
                        'distribuidor_local'=>$request->distribuidor_local,
                        'distribuidor_correo'=>$request->distribuidor_correo,
                        'distribuidor_contacto'=>$request->distribuidor_contacto,
                        'distribuidor_ubicacion'=>$request->distribuidor_ubicacion,
                    ]);
                    
                    return response()->json(['code'=>1, 'msg'=>'Distribuidor actualizado con exito!']);
                }
            
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
    }

    public function deleteDistribuidor(Request $request) {
        $distribuidor = Distribuidor::find($request->distribuidor_id);
        $path = 'files/';
        $image_path = $path.$distribuidor->distribuidor_imagen;
        if($distribuidor->distribuidor_imagen != null && \Storage::disk('public')->exists($image_path)){
            \Storage::disk('public')->delete($image_path);
        }
        $query = $distribuidor->delete();
        if($query) {
            return response()->json(['code'=>1, 'msg'=>'Distribuidor se elimino con exito!']);
        }else{
            return response()->json(['code'=>0, 'msg'=>'Algo salio mal']);
        }
    }
}
