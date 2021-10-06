<?php

namespace App\AppointmentReminders;

use Illuminate\Log;
use Carbon\Carbon;
use Twilio\Rest\Client;
use \App\Http\Controllers\ReservationsController;
use \App\Http\Controllers\UsersController;
use \App\Http\Controllers\ServicesController;
use Message;

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
    /*    
		// WORKING SOLUTION WITH TWILIO
		    $sid    = "ACe12debd2169cd76d0ebf9bcb76a74519";
        $token  = "1fe8926262ee2473378d1ce61fe09c26";
        $this->sendingNumber = '+13347589498';
        $this->twilioClient = new Client($sid, $token);*/
    }

    /**
     * Send reminders for each appointment
     *
     * @return void
     */
    public function sendReminders()
    {
        //$ttt ="";
        
        foreach ($this->resvdujour as $resv) {

            // verifier fuseau horaire
          $infoprest = UsersController::infouser($resv->prestataire);
          $fhoraire = $infoprest['fhoraire'];
          date_default_timezone_set($fhoraire);

          $currenttime = date('H:i');
          // extraction et conversion du time date_reservation
          /*$date1=$resv->date_reservation;
          $format = 'Y-m-d H:i';
          $dateresv = DateTime::createFromFormat($format, $date1);
          $heureresv= $dateresv->format('H:i');*/
          $heureresv = Carbon::createFromFormat('Y-m-d H:i:s', $resv->date_reservation)->format('H:i');
            // initiation de maxTRappel 
            // calcule temps max du rappel
            if ($resv->rappel === "60") {
                //$maxTRappel = date("H:i", strtotime('-30 minutes', "$heureresv"));
                $maxTRappel = Carbon::parse($heureresv)->subMinutes(60)->format('H:i');
            }
            elseif ($resv->rappel === "120") {
                //$maxTRappel = date("H:i", strtotime('-60 minutes', "$heureresv"));
                $maxTRappel = Carbon::parse($heureresv)->subMinutes(120)->format('H:i');
            }
            elseif ($resv->rappel === "180") {
                //$maxTRappel = date("H:i", strtotime('-120 minutes', "$heureresv"));
                $maxTRappel = Carbon::parse($heureresv)->subMinutes(180)->format('H:i');
            }
            elseif (($resv->rappel === "1440") ||  ($resv->rappel === "2880") || ($resv->rappel === "7200")) {
                $maxTRappel = $heureresv;
            }
            // verifier si c'est le temps du rappel (>= temps rappel) et le rappel non envoyé et la réservation est payée
            if ((strtotime($currenttime) >= strtotime($maxTRappel)) && ($resv->rappel_statut == 0) && ($resv->paiement == 1))
            {    
                //envoyer rappel SMS
                $this->_remindAbout($resv->id,$currenttime,$heureresv);
                // changer statut rappel
                ReservationsController::changestatutrappel($resv->id);
            }
            
            //$ttt = $ttt .$currenttime. " / " . $resv->id . "  --  ";
        }

        /*$response = Message::send([
          'to' => '21622956876',
          'text' => $ttt
        ]);*/
        
    }

    /**
     * Sends a message for an appointment
     *
     * @param Appointment $appointment The appointment to remind
     *
     * @return void
     */
    //hs private function _remindAbout($appointment)
    private function _remindAbout($idreservation,$curtime,$heureresv)
    {
        /*hs $recipientName = $appointment->name;
        $time = Carbon::parse($appointment->when, 'UTC')
              ->subMinutes($appointment->timezoneOffset)
              ->format('g:i a');

        $message = "Hello $recipientName, this is a reminder that you have an appointment at $time!";
        $this->_sendMessage($appointment->phoneNumber, $message);*/
        $inforeservation = ReservationsController::inforeservation($idreservation);
        $temp = $inforeservation["rappel"];

        $CltId = $inforeservation["client"];
        $PrestId = $inforeservation["prestataire"];
        $ServId = $inforeservation["service"];
        
        // info client
        $infoclient = UsersController::infouser($CltId);
        $numtel = $infoclient['tel'];
        $cltname = $infoclient['name']." ".$infoclient['lastname'];
        // info prestataire
        $infoprest = UsersController::infouser($PrestId);
        $titreprest = $infoprest['titre'];
        // info prestation
        $infprests = rtrim($inforeservation['nom_serv_res'], ", ");
        if (strpos($infprests, ',') !== FALSE)
        {
          $titrprest ="les prestations";
          
        }
        else {
          $titrprest ="la prestation";
        }
        /*$infoserv = ServicesController::infoservice($ServId);
        $titreserv = $infoserv['nom'];*/
        
        if (! is_null($numtel))
        {
            // message à afficher pour temps
            $msgtemp="";
                if ($temp === "60") {
                    $msgtemp = "dans une heure";
                }
                elseif ($temp === "120") {
                    $msgtemp = "dans deux heures";
                }
                elseif ($temp === "180") {
                    $msgtemp = "dans trois heures";
                }
                // condition avant un jour
                if ($temp === "1440") {
                    $msgtemp = "demain à ".$heureresv;
                }
                // condition avant deux jours
                if ($temp === "2880") {
                    $msgtemp = "dans deux jours à ".$heureresv;
                }
                // condition avant cinq jours
                if ($temp === "7200") {
                    $msgtemp = "dans cinq jours à ".$heureresv;
                }
                // changer compte twilio officiel
                // ajouter condition reservation payé

        /*$message = "Hello $recipientName, now we are $curtime ,this is a reminder about reservation # $idreservation .";*/
$message = "Bonjour $cltname, vous avez rendez vous avec le prestataire de services $titreprest $msgtemp. Pour $titrprest: $infprests.

Merci d'être à l'heure à votre rdv.";
        /*
        // TWILIO WORKING SOLUTION
        $this->_sendMessage($numtel, $message);
        */
        $response = Message::send([
          'to' => '21694405202',
          'text' => $message
        ]);

        }

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
