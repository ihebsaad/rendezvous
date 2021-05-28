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
use \App\Produit;
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

class ReservationsController extends Controller
{
    // public $client;

     public function __construct()
    {
        //$this->middleware('auth');
       
       if(Route::current()->action['as']=='validation' || Route::current()->action['as']=='reservations.changeDate'  || Route::current()->action['as']=='oauthCallback' || Route::current()->action['as']=='reservations.AnnulerRes' )
       {
   
        if(Route::current()->action['as']=='reservations.AnnulerRes')
        {
        	$id = Input::get('idReservation');
            Session::put('idres', $id);
        }

        if(Route::current()->action['as']=='reservations.changeDate')
        {
        	$id = Input::get('idres');
            Session::put('idres', $id);
        }

       	if(Route::current()->action['as']=='validation' || Route::current()->action['as']=='annul'  )
       	{
           $id = Route::current()->parameters['id'];
           Session::put('idres', $id);
           //dd(Session::get('idres'));
       	}
       	else
       	{
          $id = Session::get('idres');
         // dd($id);
       	}

       
       
         $idprest=Reservation::find($id)->prestataire;
         $prest=User::find($idprest);
         //dd($prest->google_path_json);
         if($prest->google_path_json)
        {
        $client = new Google_Client();
        $client->setAuthConfig('storage/googlecalendar/'.$prest->google_path_json);
        $client->addScope(Google_Service_Calendar::CALENDAR);
        $client->setAccessType('offline');

        $guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false)));
        $client->setHttpClient($guzzleClient);
        $this->client = $client;
         }
      //  dd( $this->client);
        }
    }

	public function modifier($id)
    {
       
      if (Auth::guest()){
        Session::put('msgs', 'E1');
        
            return redirect('/');
      }
    $cuser = auth()->user();
    $reservation = Reservation::where('id',$id)->first();
      
    if($cuser->id!=$reservation->client){
      Session::put('msgs', 'E2');
      return redirect('/');

    }



    	//dd($reservation);
    	$prestataire=User::find($reservation->prestataire);
    	$date = new DateTime($reservation->date_reservation);
		$date = $date->format('d-m-Y');
		$today = new DateTime();
		$today = $today->format('d-m-Y');
		$posible = strtotime($today. ' + 5 days')<strtotime($date);

		$heure = new DateTime($reservation->date_reservation);
		$heure = $heure->format('H:i');
		$name =''.$prestataire->name.' '.$prestataire->lastname .'';
    $nbrReport = $reservation->nbrReport;
    //dd($nbrReport);
    	return view("reservations.modif_reservation", compact('reservation','date','heure','name','posible','nbrReport'));
    }
    public function reporter(Request $request)
    {
      $idReservation = $request->get('idReservation');
      $Reservation = Reservation::where('id',$idReservation)->first();
      $nbrReport = $Reservation ->nbrReport;
      Reservation::where('id', $idReservation)->update(array('nbrReport' => $nbrReport+1 ));
 

    	
    	$Reservation = Reservation::where('id',$idReservation)->first();
    	//dd($Reservation);
    	$client=User::find($Reservation->client);
    	$date = new DateTime($Reservation->date_reservation);
		$date = $date->format('d-m-Y');
		$heure = new DateTime($Reservation->date_reservation);
		$heure = $heure->format('H:i');
		$prestataire=User::find($Reservation->prestataire);
$idproduits = DB::select( DB::raw("SELECT id_products as ids , quantity as qty FROM client_products s WHERE s.id_reservation='+$Reservation->id+'" ) );               if (is_array($Reservation->services_reserves)) {
                        $servicesres = $Reservation->services_reserves;
                      }else {
                        $servicesres = json_encode($Reservation->services_reserves);
                      }  
		// Email au prest
		$message='Bonjour,<br>';
		$message.='Votre client '.$client->name.' '.$client->lastname.' veut reporter son rdv .<br>';
		//$message.='<b>Service :</b>  '.$Reservation->nom_serv_res.'  - ('.$Reservation->Net.' €)  <br>';
    $message.='<b>Services :</b>  ';
          foreach ($servicesres as $servicesre) {
         // echo $servicesres;
        $message.=  DB::table('services')->where('id', $servicesre )->value('nom');
         $message.=" ( ".DB::table('services')->where('id', $servicesre )->value('prix')."€ )";
         
         if ($reservation->recurrent==1) {
        $message.= " <b>abonnement</b>" ;
      }
      $message.= ", ";
      }


        $message.='<br><b>Produits :</b>  ';
          foreach ($idproduits as $idp) {

               $message.=  ' '.DB::table('produits')->where('id', $idp->ids )->value('nom_produit').'';
               $message.=  '( Quantité:'.$idp->qty.',';
               $message.= ' Prix:'.DB::table('produits')->where('id', $idp->ids )->value('prix_unité')."€ )";
               $message.= ", ";
              } 
              if ($Reservation->serv_suppl != null) {
               $message.='<br><b>Cadeaux :</b>  '.$Reservation->serv_suppl.'';
              }



		$message.='<b>Date :</b> '.$date .' Heure : '.$heure .'<br>';
		$message.='Merci de proposer maximum 15 dates avec des horaires qui vous conviennent. 
		(<a href="https://prenezunrendezvous.com/reservations/newDate/'.$Reservation->id.'" > Lien </a>). <br>';
		
		$message.='<b><a href="https://prenezunrendezvous.com/" > prenezunrendezvous.com </a></b>';


		
 	    $this->sendMail(trim($prestataire->email),'Reporter un rendez-vous',$message)	;


    	
    	return "ok";
    }	
    public function newDate($id)
    {
      if (Auth::guest()){
        Session::put('msgs', 'E1');
        
            return redirect('/');
      }
    $cuser = auth()->user();
    $reservation = Reservation::where('id',$id)->first();
      
    if($cuser->id!=$reservation->prestataire){
      Session::put('msgs', 'E2');
      return redirect('/');

    }

    	$Newdates = Newdate::where('idres',$id)->get();
    	//dd($reservation);
    	$prestataire=User::find($reservation->prestataire);
    	$date = new DateTime($reservation->date_reservation);
		$date = $date->format('d-m-Y');
		$today = new DateTime();
		$today = $today->format('d-m-Y');
		$posible = strtotime($today. ' + 5 days')<strtotime($date);

		$heure = new DateTime($reservation->date_reservation);
		$heure = $heure->format('H:i');
		$name =''.$prestataire->name.' '.$prestataire->lastname .'';
    	return view("reservations.newDateReservation", compact('reservation','date','heure','name','Newdates'));
    }
    public function Addnewdate(Request $request)
    {
    	$Newdates = Newdate::where('idres',$request->get('idres'))->get();
    	if (count($Newdates)<15) {
    	
    	$date = $request->get('date');
    	
    	$reservation = Reservation::where('id',$request->get('idres'))->first();
    	$reservation  = new Newdate([
              'client' => $reservation->client,
              'prestataire' => $reservation->prestataire,
              'date' => $date,
              'idres'=> $request->get('idres'),
              
            ]);
      
		$reservation->save();
    $idr =$reservation->id;

    	return $idr;
    }else
    {
    	return 0;
    }

    }
    public function deletenewdate(Request $request)
    {
      DB::table('newdates')->where('id', $request->get('dateId'))->delete();
    }
    public function sendnewdate(Request $request)
    {
    	
    	$idReservation = $request->get('idres');
    	$Reservation = Reservation::where('id',$idReservation)->first();
    	//dd($Reservation);
    	$client=User::find($Reservation->client);
    	$date = new DateTime($Reservation->date_reservation);
		$date = $date->format('d-m-Y');
		$heure = new DateTime($Reservation->date_reservation);
		$heure = $heure->format('H:i');
		$prestataire=User::find($Reservation->prestataire);
$idproduits = DB::select( DB::raw("SELECT id_products as ids , quantity as qty FROM client_products s WHERE s.id_reservation='+$Reservation->id+'" ) );               if (is_array($Reservation->services_reserves)) {
                        $servicesres = $Reservation->services_reserves;
                      }else {
                        $servicesres = json_encode($Reservation->services_reserves);
                      }  
		// Email au client
		$message='Bonjour,<br>';
		$message.='Pour le rendez-vous prévue du  '.$date .' à '.$heure .'  avec les services: ';
    //$message.='<b>Services :</b>  ';
          foreach ($servicesres as $servicesre) {
         // echo $servicesres;
        $message.=  DB::table('services')->where('id', $servicesre )->value('nom');
         $message.=" ( ".DB::table('services')->where('id', $servicesre )->value('prix')."€ )";
         
         if ($Reservation->recurrent==1) {
        $message.= " <b>abonnement</b>" ;
      }
      $message.= ", ";
      }


        $message.='et les Produits :  ';
          foreach ($idproduits as $idp) {

               $message.=  ' '.DB::table('produits')->where('id', $idp->ids )->value('nom_produit').'';
               $message.=  '( Quantité:'.$idp->qty.',';
               $message.= ' Prix'.DB::table('produits')->where('id', $idp->ids )->value('prix_unité')."€ )";
               $message.= ", ";
              } 
              if ($Reservation->serv_suppl != null) {
               $message.='( <b>Cadeaux :</b>  '.$Reservation->serv_suppl.'):';
              }
    $message.=' <b>Total :</b> '.$Reservation->Net.'';
		$message.='<br>votre prestataire <a href="https://prenezunrendezvous.com/'.$prestataire->titre.'/'.$prestataire->id.'" > '.$prestataire->name.' '.$prestataire->lastname .' </a> a vous proposé des nouvelles dates. <br>';
		$message.='Merci de choisir une seule date :  
		(<a href="https://prenezunrendezvous.com/reservations/selectdate/'.$Reservation->id.'" > Lien </a>). <br>';
		
		$message.='<b><a href="https://prenezunrendezvous.com/" > prenezunrendezvous.com </a></b>';

        $alerte = new Alerte([
             'user' => $client->id,
			 'titre'=>'Nouvelle date de prestation',
             'details' => $message,
         ]);	
		 $alerte->save();
		
 	    $this->sendMail(trim($client->email),'report du rendez-vous',$message)	;

 	     

 	    return "ok";

    }
    public function selectdate($id)
   {

    	$Newdates = Newdate::where('idres',$id)->get();
    	$reservation = Reservation::where('id',$id)->first();
    	//dd($reservation);
    	$prestataire=User::find($reservation->prestataire);
    	$date = new DateTime($reservation->date_reservation);
		$date = $date->format('d-m-Y');
		$today = new DateTime();
		$today = $today->format('d-m-Y');
		$posible = strtotime($today. ' + 5 days')<strtotime($date);

		$heure = new DateTime($reservation->date_reservation);
		$heure = $heure->format('H:i');
		$name =''.$prestataire->name.' '.$prestataire->lastname .'';
    	return view("reservations.selectDateReservation", compact('reservation','date','heure','name','Newdates'));
    }
    // report d'une date par le client	
    public function changeDate(Request $request)
    {
    	$idReservation = $request->get('idres');
    	$date = $request->get('date');
    	Reservation::where('id', $idReservation)->update(array('date_reservation' => $date ,'statut'=>1));

    	$Reservation = Reservation::where('id',$idReservation)->first();
    	//dd($Reservation);
    	$client=User::find($Reservation->client);
    	$date = new DateTime($Reservation->date_reservation);
		$date = $date->format('d-m-Y');
		$heure = new DateTime($Reservation->date_reservation);
		$heure = $heure->format('H:i');
		$prestataire=User::find($Reservation->prestataire);

    	// Email au prestataire
		$message='Bonjour,<br>';
		$message.='Votre client '.$client->name.' '.$client->lastname.' a choisi une nouvelle date :  '.$date .' à '.$heure .' .<br>';
		$message.='<b>Service :</b>  '.$Reservation->nom_serv_res.'  - ('.$Reservation->Net.' €)  <br>';
		
		$message.='<b><a href="https://prenezunrendezvous.com/" > prenezunrendezvous.com </a></b>';


		
 	    $this->sendMail(trim($prestataire->email),'Rendez-vous reporté',$message)	;

$idproduits = DB::select( DB::raw("SELECT id_products as ids , quantity as qty FROM client_products s WHERE s.id_reservation='+$Reservation->id+'" ) );               if (is_array($Reservation->services_reserves)) {
                        $servicesres = $Reservation->services_reserves;
                      }else {
                        $servicesres = json_encode($Reservation->services_reserves);
                      } 

 	    // Email au client
		$message='Bonjour,<br>';
		//$message.='Réservation('.$titre.') payée avec succès <br>';
		$message.='Votre rendez-vous  est confirmé le <b>'.$date .'</b> à <b>'.$heure .'</b> avec le prestataire <a href="https://prenezunrendezvous.com/'.$prestataire->titre.'/'.$prestataire->id.'" > '.$prestataire->name.' '.$prestataire->lastname .' </a>. <br>';
		//$message.='<b>Service :</b>  '.$Reservation->nom_serv_res.'  - ('.$Reservation->Net.' €)  <br><br><br>';
    $message.='<b>Services :</b>  ';
          foreach ($servicesres as $servicesre) {
         // echo $servicesres;
        $message.=  DB::table('services')->where('id', $servicesre )->value('nom');
         $message.=" ( ".DB::table('services')->where('id', $servicesre )->value('prix')."€ )";
         
         if ($Reservation->recurrent==1) {
        $message.= " <b>abonnement</b>" ;
      }
      $message.= ", ";
      }


        $message.='<br><b>Produits :</b>  ';
          foreach ($idproduits as $idp) {

               $message.=  ' '.DB::table('produits')->where('id', $idp->ids )->value('nom_produit').'';
               $message.=  '( Quantité:'.$idp->qty.',';
               $message.= ' Prix:'.DB::table('produits')->where('id', $idp->ids )->value('prix_unité')."€ )";
               $message.= ", ";
              } 
              if ($Reservation->serv_suppl != null) {
               $message.='<br><b>Cadeaux :</b>  '.$Reservation->serv_suppl.'';
              }
              

              
        $message.='<br><br>Vous pouvez consulter votre facture à partir de ce lien. 
        (<a href="https://prenezunrendezvous.com/reservations/facture/'.$Reservation->id.'" > Lien </a>). <br><br><br>';
			
		$message.='<b>ATTENTION :</b> <br>';	
		$message.='-Vous avez le droit d`annuler ou de reporter le rendez-vous 5 jours avant le rdv. 
		(<a href="https://prenezunrendezvous.com/reservations/modifier/'.$Reservation->id.'" > Lien </a>). <br>';
		$message.='-Au delà des 5 jours avant le rendez vous votre accompte ne sera pas remboursé.  <br>';
		$message.='-Au delà des 5 jours, Il vous sera impossible d`annuler ou de reporter le rendez-vous.  <br>';
		$message.='-Vous n`êtes pas venu au rendez-vous  pour x raison, votre accompte ne sera pas remboursé <br>car malheureusement beaucoup trop de clients prennent des rendez-vous et ne vienne pas sans prévenir et cela chamboule toute notre journée. <br> Merci d`avance d`être présent à votre rendez-vous et merci de votre compréhension. <br>';
		$message.='<b><a href="https://prenezunrendezvous.com/" > prenezunrendezvous.com </a></b>';


		
 	    $this->sendMail(trim($client->email),'Rendez-vous reporté',$message)	;

 	    // ------------------Update l'évenement dans google calendar------------------------------------

  if($prestataire->google_path_json && $prestataire->google_access_token && $prestataire->google_refresh_token)
   {
      //voir si la réservation est récurrente ou non
        $liste_rec= array();
        $reservation=$Reservation;
        $idevent=$reservation->id_event_google_cal;

        if($idevent)
        {

        	 $param=User::where('id',$prestataire->id)->first();
             $access_token=$param->google_access_token;

           if(isset($access_token) && $access_token)
            {   

              $this->client->setAccessToken($access_token);
              if ($this->client->isAccessTokenExpired()) {
              $this->client->refreshToken($param->google_refresh_token);
              }

            $service = new Google_Service_Calendar($this->client);

        	$debut=$reservation->date_reservation;
        	$debut=str_replace(' ','T',$debut);
        	//$maxduree=0;
        	//$service_duree="01:00";
        	foreach ($reservation->services_reserves as $sr) { 
			$serv=Service::where('id',$sr)->first(["nom","duree","NbrService"]);
            /*$intduree=intval(strval(str_replace(':','',$serv->duree)));
            if($intduree>$maxduree)
            {
             $maxduree=$intduree;
             $service_duree=$serv->duree;
            }*/
	        $hour=substr($serv->duree, 0, 2);
	        $minutes=substr($serv->duree,3,2);	     
	        }
           // $hour=substr($service_duree, 0, 2);
	        //$minutes=substr($service_duree,3,2);

	        $fin=date('Y-m-d H:i:s',strtotime('+'.$hour.' hours +'.$minutes.' minutes',strtotime($debut)));
	        $fin=str_replace(' ','T', $fin);

	        // update times
	        $startDate = date("Y-m-d", strtotime($debut));
            $startTime = date("H:i", strtotime($debut));
            $idevent=Reservation::where('id',$reservation->id)->first()->id_event_google_cal;
            $event = $service->events->get('primary',  $idevent);
            $start = new Google_Service_Calendar_EventDateTime();
            $start->setDateTime($startDate.'T'.$startTime.':00.000+01:00');
           // $start->setTimeZone('Africa/Tunis');
	        $event->setStart($start);
	       $endDate = date("Y-m-d", strtotime($fin));
           $endTime = date("H:i", strtotime($fin));
	       $end = new Google_Service_Calendar_EventDateTime();
	       $end->setDateTime($endDate.'T'.$endTime.':00.000+01:00');
	       //$end->setTimeZone('Africa/Tunis');
	       $event->setEnd($end);
           $updatedEvent = $service->events->update('primary', $event->getId(), $event);
          }
	        //
        }// fin test idevent


    }// fin if ( file json et les tokens existe)

   // --------------------fin update au google calendar ----------------------------------------------------

    	return $date ;
    }

    // réservation annulée par le client	
    public function AnnulerRes(Request $request)
   {
   	Reservation::where('id', $request->get('idReservation'))->update(array('statut' => 2 ));
   		$idReservation = $request->get('idReservation');
    	$date = $request->get('date');

    	$Reservation = Reservation::where('id',$idReservation)->first();
    	//dd($Reservation);
    	$client=User::find($Reservation->client);
    	$date = new DateTime($Reservation->date_reservation);
		$date = $date->format('d-m-Y');
		$heure = new DateTime($Reservation->date_reservation);
		$heure = $heure->format('H:i');
		$prestataire=User::find($Reservation->prestataire);
   	//dd("ok");
    $idproduits = DB::select( DB::raw("SELECT id_products as ids , quantity as qty FROM client_products s WHERE s.id_reservation='+$Reservation->id+'" ) );               if (is_array($Reservation->services_reserves)) {
                        $servicesres = $Reservation->services_reserves;
                      }else {
                        $servicesres = json_encode($Reservation->services_reserves);
                      }  
   	// Email au client
		$message='Bonjour,<br>';
		$message.='le rendez-vous prévue du  '.$date .' à '.$heure .'  avec les services:';
      foreach ($servicesres as $servicesre) {
         // echo $servicesres;
        $message.=  DB::table('services')->where('id', $servicesre )->value('nom');
         $message.=" ( ".DB::table('services')->where('id', $servicesre )->value('prix')."€ )";
         
         if ($reservation->recurrent==1) {
        $message.= " <b>abonnement</b>" ;
      }
      $message.= ", ";
      }


        $message.='et les Produits :  ';
          foreach ($idproduits as $idp) {

               $message.=  ' '.DB::table('produits')->where('id', $idp->ids )->value('nom_produit').'';
               $message.=  '( Quantité:'.$idp->qty.',';
               $message.= ' Prix:'.DB::table('produits')->where('id', $idp->ids )->value('prix_unité')."€ )";
               $message.= ", ";
              } 
              if ($Reservation->serv_suppl != null) {
               $message.='( <b>Cadeaux :</b>  '.$Reservation->serv_suppl.'):';
              }
    $message.=' <b>Total :</b> '.$Reservation->Net.'';
    $message.='a été annulé par votre client '.$client->name.' '.$client->lastname.' .<br>';
			
		$message.='Merci de lui remettre l`acompte. (<a href="https://prenezunrendezvous.com/reservations/AnnulerReservation/'.$Reservation->id.'" > Lien </a>) <br>';	
		
		$message.='<b><a href="https://prenezunrendezvous.com/" > prenezunrendezvous.com </a></b>';

		
 	    $this->sendMail(trim($prestataire->email),'Réservation annulée',$message);

     	
    	return "ko";
    }
    
    public function AnnulerReservation($id)
   {
    if (Auth::guest()){
        Session::put('msgs', 'E1');
        
            return redirect('/');
      }
    $cuser = auth()->user();
    $reservation = Reservation::where('id',$id)->first();
      
    if($cuser->id!=$reservation->prestataire){
      Session::put('msgs', 'E2');
      return redirect('/');

    }
   	$idres=$id;
   
    	
    	return view('reservations.annuler_reservation', compact('idres'));
    }		
    public function index()
    {
		
		$cuser = auth()->user();
		//dd($cuser->id);
		if($cuser->user_type=='prestataire' ){
		//dd($cuser->id);
		 //$reservations = Reservation::orderBy('id', 'DESC')->where('prestataire',$cuser->id)->whereNull('id_recc')
        //->get();
       $reservations = DB::table('reservations')->where('prestataire',$cuser->id)->whereNull('id_recc')->get();
		}
		if($cuser->user_type=='client' ){
        $reservations = Reservation::where('client',$cuser->id)->whereNull('id_recc')->get();
		}
		
		if($cuser->user_type=='admin' ){
        $reservations = Reservation::whereNull('id_recc')->get();
		}	
		 /*$reservations=$reservations->sortBy(function($t)
                                        {
                                            return $t->id;
                                        })->reverse();*/
        //dd( $reservations);
		//$this->sendMail('ihebsaad@gmail.com','Test','test Hello world')	;
        return view('reservations.index', compact('reservations'));


    }

    public static function reservationsdujour()
    {
		
        $today=date('Y-m-d');
        $TomorrowD = new DateTime('tomorrow');
		$FTomorrowD = $TomorrowD->format('Y-m-d');
		$aftertwodays = date('Y-m-d', strtotime($today. ' + 2 days'));
		$afterfivedays = date('Y-m-d', strtotime($today. ' + 5 days'));
        // reservations du ce jour ou de demain avec un rappel avant un jour
        //$reservations = Reservation::where('date',$today)->get();
        $reservations = DB::table('reservations')
            ->whereDate('date_reservation', '=', $today)
            ->where(function ($querry) {
            	$querry->where('rappel', '=', '60')
	            ->orWhere('rappel', '=', '120')
	            ->orWhere('rappel', '=', '180');
			})
            ->orWhere(function ($query) use($FTomorrowD){
                $query->whereDate('date_reservation', '=', $FTomorrowD)
                      ->where('rappel', '=', '1440');
            })
            ->orWhere(function ($queery) use($aftertwodays){
                $queery->whereDate('date_reservation', '=', $aftertwodays)
                      ->where('rappel', '=', '2880');
            })
            ->orWhere(function ($quuery) use($afterfivedays){
                $quuery->whereDate('date_reservation', '=', $afterfivedays)
                      ->where('rappel', '=', '7200');
            })
            ->get();

        return $reservations;


    }
    public static function changestatutrappel($id)
    {
    	Reservation::where('id', $id)->update(array('rappel_statut' => 1 ));
    }
  
    public static function inforeservation($id)
    {
    	$inforeserv=Reservation::find($id);
    	return $inforeserv;
    }
    public function addServiceRecurrent(Request $request)
	{
		$Allreduction = "";
		$listcodepromo=$request->get('listcodepromo');
		if ($listcodepromo != null) {
		for ($i=0; $i < sizeof($listcodepromo) ; $i++) { 
			
		$code = Codepromo::where('code',$listcodepromo[$i])->first();
		$serviceId = $code->id_service ;
        $service = Service::where('id',$serviceId)->first();
        $serviceNom = $service->nom ;
        $reducPromo = $code->reduction ;
        $Allreduction = $Allreduction."Code promo : ".$reducPromo."% (".$serviceNom.") / " ;
		}
	}
		if ($request->get('happyhour') != 0) {
			$Allreduction = $Allreduction."Happy hours : ".$request->get('happyhour')."% / " ;
			$B=Happyhour::where('id',$request->get('happyhourid'))->value('Beneficiaries');
			Happyhour::where('id', $request->get('happyhourid'))->update(array("Beneficiaries"=> $B + 1));
		}
		$periode =  $request->get('periode');
		$reservation  = new Reservation([
              'client' => $request->get('client'),
              'prestataire' => $request->get('prestataire'),
              'services_reserves' => [$request->get('services_reserves')],
              'date_reservation' =>$request->date_reservation[0],
              'remarques' => $request->get('remarques'),
              'rappel' => $request->get('rappel'),
              'happyhour' => $request->get('happyhour'),
              'montant_tot' => $request->get('montant_tot'),
              'Remise' => $request->get('Remise'),
              'Net' => $request->get('Net'),
              'listcodepromo' => $request->get('listcodepromo'),
              'recurrent' => 1,
            ]);
		$reservation->save();
		$id_recc = $reservation->id ;
		for ($i=1; $i < $request->get('nbrService') ; $i++) { 
			
			$reservation  = new Reservation([
              'client' => $request->get('client'),
              'prestataire' => $request->get('prestataire'),
              'services_reserves' => [$request->get('services_reserves')],
              'date_reservation' =>$request->date_reservation[$i],
              'remarques' => $request->get('remarques'),
              'rappel' => $request->get('rappel'),
              'id_recc' => $id_recc ,
              'recurrent' => 1,
            ]);
		$reservation->save();
		}
		if ($request->get('frq')=="Journalière") {
			$frq = 1 ;

		}
		else if ($request->get('frq')=="Hebdomadaire") {
			$frq = 7 ;
		}
		else if ($request->get('frq')=="Mensuelle") {
			$frq = 28 ;
		}
		
		for ($t=1; $t < $request->get('periode') ; $t++) { 
			$days = ' + '.$frq*$t.' days' ;
			for ($i=0; $i < $request->get('nbrService') ; $i++) { 
			
			$reservation  = new Reservation([
              'client' => $request->get('client'),
              'prestataire' => $request->get('prestataire'),
              'services_reserves' => [$request->get('services_reserves')],
              'date_reservation' =>date('Y-m-d h:i', strtotime($request->date_reservation[$i]. $days)),
              'remarques' => $request->get('remarques'),
              'rappel' => $request->get('rappel'),
              'id_recc' => $id_recc ,
              'recurrent' => 1,
            ]);
			$reservation->save();
			
		}
		}
		//return $request->get('services_reserves');
		$test=Cartefidelite::where('id_client',$request->get('client'))->where('id_prest',$request->get('prestataire'))->exists();
		if ($test=='true') {
			$nbrRes=Cartefidelite::where('id_client',$request->get('client'))->where('id_prest',$request->get('prestataire'))->value('nbr_reservation');
			$reduc=User::where('id',$request->get('prestataire'))->value('reduction');
			if ($nbrRes==9) {
				
				$reservation->update(array('reduction'=>$Allreduction."Carte de fidélité : ".$reduc."%"));
				$reservation->update(array('reductionVal'=>$reduc));


			}
			}
		$client = \App\User::find($request->get('client'));
		$prestataire = \App\User::find($request->get('prestataire'));
        $ser=[$request->get('services_reserves')];
        $service_name='';
        $service_prix=1;
        //return($service_prix);
		if(isset($ser))
		{
            foreach ($ser as $s ) {
            	$service=\App\Service::find($s);
            	$service_name.=$service->nom.", ";
            	$service_prix+= floatval($service->prix);
            }

		}
		Reservation::where('id', $id_recc)->orwhere('id_recc', $id_recc)->update(array('nom_serv_res'=>$service_name, 'montant_tot'=>$service_prix));

		return($service_prix); 
		$service = \App\Service::find($request->get('services_reserves'));
		
		// Email prestataire
		$message='';
	$message.='Vous avez une nouvelle réservation.<br>Veuillez la confirmer dans votre tableau de bord.<br>';
		$message.='<b>Service :</b>  '.$service->nom.'  - ('.$service->prix.' €)  <br>';
		$message.='<b>Date :</b> '.$request->get('date').' - <b>Heure :</b> '.$request->get('heure').'<br>';
		$message.='<b>Client :</b> '.$client->name.' '.$client->lastname .'<br><br>';
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
		$message.='Votre réservation est enregsitrée avec succès.<br>Veillez attendre la confirmation du prestatire.<br>';
		$message.='<b>Service :</b>  '.$service->nom.'  - ('.$service->prix.' €)  <br>';
		$message.='<b>Date :</b> '.$request->get('date').'<b>Heure :</b> '.$request->get('heure').'<br>';
  		$message.='<b>Prestatire :</b> '.$prestataire->name.' '.$prestataire->lastname .'<br><br>';
		$message.='<b><a href="https://prenezunrendezvous.com/" > prenezunrendezvous.com </a></b>';
		
	    //$this->sendMail(trim($client->email),'Nouvelle Réservation',$message)	;
		$alerte = new Alerte([
             'user' => $client->id,
			 'titre'=>'Nouvelle Réservation',						 
             'details' => $message,
         ]);	
		 $alerte->save();
		 
		 
   // return $reservation->id;
		return redirect ('/reservations');
	 
	}
		
	public function add(Request $request)
  {
    //client_products
    //dd($request);
    $produitslist=$request->get('produitslist');
    $qtyproduits=$request->get('qtyproduits');
    
    $Allreduction = "";
    $listcodepromo=$request->get('listcodepromo');
    if ($listcodepromo != null) {
    
    
    for ($i=0; $i < sizeof($listcodepromo) ; $i++) { 
      
    $code = Codepromo::where('code',$listcodepromo[$i])->first();
    $serviceId = $code->id_service ;
        $service = Service::where('id',$serviceId)->first();
        $serviceNom = $service->nom ;
        $reducPromo = $code->reduction ;
        $Allreduction = $Allreduction."Code promo : ".$reducPromo."% (".$serviceNom.") / " ;
    }
    }
    if ($request->get('happyhour') != "0") { 
      $Allreduction = $Allreduction."Happy hours : ".$request->get('happyhour')."% / " ;
      $B=Happyhour::where('id',$request->get('happyhourid'))->value('Beneficiaries');
      Happyhour::where('id', $request->get('happyhourid'))->update(array("Beneficiaries"=> $B + 1));
    }
    
    $user=$request->get('user');
     /*$reservation  = new Reservation([
              'client' => $request->get('client'),
              'prestataire' => $request->get('prestataire'),
              'services_reserves' => $request->get('service'),
              'date' => $request->get('date'),
              'heure' => $request->get('heure'),
              'adultes' => $request->get('adultes'),
              'enfants' => $request->get('enfants'),
              'remarques' => $request->get('remarques'),
              'rappel' => $request->get('rappel'),
            ]);*/
         $reservation  = new Reservation($request->all());
         
        $reservation->save();
        $idres = $reservation->id ;
        if ($produitslist != null ) {
        $pch="";
        for ($i=0; $i < sizeof($produitslist) ; $i++) { 

        if($qtyproduits[$i]!=0)
        {
        $produ=Produit::where('id',$produitslist[$i])->first(['nom_produit','prix_unité']);
        $pch.= $qtyproduits[$i].' '.$produ->nom_produit.'('.(intval($qtyproduits[$i])*intval($produ->prix_unité) ).'), ';
        }

    $client_product  = new Client_product([
              'id_client' => $request->get('client'),
              'id_products' => $produitslist[$i],
              'id_reservation' => $idres,
              'quantity' => $qtyproduits[$i],
              
            ]);
    $client_product->save();
    }
    $reservation->update(['nom_prod_res'=>$pch]);
    $reservation->save();
    }
    $test=Cartefidelite::where('id_client',$request->get('client'))->where('id_prest',$request->get('prestataire'))->exists();
    if ($test=='true') {
      $nbrRes=Cartefidelite::where('id_client',$request->get('client'))->where('id_prest',$request->get('prestataire'))->value('nbr_reservation');
      $reduc=User::where('id',$request->get('prestataire'))->value('reduction');
      if ($nbrRes==9) {
        
        $reservation->update(array('reduction'=>$Allreduction."Carte de fidélité : ".$reduc."%"));
        $reservation->update(array('reductionVal'=>$reduc));


      }
      }
    $client = \App\User::find($request->get('client'));
    $prestataire = \App\User::find($request->get('prestataire'));
        $ser=$request->get('services_reserves');
        $service_name='';
        $service_prix=1;
        //return($service_prix);
    if(isset($ser))
    {
            foreach ($ser as $s ) {
              $service=\App\Service::find($s);
              $service_name.=$service->nom."(".$service->prix." €), ";
              $service_prix+= floatval($service->prix);
            }

    }
    /*partie analyse de résevation avec les services supplémentaires*/

    /*$services_res=explode(', ',$service_name);
    $services_supp=ServiceSupp::where('id',$prestataire->id)->get();
    foreach ($services_supp as $ss) {

      $ser_supp=explode('=',$ss->regle);
      $ser_sup2=explode('+',$ser_supp[0]);
      
    }*/

    /*fin partie analyse de résevation avec les services supplémentaires*/

         $reservation->update(array('nom_serv_res'=>$service_name, 'montant_tot'=>$service_prix));
    return($service_prix); 
    $service = \App\Service::find($request->get('service'));
    
    // Email prestataire
    $message='';
  $message.='Vous avez une nouvelle réservation.<br>Veuillez la confirmer dans votre tableau de bord.<br>';
    $message.='<b>Service :</b>  '.$service->nom.'  - ('.$service->prix.' €)  <br>';
    $message.='<b>Date :</b> '.$request->get('date').' - <b>Heure :</b> '.$request->get('heure').'<br>';
    $message.='<b>Client :</b> '.$client->name.' '.$client->lastname .'<br><br>';
    $message.='<b><a href="https://prenezunrendezvous.com/" > prenezunrendezvous.com </a></b>'; 
    
      $this->sendMail(trim($prestataire->email),'Nouvelle Réservation',$message)  ;
    
    $alerte = new Alerte([
             'user' => $prestataire->id,
       'titre'=>'Nouvelle Réservation',
             'details' => $message,
         ]);  
     $alerte->save();
     
    // Email Client
    $message='';
    $message.='Votre réservation est enregsitrée avec succès.<br>Veillez attendre la confirmation du prestatire.<br>';
    $message.='<b>Service :</b>  '.$service->nom.'  - ('.$service->prix.' €)  <br>';
    $message.='<b>Date :</b> '.$request->get('date').'<b>Heure :</b> '.$request->get('heure').'<br>';
      $message.='<b>Prestatire :</b> '.$prestataire->name.' '.$prestataire->lastname .'<br><br>';
    $message.='<b><a href="https://prenezunrendezvous.com/" > prenezunrendezvous.com </a></b>';
    
      //$this->sendMail(trim($client->email),'Nouvelle Réservation',$message) ;
    $alerte = new Alerte([
             'user' => $client->id,
       'titre'=>'Nouvelle Réservation',            
             'details' => $message,
         ]);  
     $alerte->save();
     
     
   // return $reservation->id;
    return redirect ('/reservations');
   

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
		  $reservation = \App\Reservation::find($id);
		  $service = \App\Service::find($reservation->service);
		  $client = \App\User::find( $reservation->client );
		  $prestataire = \App\User::find( $reservation->prestataire );

		// Email prestataire
		$message='';
		$message.='Votre rendez vous est confirmé par le prestataire.<br>';
		$message.='<b>Service :</b>  '.$service->nom.'  - ('.$service->prix.' €)  <br>';
		$message.='<b>Date :</b> '.$reservation->date .' - <b>Heure :</b> '.$reservation->heure.'<br><br>';
		$message.='<b>Prestatire :</b> '.$prestataire->name.' '.$prestataire->lastname .'<br><br>';
 		$message.='<b><a href="https://prenezunrendezvous.com/" > prenezunrendezvous.com </a></b>';	
		
	   $this->sendMail(trim($client->email),'Réservation validée',$message)	;

    /* $this->sendMail(trim('kbskhaled@gmail.com'),'Réservation validée',$message)	;*/
		 $alerte = new Alerte([
             'user' => $client->id,
			 'titre'=>'Réservation validée',
             'details' => $message,
         ]);	
		 $alerte->save();

 // ------------------sauvgarder l'évenement dans google calendar------------------------------------

 
   // --------------------fin sauvgarde au google calendar ----------------------------------------------------
		 
       return redirect('/reservations')->with('success', 'Réservation Validée  ');

    }
     public function oauth()
    {
        //session_start();
    //  DB::table('payments')
    	$prestataire = auth()->user();
        $rurl = action('ReservationsController@oauth');
        //dd($this->client);
        $this->client->setRedirectUri($rurl);
        if (!isset($_GET['code'])) {
            $auth_url = $this->client->createAuthUrl();
            $filtered_url = filter_var($auth_url, FILTER_SANITIZE_URL);
           // dd( $filtered_url );
            return redirect($filtered_url);
        } else {
          
             $this->client->authenticate($_GET['code']);


             $access_token =  $this->client->getAccessToken();
             //dd( $access_token);
             //$tokens_decoded = json_decode($access_token);
             $refreshToken =  $access_token['refresh_token'];

             $param=User::where('id', $prestataire->id)->first();
             $param->google_access_token=$access_token;
             $param->google_refresh_token=$refreshToken;
             $param->save();

            // dd( $refreshToken);
           // $_SESSION['access_token'] = $this->client->getAccessToken();
            //return redirect()->route('cal.index');
           return redirect('/reservations')->with('success', 'Réservation Validée et l\'évenement est enregestré dans google agenda avec succès ');

        }
    }

	  // annuler par prestataire
      public function annuler($id)
    {
 		
        Reservation::where('id', $id)->update(array('statut' => 2 ));
		
	  // envoi email annulation
		$reservation = \App\Reservation::find($id) ;
	    $service = \App\Service::find($reservation->service);
        $client = \App\User::find( $reservation->client );
        $prestataire = \App\User::find( $reservation->prestataire );

		// Email prestataire
		$message='';
		$message.='Votre rendez vous est annulée par le prestataire.<br>';
		$message.='<b>Service :</b>  '.$service->nom.'  - ('.$service->prix.' €)  <br>';
		$message.='<b>Date :</b> '.$reservation->date.' - <b>Heure :</b> '.$reservation->heure .'<br><br>';
 		$message.='<b>Prestatire :</b> '.$prestataire->name.' '.$prestataire->lastname .'<br><br>';		
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
	
	
	
	
			public function contactmessage(Request $request){
			
		  $nom= $request->get('nom');
		  $prenom= $request->get('prenom');
		  $sujet= $request->get('sujet');
		  $message= $request->get('contenu');
 		  $to= $request->get('to');
		  $email= $request->get('email');
 
		  $Message='';
		  $Message.='Nouveau message du site :  <br><br>';
		  $Message.='<b>Prénom :</b> '. $prenom .' <b>Nom :</b>'.$nom.'<br>';
		  $Message.='<b>Email :</b> '. $email  .'<br>';
		  $Message.='<b>Message :</b> '.$message.'<br><br>';
		  $Message.='<a href="https://prenezunrendezvous.com/" > prenezunrendezvous.com </a></b>';	

			
		  $this->sendMail(trim($to),$sujet,$Message)	;
		  $alerte = new Alerte([
             'user' => 1,
			 'titre'=>'Message envoyé depuis Contact',			 
             'details' => $Message,
         ]);	
		 $alerte->save();
		 
		 
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
		  $Message.='Message : '.$message.'<br><br>';
		  $Message.='<b><a href="https://prenezunrendezvous.com/" > prenezunrendezvous.com </a></b>';	

			
		  $this->sendMail(trim($to),'Nouveau Message',$Message)	;
		  $alerte = new Alerte([
             'user' => $prestataire,
			 'titre'=>'Message envoyé',			 
             'details' => $Message,
         ]);	
		 $alerte->save();
		 
		 
		}
		
		
		
	public function sendMail($to,$sujet,$contenu){

		$swiftTransport =  new \Swift_SmtpTransport( 'smtp.gmail.com', '587', 'tls');
        $swiftTransport->setUsername('prestataire222@gmail.com'); //adresse email
        $swiftTransport->setPassword('123prestataire'); // mot de passe email

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
