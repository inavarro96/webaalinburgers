<?php

// Update the path below to your autoload.php,
// see https://getcomposer.org/doc/01-basic-usage.md
require_once './../../libs/Twilio/autoload.php';

use Twilio\Rest\Client;

class MessageUtils {

    public function send($telefono, $descripcion) {
        // Your Account SID and Auth Token from twilio.com/console
        $account_sid = 'ACc6f76454a49472a32cdc06023cef1583';
        $auth_token = 'e3aafa8d08276a7dbcd3a0219a0b29e8';
        // In production, these should be environment variables. E.g.:
        // $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]

        // A Twilio number you own with SMS capabilities
        $twilio_number = "+13203442665";

        $client = new Client($account_sid, $auth_token);
        $client->messages->create(
            // Where to send a text message (your cell phone?)
            '+52'.$telefono,
            array(
                'from' => $twilio_number,
                'body' => $descripcion
            )
        );
    }
}
