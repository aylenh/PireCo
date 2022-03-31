<?php

namespace App\Http\Controllers;

use App\cr;
use DateTime;
use App\DetallesEncargo;
use App\DetallesInventarios;
use App\Distribuidor;
use App\Encargo;
use App\Inventario;
use App\Producto;
use Illuminate\Http\Request;
use DB;
class ResumenBidones extends Controller
{
    // funcion creada por paula caicedo 
    // funcion que muestra la vista principal de resumen bidones, con la lista de bidones 
    public function index()
    {
        $blue['bidones'] = Inventario::with('distribuidores')->orderBy('created_at', 'DESC')->get();
        $blue['producto'] = Producto::select('id','cantidad')->whereIn('id', [1,2])->get();
   
        return view('bidones.cajaBidones', $blue);
     
    }
    public function verResumenCaja(){
        $blue['bidones'] = Inventario::with('distribuidores')->orderBy('created_at', 'DESC')->get();
        $blue['producto'] = Producto::select('id','cantidad')->whereIn('id', [1,2])->get();

        return view('bidones.resumenCajaBidones', $blue);
    }
    
    public function verTodo(){
        $blue['bidones'] = Inventario::with('distribuidores')->orderBy('created_at', 'DESC')->get();
        $blue['producto'] = Producto::select('id','cantidad')->whereIn('id', [1,2])->get();
   
        return view('bidones.resumenCajaBidones', $blue);
    }

    // funcion creada por paula 
    // funcion que consulta un intervalo de fechas 
    public function BidonesCajaFiltro(Request $request)
    {
        $fecha = new DateTime($request->input('fecha'));
        $fechaF= $fecha->format('Y-m-d');

        $fecha2 = new DateTime($request->input('fecha2'));
        $fechaF2= $fecha2->format('Y-m-d');

        $blue['bidones'] = Inventario::with('distribuidores')->whereBetween('created_at',[$fechaF, $fechaF2])->orderBy('created_at', 'DESC')->get();
        $blue['producto'] = Producto::select('id','cantidad')->whereIn('id', [1,2])->get();

        return view('bidones.resumenCajaBidones', $blue);

    }
    public function resumenTodos(){
        $bidones   = Inventario::orderBy('created_at', 'DESC')->get();
        $ids = DetallesEncargo::with('encargo')->whereIn('producto_id',[1,2])->orderBy('created_at', 'DESC')->get();
        foreach ($ids as $u) {
            $id[] = $u->encargo->id;
        }
        $eo = array_unique($id);
        $encargos = Encargo::whereIn('id', $eo)->count();
        return view('bidones.resumenCajaBidones', compact('bidones', 'encargos'));

    }
    // funcion creada por paula caicedo 
    // funcion que muestra la vista principal de resumen bidones, con la lista de bidones y filtros de fechas 
    public function resumenBidones(Request $request)
    {
        if ($request->input('fecha')) 
        {
            $fecha = new DateTime($request->input('fecha'));
            $fecha_hoy= $fecha->format('Y-m-d');

            $bidones   = Inventario::whereDate('created_at',$fecha_hoy)->orderBy('created_at', 'DESC')->get();
            $ids = DetallesEncargo::with('encargo')->whereDate('created_at',$fecha_hoy)->whereIn('producto_id',[1,2])->orderBy('created_at', 'DESC')->get();
            if(sizeof($ids))
            {
                foreach ($ids as $u) {
                    $id[] = $u->encargo->id;
                }
                $eo = array_unique($id);
                $encargos = Encargo::whereIn('id', $eo)->count();
            }else{
                $encargos = 0;
            }

        }
        else if($request->input('mes'))
        {
            $fecha = new DateTime($request->input('mes'));
            $fecha_hoy= $fecha->format('m');

            $bidones   = Inventario::whereMonth('created_at',$fecha_hoy)->orderBy('created_at', 'DESC')->get();
            $ids = DetallesEncargo::with('encargo')->whereMonth('created_at',$fecha_hoy)->whereIn('producto_id',[1,2])->orderBy('created_at', 'DESC')->get();
            if(sizeof($ids))
            {
                foreach ($ids as $u) {
                    $id[] = $u->encargo->id;
                }
                $eo = array_unique($id);
                $encargos = Encargo::whereIn('id', $eo)->count();
            }else{
                $encargos = 0;
            }
        }
   
        else
        {
            $fecha = new DateTime();
            $fecha_hoy= $fecha->format('Y-m-d');

            $bidones   = Inventario::whereDate('created_at',$fecha_hoy)->orderBy('created_at', 'DESC')->get();
            $ids = DetallesEncargo::with('encargo')->whereDate('created_at',$fecha_hoy)->whereIn('producto_id',[1,2])->orderBy('created_at', 'DESC')->get();
            if(sizeof($ids))
            {
                foreach ($ids as $u) {
                    $id[] = $u->encargo->id;
                }
                $eo = array_unique($id);
                $encargos = Encargo::whereIn('id', $eo)->count();
            }else{
                $encargos = 0;
            }

        }

        return view('bidones.resumenCajaBidones', compact('bidones', 'encargos'));
    }
  
    
    //  funcion creada por paula caicedo 
    // funcion que guarda los bidones devueltos     
    public function devolucionBidones(Request $request)
    {
        // return $request->all(); die();
        if($request->clientes){
            $con = Inventario::where('cel_cliente', $request->clientes)->first();
            
            if($request->litro == 1){
                $valor = $con->bidon10 - $request->devolucion;
                if($con->bidon10 < $valor  || $valor < 0){
                    return redirect()->route('bidones.caja')->with('mensaje','¡La cantidad de bidones devueltos es mayor a los bidones que debe el cliente '.$con->nombre.'!');
                }
                else{
                    $con->bidon10 = $con->bidon10 - $request->devolucion;
                    $con->update();
                    return redirect()->route('bidones.caja')->with('mensaje','¡Se realizo la devolucion correctamente para el cliente '.$con->nombre.'!');
                }
                
            }else if($request->litro == 2){
                
                $valor = $con->bidon20 - $request->devolucion;
             
                if($con->bidon20 < $valor || $valor < 0){
                    return redirect()->route('bidones.caja')->with('mensaje','La cantidad de bidones devueltos es mayor a los bidones que debe el cliente '.$con->nombre.'!');
                }
                else{
                    $con->bidon20 = $con->bidon20 - $request->devolucion;
                    $con->update();
                    return redirect()->route('bidones.caja')->with('mensaje','¡Se realizo la devolucion correctamente para el cliente '.$con->nombre.'!');
                }
            }
     
        }elseif($request->distribuidores){
            $con = Inventario::with('distribuidores')->where('distribuidor_id', $request->distribuidores)->first();
            if($request->litro == 1){
                $valor = $con->bidon10 - $request->devolucion;
                if($con->bidon10 < $valor  || $valor < 0){
                    return redirect()->route('bidones.caja')->with('mensaje','¡La cantidad de bidones devueltos es mayor a los bidones que debe el distribuidor '.$con->distribuidores->distribuidor_local.'!');
                }
                else{
                    $con->bidon10 = $con->bidon10 - $request->devolucion;
                    $con->update();
                    return redirect()->route('bidones.caja')->with('mensaje','¡Se realizo la devolucion correctamente para el distribuidor '.$con->distribuidores->distribuidor_local.'!');
                }
                
            }else if($request->litro == 2){
                
                $valor = $con->bidon20 - $request->devolucion;
             
                if($con->bidon20 < $valor || $valor < 0){
                    return redirect()->route('bidones.caja')->with('mensaje','La cantidad de bidones devueltos es mayor a los bidones que debe el cliente '.$con->distribuidores->distribuidor_local.'!');
                }
                else{
                    $con->bidon20 = $con->bidon20 - $request->devolucion;
                    $con->update();
                    return redirect()->route('bidones.caja')->with('mensaje','¡Se realizo la devolucion correctamente para el cliente '.$con->distribuidores->distribuidor_local.'!');
                }
            }
        }
     
    }

}
