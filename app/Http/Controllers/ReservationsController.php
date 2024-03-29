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
use \App\PropositionDatesServicesAbn;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;
 use Message;
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
      return redirect('ReservezUnRdv/'.$cuser->id.'');

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
    	return view("reservations.modifReservationPro", compact('reservation','date','heure','name','posible','nbrReport'));
    }
    public function reporter(Request $request)
    {
      $idReservation = $request->get('idReservation');
      $Reservation = Reservation::where('id',$idReservation)->first();
      $nbrReport = $Reservation ->nbrReport;
      Reservation::where('id', $idReservation)->update(array('nbrReport' => $nbrReport+1 ));
      Reservation::where('id', $idReservation)->update(array('statut' => 6 ));
 

    	
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



		$message.='<b>Date :</b> '.$date .' Heure : '.$heure .'<br>';
		$message.='Merci de proposer maximum 15 dates avec des horaires qui vous conviennent. 
		(<a href="https://prenezunrendezvous.com/reservations/newDate/'.$Reservation->id.'" > Lien </a>). <br>';
		
		$message.='<b><a href="https://prenezunrendezvous.com/" > prenezunrendezvous.com </a></b>';

    // sms pres 
    $messageTel='Bonjour,';
    $messageTel.='Votre client '.$client->name.' '.$client->lastname.' veut reporter son rdv .';
    //$message.='<b>Service :</b>  '.$Reservation->nom_serv_res.'  - ('.$Reservation->Net.' €)  <br>';
    $messageTel.='Services :  ';
          foreach ($servicesres as $servicesre) {
         // echo $servicesres;
        $messageTel.=  DB::table('services')->where('id', $servicesre )->value('nom');
         $messageTel.=" ( ".DB::table('services')->where('id', $servicesre )->value('prix')."€ )";
         
         if ($Reservation->recurrent==1) {
        $messageTel.= " abonnement" ;
      }
      $messageTel.= ", ";
      }


        $messageTel.='Produits :  ';
          foreach ($idproduits as $idp) {

               $messageTel.=  ' '.DB::table('produits')->where('id', $idp->ids )->value('nom_produit').'';
               $messageTel.=  '( Quantité:'.$idp->qty.',';
               $messageTel.= ' Prix:'.DB::table('produits')->where('id', $idp->ids )->value('prix_unité')."€ )";
               $messageTel.= ", ";
              } 
              if ($Reservation->serv_suppl != null) {
               $messageTel.='Cadeaux :  '.$Reservation->serv_suppl.'';
              }



    $messageTel.='Date : '.$date .' Heure : '.$heure .'';
    $messageTel.='Merci de proposer maximum 15 dates avec des horaires qui vous conviennent. 
    (https://prenezunrendezvous.com/reservations/newDate/'.$Reservation->id.' ). ';
    
    $messageTel.='https://prenezunrendezvous.com/"  ';


		
 	    
      try {
        $this->sendMail(trim($prestataire->email),'Reporter un rendez-vous',$message) ;
       // break;
    } catch (\Swift_TransportException $e) {
        
    }
    $numtel = $prestataire->tel ;
    try {
      
          $response = Message::send([
          'to' => $numtel,
          'text' => $messageTel
        ]);

    } catch (\SMSFactor\Error\Api $e) {

    }
          


    	
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
    	return view("reservations.newDateReservationPro", compact('reservation','date','heure','name','Newdates'));
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
      Reservation::where('id', $idReservation)->update(array('statut' => 6 ));
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

    // Sms
    $messageTel='Bonjour,';
    $messageTel.='Pour le rendez-vous prévue du  '.$date .' à '.$heure .'  avec les services: ';
    //$message.='<b>Services :</b>  ';
          foreach ($servicesres as $servicesre) {
         // echo $servicesres;
        $messageTel.=  DB::table('services')->where('id', $servicesre )->value('nom');
         $messageTel.=" ( ".DB::table('services')->where('id', $servicesre )->value('prix')."€ )";
         
         if ($Reservation->recurrent==1) {
        $messageTel.= " abonnement" ;
      }
      $messageTel.= ", ";
      }


        $messageTel.='et les Produits :  ';
          foreach ($idproduits as $idp) {

               $messageTel.=  ' '.DB::table('produits')->where('id', $idp->ids )->value('nom_produit').'';
               $messageTel.=  '( Quantité:'.$idp->qty.',';
               $messageTel.= ' Prix'.DB::table('produits')->where('id', $idp->ids )->value('prix_unité')."€ )";
               $messageTel.= ", ";
              } 
              if ($Reservation->serv_suppl != null) {
               $messageTel.='( Cadeaux :  '.$Reservation->serv_suppl.'):';
              }
    $messageTel.=' Total : '.$Reservation->Net.'';
    $messageTel.='votre prestataire '.$prestataire->name.' '.$prestataire->lastname .' a vous proposé des nouvelles dates. ';
    $messageTel.='Merci de choisir une seule date :  
    (https://prenezunrendezvous.com/reservations/selectdate/'.$Reservation->id.').';
    
    $messageTel.='https://prenezunrendezvous.com';

        $alerte = new Alerte([
             'user' => $client->id,
			 'titre'=>'Nouvelle date de prestation',
             'details' => $message,
         ]);	
		 $alerte->save();
		
 	    
      try {
        $this->sendMail(trim($client->email),'report du rendez-vous',$message)  ;
       // break;
    } catch (\Swift_TransportException $e) {
        
    }
 	   $numtel = $client->tel ;
          try {
      
          $response = Message::send([
          'to' => $numtel,
          'text' => $messageTel
        ]);

    } catch (\SMSFactor\Error\Api $e) {

    }

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
    	return view("reservations.selectDateReservationPro", compact('reservation','date','heure','name','Newdates'));
    }
    // report d'une date par le client	
    public function changeDate(Request $request)
    {
    	$idReservation = $request->get('idres');
    	$date = $request->get('date');

    	Reservation::where('id', $idReservation)->update(array('date_reservation' => $date ,'statut'=>1));
 //dd($date);
    	$Reservation = Reservation::where('id',$idReservation)->first();
      $paiem = Reservation::where('id',$idReservation)->value('paiement');
      if ($paiem == 0) {
        Reservation::where('id', $idReservation)->update(array('statut' => 0 ));
      } else {
        Reservation::where('id', $idReservation)->update(array('statut' => 1 ));
      }
      
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

  // sms au prestataire
    $messageTel='Bonjour, ';
    $messageTel.='Votre client '.$client->name.' '.$client->lastname.' a choisi une nouvelle date :  '.$date .' à '.$heure .' .';
    $messageTel.='Service : '.$Reservation->nom_serv_res.'  - ('.$Reservation->Net.' €)  ';
    
    $messageTel.='https://prenezunrendezvous.com/';
		try {
        $this->sendMail(trim($prestataire->email),'Rendez-vous reporté',$message) ;
       // break;
    } catch (\Swift_TransportException $e) {
        
    }
 	    
    $numtel = $prestataire->tel ;
          try {
      
          $response = Message::send([
          'to' => $numtel,
          'text' => $messageTel
        ]);

    } catch (\SMSFactor\Error\Api $e) {

    }

$idproduits = DB::select( DB::raw("SELECT id_products as ids , quantity as qty FROM client_products s WHERE s.id_reservation='+$Reservation->id+'" ) );               if (is_array($Reservation->services_reserves)) {
                        $servicesres = $Reservation->services_reserves;
                      }else {
                        $servicesres = json_encode($Reservation->services_reserves);
                      } 

 	    // Email au client
		$message='Bonjour,<br>';
		$message.='Votre rendez-vous  est confirmé le <b>'.$date .'</b> à <b>'.$heure .'</b> avec le prestataire <a href="https://prenezunrendezvous.com/'.$prestataire->titre.'/'.$prestataire->id.'" > '.$prestataire->name.' '.$prestataire->lastname .' </a>. <br>';
		
    $message.='<b>Services :</b>  ';
          foreach ($servicesres as $servicesre) {
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

    // sms au client
    $messageTel='Bonjour,';
    $messageTel.='Votre rendez-vous  est confirmé le '.$date .'à '.$heure .' avec le prestataire'.$prestataire->name.' '.$prestataire->lastname .'. ';
    
    $messageTel.='Services :  ';
          foreach ($servicesres as $servicesre) {
        $messageTel.=  DB::table('services')->where('id', $servicesre )->value('nom');
         $messageTel.=" ( ".DB::table('services')->where('id', $servicesre )->value('prix')."€ )";
         
         if ($Reservation->recurrent==1) {
        $messageTel.= " abonnement" ;
      }
      $messageTel.= ", ";
      }


        $messageTel.='Produits : ';
          foreach ($idproduits as $idp) {

               $messageTel.=  ' '.DB::table('produits')->where('id', $idp->ids )->value('nom_produit').'';
               $messageTel.=  '( Quantité:'.$idp->qty.',';
               $messageTel.= ' Prix:'.DB::table('produits')->where('id', $idp->ids )->value('prix_unité')."€ )";
               $messageTel.= ", ";
              } 
              if ($Reservation->serv_suppl != null) {
               $messageTel.='Cadeaux :  '.$Reservation->serv_suppl.'';
              }

          $messageTel.='https://prenezunrendezvous.com/';
		try {
        $this->sendMail(trim($client->email),'Rendez-vous reporté',$message)  ;
       // break;
    } catch (\Swift_TransportException $e) {
        
    }
    $numtel = $client->tel ;
          try {
      
          $response = Message::send([
          'to' => $numtel,
          'text' => $messageTel
        ]);

    } catch (\SMSFactor\Error\Api $e) {

    }
      
 	    

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
         
         if ($Reservation->recurrent==1) {
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

    // sms au client
    $messageTel='Bonjour,';
    $messageTel.='le rendez-vous prévue du  '.$date .' à '.$heure .'  avec les services:';
      foreach ($servicesres as $servicesre) {
         // echo $servicesres;
        $messageTel.=  DB::table('services')->where('id', $servicesre )->value('nom');
         $messageTel.=" ( ".DB::table('services')->where('id', $servicesre )->value('prix')."€ )";
         
         if ($Reservation->recurrent==1) {
        $messageTel.= " abonnement" ;
      }
      $messageTel.= ", ";
      }


        $messageTel.='et les Produits :  ';
          foreach ($idproduits as $idp) {

               $messageTel.=  ' '.DB::table('produits')->where('id', $idp->ids )->value('nom_produit').'';
               $messageTel.=  '( Quantité:'.$idp->qty.',';
               $messageTel.= ' Prix:'.DB::table('produits')->where('id', $idp->ids )->value('prix_unité')."€ )";
               $messageTel.= ", ";
              } 
              if ($Reservation->serv_suppl != null) {
               $messageTel.='( Cadeaux :  '.$Reservation->serv_suppl.'):';
              }
    $messageTel.=' Total : '.$Reservation->Net.'';
    $messageTel.='a été annulé par votre client '.$client->name.' '.$client->lastname.' .';
      
    $messageTel.='Merci de lui remettre l`acompte. (https://prenezunrendezvous.com/reservations/AnnulerReservation/'.$Reservation->id.') ';  
    
    $messageTel.='https://prenezunrendezvous.com/';

		try {
        $this->sendMail(trim($prestataire->email),'Réservation annulée',$message);
       // break;
    } catch (\Swift_TransportException $e) {
        
    }
 	   $numtel = $prestataire->tel ;
          try {
      
          $response = Message::send([
          'to' => $numtel,
          'text' => $messageTel
        ]);

    } catch (\SMSFactor\Error\Api $e) {

    }  

     	
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
   
    	//return view('reservations.annuler_reservation', compact('idres'));
    	return view('reservations.annulerReservationPro', compact('idres'));
    }		
    public function index()
    {
		
		$cuser = auth()->user();
		//dd($cuser->id);
		if($cuser->user_type=='prestataire' ){
		//dd($cuser->id);
		 //$reservations = Reservation::orderBy('id', 'DESC')->where('prestataire',$cuser->id)->whereNull('id_recc')
        //->get();
       $reservations = DB::table('reservations')->where('prestataire',$cuser->id)->whereNotNull('date_reservation')->whereNull('id_recc')->where(function($q){ $q->where('recurrent',0)
         ->orwhere('recurrent',1)->where('visible',true);
          })->get();
		}
		if($cuser->user_type=='client' ){
        $reservations = DB::table('reservations')->whereNotNull('date_reservation')->where('client',$cuser->id)->whereNull('id_recc')->where(function($q){ $q->where('recurrent',0)
         ->orwhere('recurrent',1)->where('visible',true);
          })->get();
		}
		
		if($cuser->user_type=='admin' ){
        $reservations = DB::table('reservations')->whereNotNull('date_reservation')->whereNull('id_recc')->get();
		}	
		 /*$reservations=$reservations->sortBy(function($t)
                                        {
                                            return $t->id;
                                        })->reverse();*/
        //dd( $reservations);
		//$this->sendMail('ihebsaad@gmail.com','Test','test Hello world')	;
        return view('entreprise.ReservezUnRdvAdmin', compact('reservations'));



    }

    public static function reservationsdujour()
    {
		    // temporairement : mettre timezone martinique
      date_default_timezone_set("America/Martinique");


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
    public static function Avisdujour()
    {
      
      $today = new DateTime();
      $today = $today->format('d-m-Y');
      $date = date('Y-m-d', strtotime($today. ' - 2 days'));
      $x = DB::select( DB::raw("SELECT c.* FROM ( SELECT * FROM reservations  WHERE date_reservation > '$date 00:00:00' and date_reservation < '$date 23:59:00' and avis = 1 ) c LEFT JOIN reviews u on c.prestataire=u.prestataire and c.client=u.client WHERE (u.client IS Null) or u.prestataire is null" ) );
      return $x;
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
      $reservation->update(array('happyhourval'=>$request->get('happyhourid')));
      $reservation->update(array('reduction'=>$Allreduction));
    }
		$periode =  $request->get('periode');

		 $servicerecc = Service::where('id',$request->get('services_reserves'))->first();
        $nbr_fois=$servicerecc->Nfois;

		$reservation  = new Reservation([
              'client' => $request->get('client'),
              'prestataire' => $request->get('prestataire'),
              'services_reserves' => [$request->get('services_reserves')],          
              'remarques' => $request->get('remarques'),
              'rappel' => $request->get('rappel'),
              'happyhour' => $request->get('happyhour'),
              'montant_tot' => $request->get('montant_tot'),
              'Remise' => $request->get('Remise'),
              'Net' => $request->get('Net'),
              'listcodepromo' => $request->get('listcodepromo'),
              'recurrent' => 1,
              'ordre_recc'=>1,
            ]);
		$reservation->save();
		$id_recc = $reservation->id ;
		$id_recc2=$id_recc;
		for ($i=1; $i < $nbr_fois ; $i++) { 
			
			$reservation  = new Reservation([
              'client' => $request->get('client'),
              'prestataire' => $request->get('prestataire'),
              'services_reserves' => [$request->get('services_reserves')],              
              'remarques' => $request->get('remarques'),
              'rappel' => $request->get('rappel'),
              'id_recc' => $id_recc ,
              'recurrent' => 1,
               'ordre_recc'=>($i+1),
            ]);
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
        $ser=[$request->get('services_reserves')];
        $service_name='';
        $service_prix=1;
      
		if(isset($ser))
		{
            foreach ($ser as $s ) {
            	$service=\App\Service::find($s);
            	$service_name.=$service->nom.", ";
            	$service_prix+= floatval($service->prix);
            }

		}
		Reservation::where('id', $id_recc)->orwhere('id_recc', $id_recc)->update(array('nom_serv_res'=>$service_name, 'montant_tot'=>$service_prix));

		//inseration dans la table propostion de dates
		$Proposition  = new PropositionDatesServicesAbn([
              'client' => $request->get('client'),
              'prestataire' => $request->get('prestataire'),
              'service_rec' => $request->get('services_reserves'),
              'id_reservation'=>$id_recc2,
            
            ]);
			$Proposition->save(); 

        //dd('test');
		$service = \App\Service::find($request->get('services_reserves'));
		
	
		 
		 
    return $reservation->id;
		//return redirect ('/reservations');
	 
	}
		
	public function add(Request $request)
  {
    //client_products
   // dd($request->get('happyhour') != 0);
    $reservation  = new Reservation($request->all());
         
        $reservation->save();
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
        $reservation->update(array('reduction'=>$Allreduction));
    }
    }
    if ($request->get('happyhour') != 0) { 
      $Allreduction = $Allreduction."Happy hours : ".$request->get('happyhour')."% / " ;
      $reservation->update(array('happyhourval'=>$request->get('happyhourid')));
      $reservation->update(array('reduction'=>$Allreduction));
    }
    
    $user=$request->get('user');

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
  
    /*fin partie analyse de résevation avec les services supplémentaires*/

    $reservation->update(array('nom_serv_res'=>$service_name, 'montant_tot'=>$service_prix));
    
    

     
  return($idres);
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

    // sms prestataire
    $messageTel='';
    $messageTel.='Votre rendez vous est confirmé par le prestataire.';
    $messageTel.='Service :  '.$service->nom.'  - ('.$service->prix.' €)  ';
    $messageTel.='Date : '.$reservation->date .' - Heure : '.$reservation->heure.'.';
    $messageTel.='Prestatire : '.$prestataire->name.' '.$prestataire->lastname .'.';
    $messageTel.='https://prenezunrendezvous.com/'; 
		
	   
     try {
        $this->sendMail(trim($client->email),'Réservation validée',$message)  ;
       // break;
    } catch (\Swift_TransportException $e) {
        
    }
    
$numtel = $client->tel ;
          try {
      
          $response = Message::send([
          'to' => $numtel,
          'text' => $messageTel
        ]);

    } catch (\SMSFactor\Error\Api $e) {

    }
    /* $this->sendMail(trim('kbskhaled@gmail.com'),'Réservation validée',$message)	;*/
		 $alerte = new Alerte([
             'user' => $client->id,
			 'titre'=>'Réservation validée',
             'details' => $message,
         ]);	
		 $alerte->save();

 // ------------------sauvgarder l'évenement dans google calendar------------------------------------

 
   // --------------------fin sauvgarde au google calendar ----------------------------------------------------
   return redirect('ReservezUnRdv/'.auth()->user()->id.'')->with('success', 'Réservation Validée  ');
      //  return redirect('ReservezUnRdv',['id'=> auth()->user()->id] )->with('success', 'Réservation Validée  ');

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
      $cuser=auth()->user();
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

    // sms prestataire
    $messageTel='';
    $messageTel.='Votre rendez vous est annulée par le prestataire.';
    $messageTel.='Service :  '.$service->nom.'  - ('.$service->prix.' €)  ';
    $messageTel.='Date : '.$reservation->date.' - Heure : '.$reservation->heure .'.';
    $messageTel.='Prestatire : '.$prestataire->name.' '.$prestataire->lastname .'.';   
    $messageTel.='https://prenezunrendezvous.com/'; 
		 try {
        $this->sendMail(trim($client->email),'Réservation annulée',$message)  ;
       // break;
    } catch (\Swift_TransportException $e) {
        
    }
	    $numtel = $client->tel ;
          try {
      
          $response = Message::send([
          'to' => $numtel,
          'text' => $messageTel
        ]);

    } catch (\SMSFactor\Error\Api $e) {

    }
		
		$alerte = new Alerte([
             'user' => $client->id,
			 'titre'=>'Réservation annulée',			 
             'details' => $message,
         ]);	
		 $alerte->save();

				 
     return redirect('ReservezUnRdv/'.$cuser->id.'')->with('success', 'Réservation Anunulée  ');

      //  return redirect('/reservations')->with('success', 'Réservation Anunulée  ');

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

       //$swiftTransport->setUsername('contact.prenezunrendezvous@gmail.com '); //adresse email
       //$swiftTransport->setPassword('davemarco97232'); // mot de passe email

       // $swiftTransport->setUsername('clientdavid26@gmail.com'); //adresse email
        //$swiftTransport->setPassword('david2022!'); // mot de passe email

        $swiftTransport->setUsername(env('MAIL_USERNAME')); //adresse email
        $swiftTransport->setPassword(env('MAIL_PASSWORD')); // mot de passe email eSolutions2020*

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

  public function ReservezUnRdv($id)
    {
      $cuser = auth()->user();
        $user_type=$cuser->user_type;
        $user_id=$cuser->id;

        $user = User::find($id);
    if($cuser->user_type=='prestataire' ){
   
       $reservations = DB::table('reservations')->where('prestataire',$cuser->id)->where('statut','!=',0)->whereNotNull('date_reservation')->whereNull('id_recc')->where(function($q){ $q->where('recurrent',0)
         ->orwhere('recurrent',1)->where('visible',true);
          })->orderBy('created_at', 'desc')->get();
       return view('entreprise.ReservezUnRdv', compact('reservations','user','id'));
    }

    if($cuser->user_type=='client' ){
        $reservations = DB::table('reservations')->whereNotNull('date_reservation')->where('client',$cuser->id)->where('statut','!=',0)->whereNull('id_recc')->where(function($q){ $q->where('recurrent',0)
         ->orwhere('recurrent',1)->where('visible',true);
          })->get();
        return view('entreprise.ReservezUnRdvClient', compact('reservations','user','id'));
    }
    
    if($cuser->user_type=='admin' ){
        $reservations = DB::table('reservations')->whereNotNull('date_reservation')->where('statut','!=',0)->whereNull('id_recc')->get();
        return view('entreprise.ReservezUnRdvAdmin', compact('reservations','user','id'));
    } 
    

     /*$reservations=$reservations->sortBy(function($t)
                                        {
                                            return $t->id;
                                        })->reverse();*/
        //dd( $reservations);
    //$this->sendMail('ihebsaad@gmail.com','Test','test Hello world') ;
        

      
        
       
    }
	
		
	
	
	
 }
