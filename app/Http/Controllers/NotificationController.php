<?php

namespace App\Http\Controllers;

class NotificationController extends Controller
{
    public function sendSmsNotificaition()
    {
        $basic = new \Vonage\Client\Credentials\Basic("d727c4fc", "kBzv1dE9GVPbxT9L");
        $client = new \Vonage\Client($basic);

        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS("201127482460", "KSHOPINA", 'Welcome in Kshopina sms service!')
        );
        
        $message = $response->current();
        
        if ($message->getStatus() == 0) {
            echo "The message was sent successfully\n";
        } else {
            echo "The message failed with status: " . $message->getStatus() . "\n";
        }
    }
}
