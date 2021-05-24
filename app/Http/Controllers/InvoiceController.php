<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Route;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Session;
use \App\User;
use \App\Reservation;
use \App\Payment;
use \App\Alerte;
use \App\Cartefidelite;
use \App\Codepromo;
use \App\Service;
use \App\Happyhour;
use \App\ServiceSupp;
use \App\Newdate;
use \App\Client_product;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;
 
 use Swift_Mailer;
 use Mail;
 

 use DateTime;

class InvoiceController extends Controller
{


 
	    public function __construct()
    {
//        $this->middleware('auth');
    }
    public function Facture(Request $request,$id)
  {
  	if (Auth::guest()){
        Session::put('msgs', 'E1');
        
            return redirect('/');
      }
    $cuser = auth()->user();
    dd($cuser);
    $reservation = Reservation::where('id',$id)->first();
      
    if($cuser->id!=$reservation->client){
      Session::put('msgs', 'E2');
      return redirect('/');

    }
    $prestataire=User::find($reservation->prestataire);
    $client=User::find($reservation->client);

    	$date = new DateTime($reservation->date_reservation);
		$date = $date->format('d-m-Y');
		$today = new DateTime();
		$today = $today->format('d-m-Y');
		

		$heure = new DateTime($reservation->date_reservation);
		$heure = $heure->format('H:i');
		$prestataire =''.$prestataire->name.' '.$prestataire->lastname .'';
		$emailPaypal =$client->emailPaypal;
		$emailclient = $client->email;
		$client =''.$client->name.' '.$client->lastname .'';

    //dd($nbrReport);
    	return view("Invoice.index", compact('reservation','date','heure','prestataire','client','emailclient','emailPaypal'));
     

  }
  

  
	
  
 }
