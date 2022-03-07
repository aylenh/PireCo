<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use DataTables; 

class ProductoController extends Controller
{
    // funcion creada por paula 
    // funcion que crea un producto 
    public function guardar(Request $request){

        $validator = \Validator::make($request->all(),[
            'producto_botella'=>'required',
            'producto_descartable'=>'required',
            'producto_litros'=>'required',
            'cantidad'=>'required',
            'producto_precio'=>'required'
        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0, 'error'=>$validator->errors()->toArray() ]);
        }else{
            $producto = new Producto();
            $producto->producto_botella = $request->producto_botella;
            $producto->producto_descartable = $request->producto_descartable;
            $producto->producto_litros = $request->producto_litros;
            $producto->producto_precio = $request->producto_precio;
            $producto->cantidad = $request->cantidad;
    
            $consulta = $producto->save();

            if(!$consulta){
                return response()->json(['code' => 0, 'msg'=>'¡No se pudo guardar el producto!']);
            }else{
                return response()->json(['code' => 1, 'msg'=>'¡Producto guardado exitosamente!']);
            }
        }
    }


    // funcion creada por paula 
    // funcion que muestra productos 
    public function mostrarProductos()
    {
        $productos = Producto::all();
    
        return DataTables::of($productos)
                                    ->addIndexColumn()
                                    ->addColumn('Acciones', function($row){
                                        return ' 
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-primary" data-id="'.$row['id'].'" id="editarProducto">Editar</button>
                                            <button class="btn btn-sm btn-danger" data-id="'.$row['id'].'" id="eliminarProducto">Eliminar</button>
                                        </div>
                                        ';
                                    })
                                    ->addColumn('checkbox', function($row){
                                        return '<input type="checkbox" name="check_producto" id="check_producto" data-id="'.$row['id'].'" ><label for=""></label>';
                                    })
                                    ->rawColumns(['Acciones','checkbox'])
                                    ->make(true);
    }

    // funcion creada por paula 
    // funcion que edita un producto 
    public function editarProducto(Request $request)
    {
        $producto_id = $request->producto_id;
        $productoEditar = Producto::find($producto_id);
            return response()->json(['editar' => $productoEditar]);
    }

    // fucnion hecha por paula 
    // funcion que actualiza un producto 
    public function actualizarProducto(Request $request)
    {
        $producto_id = $request->producto_id;
        
        $validator = \Validator::make($request->all(),[
            'producto_botella'=>'required',
            'producto_descartable'=>'required',
            'producto_litros'=>'required',
            'cantidad'=>'required',
            'producto_precio'=>'required'
        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0, 'error'=>$validator->errors()->toArray() ]);
        }else{
            $producto = Producto::find($producto_id);
            $producto->producto_botella = $request->producto_botella;
            $producto->producto_descartable = $request->producto_descartable;
            $producto->producto_litros = $request->producto_litros;
            $producto->producto_precio = $request->producto_precio;
            $producto->cantidad = $request->cantidad;
    
            $consulta = $producto->save();

            if(!$consulta){
                return response()->json(['code' => 0, 'msg'=>'¡No se pudo actualizar el producto!']);
            }else{
                return response()->json(['code' => 1, 'msg'=>'¡Producto Actualizado exitosamente!']);
            }
        }
    }
    
    // funcion creada por paula caicedo 
    // funcion que borra un prooducto 
    public function borrarProducto(Request $request){
        $producto_id = $request->producto_id;
        $consulta = Producto::find($producto_id)->delete();

        if ($consulta) {
            return response()->json(['code' => 1, 'msg'=>'¡Producto eliminado exitosamente!']);
        }else {
            return response()->json(['code' => 0, 'msg'=>'¡No se puedo eliminar el producto!']);
        }
    }

    // funcion creadapor paula 
    // funcion que borra los porductos elejidos en el checkbox 
    public function borrarProductosCheck(Request $request)
    {
        $producto_ids =  $request->productos_ids;
        Producto::whereIn('id', $producto_ids)->delete();

        return response()->json(['code'=>1, 'msg'=>'Producto eliminado correctamente']);
    }

// fin clase productos 
}
