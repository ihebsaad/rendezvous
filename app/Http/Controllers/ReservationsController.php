<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Session;
use \App\User;
use \App\Reservation;
use \App\Payment;
use \App\Alerte;
 
 use Swift_Mailer;
 use Mail;

class ReservationsController extends Controller
{


     public function __construct()
    {
        $this->middleware('auth');
    }

		
    public function index()
    {
		
		  $cuser = auth()->user();
		if($cuser->user_type=='prestataire' ){
        $reservations = Reservation::where('prestataire',$cuser->id)->get();
		}
		if($cuser->user_type=='client' ){
        $reservations = Reservation::where('client',$cuser->id)->get();
		}
		
		if($cuser->user_type=='admin' ){
        $reservations = Reservation::get();
		}	

		//$this->sendMail('ihebsaad@gmail.com','Test','test Hello world')	;
        return view('reservations.index', compact('reservations'));


    }
  

		
	public function add(Request $request)
	{
		$user=$request->get('user');
		 $reservation  = new Reservation([
              'client' => $request->get('client'),
              'prestataire' => $request->get('prestataire'),
              'service' => $request->get('service'),
              'date' => $request->get('date'),
              'heure' => $request->get('heure'),
              'adultes' => $request->get('adultes'),
              'enfants' => $request->get('enfants'),
              'remarques' => $request->get('remarques'),
              'rappel' => $request->get('rappel'),
            ]);
 
        $reservation->save();
		
		$client = \App\User::where('id' ,$request->get('client'))->get();
		$prestataire = \App\User::where('id' ,$request->get('prestataire'))->get();
		$service = \App\Service::where('id' ,$request->get('service'))->get();
		
		// Email prestataire
		$message='';
		$message.='Vous avez une nouvelle réservation <br>Veillez la confirmer dans votre Tableau de bord.';
		$message.='<b>Service :</b>  '.$service->nom.'  - ('.$service->prix.' )  <br>';
		$message.='<b>Date :</b> '.$request->get('date').'Heure : '.$request->get('heure').'<br>';
		$message.='<b>Client :</b> '.$client->name.' '.$client->lastname .'<br>';
		$message.='<b><a href="https://prenezunrendezvous.com/" > prenezunrendezvous.com </a></b>';	
		
	    $this->sendMail(trim($prestataire->email),'Nouvelle Réservation',$message)	;
		
		$alerte = new Alerte([
             'user' => $prestataire->id,
			 'titre'=>'Nouvelle Réservation',
             'details' => $message,
         ]);	
		 $alerte->save();
		 
		// Email Client
		$message='';
		$message.='Votre réservation est enregsitrée avec succès. Veillez attendre la confirmation du prestatire.<br>';
		$message.='<b>Service :</b>  '.$service->nom.'  - ('.$service->prix.' )  <br>';
		$message.='<b>Date :</b> '.$request->get('date').'Heure : '.$request->get('heure').'<br>';
		$message.='<b>Client :</b> '.$client->name.' '.$client->lastname .'<br>';
		$message.='<b><a href="https://prenezunrendezvous.com/" > prenezunrendezvous.com </a></b>';
		
	    $this->sendMail(trim($client->email),'Nouvelle Réservation',$message)	;
		$alerte = new Alerte([
             'user' => $client->id,
			 'titre'=>'Nouvelle Réservation',						 
             'details' => $message,
         ]);	
		 $alerte->save();
		 
		 
    return $reservation->id;
		 

 	}
	
	public function store(Request $request)
	{
		/* $reservation  = new Reservation([
              'user' => $request->get('user'),
              'question' => $request->get('question'),
              'reponse' => $request->get('reponse'),
            ]);

        $reservation->save();
 */
 	}
  

    public function updating(Request $request)
    {
        $id= $request->get('reservation');
        $champ= strval($request->get('champ'));
        $val= strval($request->get('val'));
    
          Reservation::where('id', $id)->update(array($champ => $val));

    }


	
     public function remove($id)
    {
  
	 
	DB::table('reservations')->where('id', $id)->delete();
	return redirect ('/reservations');

	}
	
  	    public static function  ChampById($champ,$id)
    {
        $reservation = Reservation::find($id);
        if (isset($reservation[$champ])) {
            return $reservation[$champ] ;
        }else{return '';}

    }
	
  
  
      public function valider($id)
    {
     
          Reservation::where('id', $id)->update(array('statut' => 1 ));
		  $reservation = \App\User::where('id' ,$id)->get();
		  $client = \App\User::where('id' ,$reservation->client )->get();

		// Email prestataire
		$message='';
		$message.='Vtre rendez vous est confirmé par le prestataire.<br>';
		$message.='<b>Service :</b>  '.$service->nom.'  - ('.$service->prix.' )  <br>';
		$message.='<b>Date :</b> '.$request->get('date').'Heure : '.$request->get('heure').'<br>';
 		$message.='<b><a href="https://prenezunrendezvous.com/" > prenezunrendezvous.com </a></b>';	
		
	    $this->sendMail(trim($client->email),'Réservation validée',$message)	;

		 $alerte = new Alerte([
             'user' => $client->id,
			 'titre'=>'Réservation validée',
             'details' => $message,
         ]);	
		 $alerte->save();
		 
       return redirect('/reservations')->with('success', 'Réservation Validée  ');

    }

	  
      public function annuler($id)
    {
 		
        Reservation::where('id', $id)->update(array('statut' => 2 ));
		
	  // envoi email annulation
		$reservation = \App\User::where('id' ,$id)->get();
		  $client = \App\User::where('id' ,$reservation->client )->get();

		// Email prestataire
		$message='';
		$message.='Vtre rendez vous est annulée par le prestataire.<br>';
		$message.='<b>Service :</b>  '.$service->nom.'  - ('.$service->prix.' )  <br>';
		$message.='<b>Date :</b> '.$request->get('date').'Heure : '.$request->get('heure').'<br>';
 		$message.='<b><a href="https://prenezunrendezvous.com/" > prenezunrendezvous.com </a></b>';	
		
	    $this->sendMail(trim($client->email),'Réservation annulée',$message)	;
		
		$alerte = new Alerte([
             'user' => $client->id,
			 'titre'=>'Réservation annulée',			 
             'details' => $message,
         ]);	
		 $alerte->save();
		 
		 
       return redirect('/reservations')->with('success', 'Réservation Anunulée  ');

    }
	
	
		public function sendmessage(Request $request){
			
		  $prestataire= $request->get('prestataire');
		  $message= $request->get('contenu');
		  $emetteur= $request->get('emetteur');
		  $to= $request->get('to');
		  $email= $request->get('email');
		  $tel= $request->get('tel');

		  $Message='';
		  $Message.='Nouveau message envoyé par : '. $emetteur.'<br>';
		  $Message.='Email : '. $email .' Tel :'.$tel.'<br>';
		  $Message.='Message : '.$message.'<br>';
		  $Message.='<b><a href="https://prenezunrendezvous.com/" > prenezunrendezvous.com </a></b>';	

			
		  $this->sendMail(trim($to),'Nouveau Message',$Message)	;
		  $alerte = new Alerte([
             'user' => $prestatire->id,
			 'titre'=>'Message envoyé',			 
             'details' => $Message,
         ]);	
		 $alerte->save();
		 
		 
		}
		
		
		
	public function sendMail($to,$sujet,$contenu){

		$swiftTransport =  new \Swift_SmtpTransport( 'smtp.gmail.com', '587', 'tls');
        $swiftTransport->setUsername(\Config::get('mail.username')); //adresse email
        $swiftTransport->setPassword(\Config::get('mail.password')); // mot de passe email

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
