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
        $token  = "9c9ee876ab10f2d6e91da3f9437ea52e";
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
        // temps courant du Martinique
        date_default_timezone_set('America/Martinique');
        $currenttime = date('H:i');
        foreach ($this->resvdujour as $resv) {
            // initiation de maxTRappel 
            // calcule temps max du rappel
            if ($resv->rappel === "30") {
                $maxTRappel = date("H:i", strtotime('-30 minutes', strtotime($resv->heure)));
            }
            elseif ($resv->rappel === "60") {
                $maxTRappel = date("H:i", strtotime('-60 minutes', strtotime($resv->heure)));
            }
            elseif ($resv->rappel === "120") {
                $maxTRappel = date("H:i", strtotime('-120 minutes', strtotime($resv->heure)));
            }
            elseif ($resv->rappel === "1440") {
                $maxTRappel = date("H:i",strtotime($resv->heure));
            }
            // verifier si c'est le temps du rappel (>= temps rappel) et le rappel non envoyé
            if ((strtotime($currenttime) >= strtotime($maxTRappel)) && ($resv->rappel_statut == 0))
            {    
                //envoyer rappel SMS
                $this->_remindAbout($resv->id,$currenttime);
                ReservationsController::changestatutrappel($resv->id);
            }
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
    private function _remindAbout($idreservation,$curtime)
    {
        /*hs $recipientName = $appointment->name;
        $time = Carbon::parse($appointment->when, 'UTC')
              ->subMinutes($appointment->timezoneOffset)
              ->format('g:i a');

        $message = "Hello $recipientName, this is a reminder that you have an appointment at $time!";
        $this->_sendMessage($appointment->phoneNumber, $message);*/
        $inforeservation = ReservationsController::inforeservation($idreservation);
        $temp = $inforeservation["rappel"];
        $PrestId = $inforeservation["prestataire"];
        $ServId = $inforeservation["service"];
        $recipientName = "Haythem SAHLIA";

        /*$message = "Hello $recipientName, now we are $curtime ,this is a reminder about reservation # $idreservation .";*/
        $message = "Bonjour vous avez rendez vous avec le prestataire de services # $PrestId dans 
        $temp temps. Pour la prestation # $ServId .

        Merci d'être à l'heure à votre rdv.";
        $this->_sendMessage("+21654076876", $message);

        // changer le statut du rappel de la reservation

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
