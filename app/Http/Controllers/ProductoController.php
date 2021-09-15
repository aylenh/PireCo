<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;

class ProductoController extends Controller
{
    public function save(Request $request){
        Producto::insert([
            'producto_botella'=>$request->producto_botella,
            'producto_descartable'=>$request->producto_descartable,
            'producto_litros'=>$request->producto_litros,
            'producto_precio'=>$request->producto_precio
        ]);
        return response()->json(['code'=>1,'msg'=>'Nuevo producto agregado con exito.']);
  } 

    public function fetchProductos(){
        $productos = Producto::all();
        $data = \View::make('productos.all_productos')->with('productos', $productos)->render();
        return response()->json(['code'=>1,'result'=>$data]);

    }

    public function getProductosDetails(Request $request) {
        $producto = Producto::find($request->producto_id);
        return response()->json(['code'=>1,'result'=>$producto]);
    }

    public function updateProducto(Request $request) {
        $producto_id = $request->pid;
        $producto = Producto::find($producto_id);

        $producto->update([
            'producto_botella'=>$request->producto_botella,
            'producto_descartable'=>$request->producto_descartable,
            'producto_litros'=>$request->producto_litros,
            'producto_precio'=>$request->producto_precio
        ]);
        
        return response()->json(['code'=>1, 'msg'=>'Producto actualizado con exito!']);
    }
        

    public function deleteProducto(Request $request) {
        $producto = Producto::find($request->producto_id);
        $query = $producto->delete();
        if($query) {
            return response()->json(['code'=>1, 'msg'=>'Producto se elimino con exito!']);
        }else{
            return response()->json(['code'=>0, 'msg'=>'Algo salio mal']);
        }
    }
}
