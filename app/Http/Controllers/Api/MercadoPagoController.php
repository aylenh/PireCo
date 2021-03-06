<?php

namespace App\Http\Controllers\Api;

use App\Encargo;
use App\Http\Controllers\Controller;
use App\Mail\TestPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MercadoPagoController extends Controller
{
    public function __construct()
    {
        \MercadoPago\SDK::setAccessToken( config('mercadopago.access_token') );
    }

    public function notification(Request $request){
        switch($request->type) {
            case "payment":
                $payment = \MercadoPago\Payment::find_by_id($request->data['id']);
                $encargo = Encargo::find((int)$payment->external_reference);
                $encargo->payed = true;
                $encargo->save();
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
