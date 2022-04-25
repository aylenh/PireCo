<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MercadoPagoController extends Controller
{
    public function __construct()
    {
        \MercadoPago\SDK::setAccessToken('TEST-7867639488584393-041912-438885428a4806bb8cc46a1d0a6c6b00-1068659476');
    }

    public function notification(Request $request){
        return $request;
        switch($request->type) {
            case "payment":
                $payment = \MercadoPago\Payment::find_by_id($request->data->id);
                break;
            case "plan":
                $plan = \MercadoPago\Plan::find_by_id($request->data->id);
                break;
            case "subscription":
                $plan = \MercadoPago\Subscription::find_by_id($request->data->id);
                break;
            case "invoice":
                $plan = \MercadoPago\Invoice::find_by_id($request->data->id);
                break;
            case "point_integration_wh":
                // $_POST contiene la informaciòn relacionada a la notificaciòn.
                break;
            case "test":
                // $_POST contiene la informaciòn relacionada a la notificaciòn.
                break;
        }
    }
}
