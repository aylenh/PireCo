<?php

# Strings y textos centralizados - 14/04/2021

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use URL;

class SendinBlueController extends Controller
{
    public function send_email(Request $request)
    {
        /* 
        *   Variables:
        *       htmlmail
        *       sendto
        *       sentto_name
        *       subject
        *       
        */
        $html = json_encode($request->htmlmail);

        $telephone_document_link = json_encode([$request->telephone, $request->document, $request->linkSMS]);
        
        $curl = curl_init();
        $postfields = "{\"sender\":{\"name\":\"Mansfieldmin\",\"email\":\"noresponder@mansfieldmin.com\"},\"to\":[{\"email\":\"$request->sendto\",\"name\":\"$request->sentto_name.\"}],\"htmlContent\":$html,\"textContent\":\".\",\"subject\":\"$request->subject\"}";
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.sendinblue.com/v3/smtp/email",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $postfields,
        CURLOPT_HTTPHEADER => array(
            "accept: application/json",
            "api-key: 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",
            "content-type: application/json"
        ),
        ));

    
        $response = curl_exec($curl);
        /* dump($response); */
        $err = curl_error($curl);
        /* dump($err); */

        return array($response, $err, $telephone_document_link);
    }


 
    public function send_sms(Request $request)
    {
        $telephone = $request->data[0];
        $document = $request->data[2];

        $curl = curl_init();
        curl_setopt_array($curl, [
          CURLOPT_URL => "https://api.sendinblue.com/v3/transactionalSMS/sms",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => json_encode(
              array(
                  "type" => "transactional",
                  "sender" => "Mansfield",
                  "recipient" => "+". strval($telephone),
                  "content" => "Tu codigo de barras de Mansfieldmin es: " . strval($document)
                )
              ),
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "api-key: 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",
                "content-type: application/json"
            ),
        ]);
       $response = curl_exec($curl);
        $err = curl_error($curl);
       curl_close($curl);
       if ($err) {
          return response()->json([
            "success" => false,
            "message" => "error al enviar mensaje",
          ],422);
       } else {
          return response()->json([
              "success" => true,
              "message" => $response
          ]);
        }
    }

}
