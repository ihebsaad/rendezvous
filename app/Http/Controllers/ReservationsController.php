<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Route;

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
       
       if(Route::current()->action['as']=='validation' || Route::current()->action['as']=='oauthCallback')
       {
       	if(Route::current()->action['as']=='validation')
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
        $client = new Google_Client();
        $client->setAuthConfig('storage/googlecalendar/'.$prest->google_path_json);
        $client->addScope(Google_Service_Calendar::CALENDAR);
        $client->setAccessType('offline');

        $guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false)));
        $client->setHttpClient($guzzleClient);
        $this->client = $client;

      //  dd( $this->client);
        }
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
		 $reservations=$reservations->sortBy(function($t)
                                        {
                                            return $t->id;
                                        })->reverse();
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
              'rappel' => $request->get('rappelab'),
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
              'rappel' => $request->get('rappelab'),
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
            	$service_name.=$service->nom.", ";
            	$service_prix+= floatval($service->prix);
            }

		}
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
          
          //Reservation::where('id', $id)->update(array('statut' => 1 ));
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
		
	  //  $this->sendMail(trim($client->email),'Réservation validée',$message)	;

        /* $this->sendMail(trim('kbskhaled@gmail.com'),'Réservation validée',$message)	;
		 $alerte = new Alerte([
             'user' => $client->id,
			 'titre'=>'Réservation validée',
             'details' => $message,
         ]);	
		 $alerte->save();*/

 // ------------------sauvgarder l'évenement dans google calendar------------------------------------

  if( $prestataire->google_path_json && $prestataire->google_access_token && $prestataire->google_refresh_token)
   {
      //voir si la réservation est récurrente ou non
        $liste_rec= array();
		 if($reservation->recurrent==1)
		 {
		 	 $idres=$reservation->id.'reccuring'.$reservation->id;
		 	 $hour=0;
		 	 $minutes=0;
		 	//$idcount=0;
		 	/*$format="Y-m-d H:i:s";
		 	$datecourante=new DateTime();
		 	$datecourante=$datecourante->format($format);
		 	$datecourante=str_replace(' ','',$datecourante);*/
		 	$debut=$reservation->date_reservation;
		    $debut=str_replace(' ','T',$debut);
		    //dd($debut);
			foreach ($reservation->services_reserves as $sr) { 
			$serv=Service::where('id',$sr)->first(["nom","duree","NbrService"]);
	        $hour=substr($serv->duree, 0, 2);
	       // dd($hour);
	        $minutes=substr($serv->duree,3,2);
	     
	        }
	        $fin=date('Y-m-d H:i:s',strtotime('+'.$hour.' hours +'.$minutes.' minutes',strtotime($debut)));
	        $fin=str_replace(' ','T', $fin);
            $un_service_res= array('id'=>$idres,'startDateTime'=>$debut,'endDateTime'=>$fin, 'summary' =>$reservation->nom_serv_res , 'description'=>'service récurrent (séance de début)' );
            $liste_rec[]= $un_service_res ;

            //$reservation->update(array('id_event_google_cal'=> $idres));
            DB::table('reservations')
            ->where('id', $reservation->id)
            ->update(['id_event_google_cal' => $idres]);
        
		 // get recurring reserved services
		 $recs=Reservation::whereNotNull('id_recc')->whereNotNull('date_reservation')->where('id_recc',$reservation->id)->get();

        // browse recurring reserved services
		 foreach ($recs as $rec) {
             
            //create id reserved reccuring service to save in google calendar
		 	$idres=$reservation->id.'reccuring'.$rec->id;

		 	// calculate the start of the reservation
		 	$debut=$rec->date_reservation;
		    $debut=str_replace(' ','T',$debut);
            
	        //calculate the end of reserved service
	        $fin=date('Y-m-d H:i:s',strtotime('+'.$hour.' hours +'.$minutes.' minutes',strtotime($debut)));
	        $fin=str_replace(' ','T', $fin);
	        /*foreach ($rec->services_reserves as $sr) { 
			$serv=Service::where('id',$sr)->first(["nom","duree","NbrService"]);
	        $hour=substr($serv->duree, 0, 2);
	        $minutes=substr($serv->duree,3,2);
	         }*/

            $un_service_res= array('id'=>$idres,'startDateTime'=>$debut,'endDateTime'=>$fin,'summary' =>$reservation->nom_serv_res, 'description'=>'service récurrent '.$reservation->nom_serv_res );
             $liste_rec[]= $un_service_res;
             //$rec->update(array('id_event_google_cal'=> $idres));
             DB::table('reservations')
            ->where('id',  $rec->id)
            ->update(['id_event_google_cal' => $idres]);
		 	
		 }
		 	
	 }
	 else // service simple (non récurrent)
	 {
        $idres=$reservation->id.'simple'.$reservation->id;
	 	$debut=$reservation->date_reservation;
		$debut=str_replace(' ','T',$debut);
		//dd($debut);
		foreach ($reservation->services_reserves as $sr) { 
		$serv=Service::where('id',$sr)->first(["nom","duree","NbrService"]);
        $hour=substr($serv->duree, 0, 2);
       // dd($hour);
        $minutes=substr($serv->duree,3,2);
       // dd($minutes);
        //$fin=date('Y-m-d H:i:s',strtotime('+'.$hour.' hours +'.$minutes.' minutes',strtotime($debut)));
        //$fin=str_replace(' ','T', $fin);
   
        }

        $fin=date('Y-m-d H:i:s',strtotime('+'.$hour.' hours +'.$minutes.' minutes',strtotime($debut)));
	    $fin=str_replace(' ','T', $fin);
        $un_service_res= array('id'=>$idres,'startDateTime'=>$debut,'endDateTime'=>$fin, 'summary' =>$reservation->nom_serv_res , 'description'=>'service simple' );
            $liste_rec[]= $un_service_res ;

         //$reservation->update(array('id_event_google_cal'=> $idres));
         DB::table('reservations')
            ->where('id',$reservation->id)
            ->update(['id_event_google_cal' => $idres]);

	 }

         
	//dd($liste_rec);

		  $startDateTime=$debut;
          $endDateTime= $fin;
          $param=User::where('id',$prestataire->id)->first();
          $access_token=$param->google_access_token;
         // dd($this->client);
        if (isset($access_token) && $access_token) {
            //dd($access_token);
             $this->client->setAccessToken($access_token);
              if ($this->client->isAccessTokenExpired()) {
              $this->client->refreshToken($param->google_refresh_token);
              }

            $service = new Google_Service_Calendar($this->client);

            $startDateTime='2021-04-14T13:00:00';
            $endDateTime= '2021-04-14T16:00:00';

            $startDateTime1='2021-04-09T14:00:00';
            $endDateTime1= '2021-04-09T15:00:00';
                    //  'recurrence' => array('RRULE:FREQ=DAILY;COUNT=2'), 
            $calendarId = 'primary';
           //'id'=> $lr['id'],

            foreach ($liste_rec as $lr ) {

            	 $event = new Google_Service_Calendar_Event([
            	
                'summary' => $lr['summary'],
                'description' =>$lr['description'],
                'start' => ['dateTime' => $lr['startDateTime'], 'timeZone' => 'Africa/Tunis',],
                'end' => ['dateTime' => $lr['endDateTime'] , 'timeZone' => 'Africa/Tunis',],
              ]);
            	
             $results = $service->events->insert($calendarId, $event);
            }

          /*  $event = new Google_Service_Calendar_Event([
            	'id'=> '110reccuring2021',
                'summary' => 'khaled_test',
                'description' =>'khaled_test',
                'start' => ['dateTime' => $startDateTime, 'timeZone' => 'Africa/Tunis',],
                'end' => ['dateTime' => $endDateTime , 'timeZone' => 'Africa/Tunis',],
                'reminders' => ['useDefault' =>false],                              
  
            ]);*/


             //'recurrence' => array(' RRULE:FREQ=WEEKLY;COUNT=4;BYDAY=FR,SU;BYHOUR=9,16'),

           /*  $event1 = new Google_Service_Calendar_Event([
             
                'summary' => 'khaled_test1',
                'description' =>'khaled_test1',
                'start' => ['dateTime' => $startDateTime1, 'timeZone' => 'Africa/Tunis',],
                'end' => ['dateTime' => $endDateTime1 , 'timeZone' => 'Africa/Tunis',],
                'reminders' => ['useDefault' =>false],
                  
  
            ]);*/
           
           // $results1 = $service->events->insert($calendarId, $event1);
           // $service->events->delete('primary', 'abc2111');
             /* $access_token = $this->client->getAccessToken();
              $refreshToken =  $access_token['refresh_token'];             
              $param->google_access_token=$access_token;
              $param->google_refresh_token=$refreshToken;
              $param->save();*/

            if (!$results) {
                return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
            }
            //return response()->json(['status' => 'success', 'message' => 'Event Created']);
             return redirect('/reservations')->with('success', 'Réservation Validée et l\'évenement est enregestré dans google agenda avec succès ');
        } else {
            return redirect()->route('oauthCallback');
        }
    }// fin if ( file json et les tokens existe)

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
