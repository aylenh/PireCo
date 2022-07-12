<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;

class PaymentController extends Controller
{

    public function __construct()
    {
        \MercadoPago\SDK::setAccessToken( config('mercadopago.access_token') );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function payment(Request $request){

      $preference = new \MercadoPago\Preference();
      $items = [];

      foreach ($request->items as $key => $item) {
        $item_aux = new \MercadoPago\Item();
        $item_aux->title = $item['title'];
        $item_aux->quantity = (int) $item['quantity'];
        $item_aux->unit_price = (int) $item['unit_price'];
        array_push($items, $item_aux);
      }

      $preference->items = $items;

      $preference->save();

      return response()->json([
                'init_point' => $preference->init_point
              ]);
    }

}
