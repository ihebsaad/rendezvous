<?php

namespace App\AvisReminders;

use Illuminate\Log;
use Carbon\Carbon;
use Twilio\Rest\Client;
use \App\Http\Controllers\ReservationsController;
use \App\Http\Controllers\UsersController;
use \App\Http\Controllers\ServicesController;
use Message;
 use Swift_Mailer;
 use Mail;
 use \App\Reservation;
class AvisReminder
{
    /**
     * Construct a new AppointmentReminder
     *
     * @param Illuminate\Support\Collection $twilioClient The client to use to query the API
     */
    public function __construct()
    {
      // lister les rendez vous d'aujourdhui
       $this->Avisdujour = ReservationsController::Avisdujour();

    }

    /**
     * Send reminders for each appointment
     *
     * @return void
     */
    public function sendReminders()
    {
        
        
        foreach ($this->Avisdujour as $resv) {
            $client = \App\User::find($resv->client);
            $prestataire = \App\User::find($resv->prestataire);
          $message = 'Merci de laisser votre avis à propos de votre prestataire : '.$prestataire->name.' '.$prestataire->lastname .' on utilisant ce <a href="https://prenezunrendezvous.com/'.$prestataire->titre.'/'.$prestataire->id.'" > lien </a>';
          $this->sendMail(trim($client->email),'Avis',$message) ;
          $numtel = $client->tel ;
          $response = Message::send([
          'to' => '21694405202',
          'text' => $message
        ]);

          Reservation::where('id', $resv->id)->update(array('avis' => 0 ));

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
    public function sendMail($to,$sujet,$contenu){

    $swiftTransport =  new \Swift_SmtpTransport( 'smtp.gmail.com', '587', 'tls');

       //$swiftTransport->setUsername('contact.prenezunrendezvous@gmail.com '); //adresse email
       //$swiftTransport->setPassword('davemarco97232'); // mot de passe email

        $swiftTransport->setUsername('prestataire.client@gmail.com'); //adresse email
        $swiftTransport->setPassword('prestataireclient2021'); // mot de passe email

        $swiftMailer = new Swift_Mailer($swiftTransport);
    Mail::setSwiftMailer($swiftMailer);
    $from=\Config::get('mail.from.address') ;
    $fromname=\Config::get('mail.from.name') ;
    
    Mail::send([], [], function ($message) use ($to,$sujet, $contenu,$from,$fromname   ) {
         $message
                 ->to($to)
                    ->subject($sujet)
                       ->setBody($contenu, 'text/html')
                    ->setFrom([$from => $fromname]);         

      });
    
  }


  


}
