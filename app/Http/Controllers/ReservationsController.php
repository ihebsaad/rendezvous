<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Session;
use \App\User;
use \App\Reservation;

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
		
		// Email admin
		
		// mail Client
		
    return $reservation->id;
		 

 	}
	
	public function store(Request $request)
	{
		 $reservation  = new Reservation([
              'user' => $request->get('user'),
              'question' => $request->get('question'),
              'reponse' => $request->get('reponse'),
            ]);

        $reservation->save();
 
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
		  
		  // envoi email validation
		  
       return redirect('/reservations')->with('success', 'Réservation Validée  ');

    }

	  
      public function annuler($id)
    {
 		
        Reservation::where('id', $id)->update(array('statut' => 2 ));
		
	  // envoi email annulation

       return redirect('/reservations')->with('success', 'Réservation Anunulée  ');

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
