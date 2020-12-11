<?php

namespace App\AppointmentReminders;

use Illuminate\Log;
use Carbon\Carbon;
use Twilio\Rest\Client;

class AppointmentReminder
{
    /**
     * Construct a new AppointmentReminder
     *
     * @param Illuminate\Support\Collection $twilioClient The client to use to query the API
     */
    public function __construct()
    {
        $this->appointments = \App\Appointment::appointmentsDue()->get();

		/**
		
// Find your Account Sid and Auth Token at twilio.com/console
$sid    = "AC3d7083cec682b78152d5e320cc6b80a2";
$token  = "d20e7772f4a0715de3fbb408235a6e5b";
$twilio = new Client($sid, $token);
	
// creation service
$service = $twilio->verify->v2->services
                              ->create("Verification Tel");

$serviceid= $service->sid ;
	
$verification = $twilio->verify->v2->services($serviceid)
                                   ->verifications
                                   ->create($tel, "sms");

echo $service->sid  ;
		
		*/
		
     /*   $twilioConfig =\Config::get('services.twilio');
        $accountSid = $twilioConfig['twilio_account_sid'];
        $authToken = $twilioConfig['twilio_auth_token'];
        $this->sendingNumber = $twilioConfig['twilio_number'];*/
		
		$sid    = "AC3d7083cec682b78152d5e320cc6b80a2";
		$token  = "d20e7772f4a0715de3fbb408235a6e5b";
        $this->sendingNumber = '(659) 234-3197';

        $this->twilioClient = new Client($accountSid, $authToken);
    }

    /**
     * Send reminders for each appointment
     *
     * @return void
     */
    public function sendReminders()
    {
        $this->appointments->each(
            function ($appointment) {
                $this->_remindAbout($appointment);
            }
        );
    }

    /**
     * Sends a message for an appointment
     *
     * @param Appointment $appointment The appointment to remind
     *
     * @return void
     */
    private function _remindAbout($appointment)
    {
        $recipientName = $appointment->name;
        $time = Carbon::parse($appointment->when, 'UTC')
              ->subMinutes($appointment->timezoneOffset)
              ->format('g:i a');

        $message = "Hello $recipientName, this is a reminder that you have an appointment at $time!";
        $this->_sendMessage($appointment->phoneNumber, $message);
    }

    /**
     * Sends a single message using the app's global configuration
     *
     * @param string $number  The number to message
     * @param string $content The content of the message
     *
     * @return void
     */
    private function _sendMessage($number, $content)
    {
        $this->twilioClient->messages->create(
            $number,
            array(
                "from" => $this->sendingNumber,
                "body" => $content
            )
        );
    }
}
