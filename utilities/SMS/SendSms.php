<?php

namespace Utilities\SMS;

use Illuminate\Http\Request;

trait SendSms
{
    public function send($from, $to, $message)
    {

        $curl = curl_init();
        $body = "{ \"from\":\"$from\", \"to\":\"2$to\", \"text\":\"$message\" }";
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.infobip.com/sms/1/text/single",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "authorization: Basic RnVtZVN0dWRpbzpjaXZpbDIwMDE=",
                "content-type: application/json"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return false;
        } else {
            return true;
        }
    }


}
