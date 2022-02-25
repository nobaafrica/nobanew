<?php

namespace App\Traits;

use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

trait SendSMSTrait
{
    /**
     * Sends sms to user using Twilio's programmable sms client
     * @param $message
     * @param $recipient
     * @return string
     * @throws ConfigurationException
     * @throws TwilioException
     */
    public function sendMessage($message, $recipient)
    {
        $sid    = config('services.twilio.sid');
        $token  = config('services.twilio.token');
        $from   = config('services.twilio.from');
        $twilio = new Client($sid, $token);

        return $twilio->messages->create(
            $recipient, // to
            [
                "from" => $from,
                "body" => $message,
                'statusCallback' => config('app.twilio_callback')
            ]
        );
    }

    public function getErrorMessage($code, $message): string
    {
        if ($code === 21211) {
            $errorMessage = "This phone number is invalid";
        } elseif ($code === 21408) {
            $errorMessage = "We don't have international permission necessary to SMS this phone number";
        } elseif ($code === 21610) {
            $errorMessage = "This phone number is blocked";
        } elseif ($code === 21614) {
            $errorMessage = "This phone number is incapable of receiving SMS messages";
        } elseif ($code === 30008) {
            $errorMessage = "Unknown error. Message not sent";
        } elseif ($message) {
            $errorMessage = $message;
        } else {
            $errorMessage = "Could not send SMS notification to User";
        }
        return $errorMessage;
    }
}
