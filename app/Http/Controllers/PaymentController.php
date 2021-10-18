<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;

class PaymentController extends Controller
{

    public function __construct()
    {
        require base_path('vendor/autoload.php');
        \MercadoPago\SDK::setAccessToken(env('MP_ACCESS_TOKEN'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //Bidon 20 ltrs
        $item1 = new \MercadoPago\Item();
        $item1->id = "BIDON 20 LTRS";
        $item1->title = 'Bidon 20 ltrs';
        $item1->quantity = 1;
        $item1->unit_price = 3.00;
        $item1->description = "Bidon que contiene 20 litros";
        $item1->currency_id = "USD";
        $item1->category_id = "Bidon";
        //Bidon 10 ltrs
        $item2 = new \MercadoPago\Item();
        $item2->id = "BIDON 10 LTRS";
        $item2->title = 'Bidon 10 ltrs';
        $item2->quantity = 1;
        $item2->unit_price = 1.50;
        $item2->description = "Bidon que contiene 10 litros";
        $item2->currency_id = "USD";
        $item2->category_id = "Bidon";
        //Botella 1 ltrs
        $item3 = new \MercadoPago\Item();
        $item3->id = "BOTELLA 1 LTRS";
        $item3->title = 'Botella 1 ltrs';
        $item3->quantity = 1;
        $item3->unit_price = 0.50;
        $item3->currency_id = "USD";
        $item3->category_id = "Botella";
        
  
        $preference = new \MercadoPago\Preference();
  
        $preference->items = array($item1, $item2, $item3);
        $preference->init_point;

        
        //Guardar y postear la preferencia
        $preference->save();

        return response()->json([$preference->items, $preference->init_point]);

    }

    public function success(Request $request){  
        return 'success';     
      }  
      public function failure(Request $request){  
        return 'failure';  
      }  
      public function pending(Request $request){  
        return 'pending';  
      }  
}
