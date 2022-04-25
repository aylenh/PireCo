<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MercadoPagoController extends Controller
{
    public function __construct()
    {
        \MercadoPago\SDK::setAccessToken(env('MP_ACCESS_TOKEN'));
    }

    public function notification($request){
        \MercadoPago\SDK::setAccessToken("ENV_ACCESS_TOKEN");
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
        }
    }
}
