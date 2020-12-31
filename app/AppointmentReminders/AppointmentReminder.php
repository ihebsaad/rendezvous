<?php

namespace App\AppointmentReminders;

use Illuminate\Log;
use Carbon\Carbon;
use Twilio\Rest\Client;
use \App\Http\Controllers\ReservationsController;

class AppointmentReminder
{
    /**
     * Construct a new AppointmentReminder
     *
     * @param Illuminate\Support\Collection $twilioClient The client to use to query the API
     */
    public function __construct()
    {
      // lister les rendez vous d'aujourdhui
       $this->resvdujour = ReservationsController::reservationsdujour();

      //hs  $this->appointments = \App\Appointment::appointmentsDue()->get();

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
		
		$sid    = "ACa9a8bf9d60934bca1e18517dc5102062";
        //$token  = "f469833a67aa9762a846ae5be7965257";
        $token  = "c45f6d2e87d34e98182eb0bdc0abc665";
        //$this->sendingNumber = '(659) 234-3197';
        $this->sendingNumber = '+13347589498';
        //$this->twilioClient = new Client($accountSid, $authToken);
        $this->twilioClient = new Client($sid, $token);
    }

    /**
     * Send reminders for each appointment
     *
     * @return void
     */
    public function sendReminders()
    {
        /*hs $this->appointments->each(
            function ($appointment) {
                $this->_remindAbout($appointment);
            }
        );*/
        foreach ($this->resvdujour as $resv) {
            $this->_remindAbout($resv->id);
        }
        
    }

    /**
     * Sends a message for an appointment
     *
     * @param Appointment $appointment The appointment to remind
     *
     * @return void
     */
    //hs private function _remindAbout($appointment)
    private function _remindAbout($idreservation)
    {
        /*hs $recipientName = $appointment->name;
        $time = Carbon::parse($appointment->when, 'UTC')
              ->subMinutes($appointment->timezoneOffset)
              ->format('g:i a');

        $message = "Hello $recipientName, this is a reminder that you have an appointment at $time!";
        $this->_sendMessage($appointment->phoneNumber, $message);*/
        $recipientName = "Haythem SAHLIA";
        $time = "10:30 AM";

        $message = "Hello $recipientName, this is a reminder about reservation # $idreservation .";
        $this->_sendMessage("+21654076876", $message);
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
