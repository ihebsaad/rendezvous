<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Route;
use App\Invoice;
use App\IPNStatus;
use App\Item;
use App\User;
use App\Retrait;
use App\Service;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Srmklive\PayPal\Services\AdaptivePayments;
use Srmklive\PayPal\Services\ExpressCheckout;
use URL;


use Illuminate\Support\Facades\Input;
use DB;
use \App\Reservation;
use \App\Alerte;
use Carbon\Carbon;
use \App\Cartefidelite;

 use Swift_Mailer;
 use Mail;
 use DateTime;


use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;


class MyPaypalController extends Controller
{
	protected $provider;

    public function __construct()
    {
        //$this->middleware('auth');
       
       if(Route::current()->action['as']=='payreservation' || Route::current()->action['as']=='successpay' || Route::current()->action['as']=='oauthCallback' || Route::current()->action['as']=='successpay2')
       {
        if(Route::current()->action['as']=='payreservation' || Route::current()->action['as']=='successpay' || Route::current()->action['as']=='successpay2' )
        {
           $id = Input::get('reservation');
           Session::put('idres', $id);
          
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
            if(file_exists('storage/googlecalendar/'.$prest->google_path_json))
            {

            //dd("exist");
            $client = new Google_Client();
            $client->setAuthConfig('storage/googlecalendar/'.$prest->google_path_json);
            $client->addScope(Google_Service_Calendar::CALENDAR);
            $client->setAccessType('offline');

            $guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false)));
            $client->setHttpClient($guzzleClient);
            $this->client = $client;
             }
        }

      //  dd( $this->client);
        }
    }
	//-------------------------------------------CheckEmail---------------------------------------------

  public function CheckEmail(Request $request)
    {
        $id=$request->get('id');
        $varEmail=$request->get('email'); 
        $this->provider = new AdaptivePayments('AdaptivePay');

        $data = [
            'receivers'  => [
                [
            'email' => $varEmail,
            'amount' => 1,
            
        ],
        
              
            ],
            'payer'      => 'EACHRECEIVER', // (Optional) Describes who pays PayPal fees. Allowed values are: 'SENDER', 'PRIMARYRECEIVER', 'EACHRECEIVER' (Default), 'SECONDARYONLY'
            'return_url' => url('payment/success'),
            'cancel_url' => url('payment/cancel'),
        ];

        $response = $this->provider->createPayRequest($data);
        
        //$response =0;
        //dd($response);
        if ($response['responseEnvelope']['ack'] == "Failure") {
            Session::put('msg', 'off');
            return  back();
         } 
         //dd($id);
        //dd($response);
        User::where('id', $id)->update(array('emailPaypal' => $varEmail ));
        Session::put('msg', 'on');

        return back();
      

        
    }   
//-----------------------------------------------end------------------------------------------------
    //-------------------------------------------PaymentDetails---------------------------------------------
    public function PaymentDetails($id)
    {
    	$Reservation=Reservation::find($id);


        $this->provider = new AdaptivePayments('PaymentDetails');

        $data = [
            
            'key' => $Reservation->payKey,
            'return_url' => url('payment/success'),
            'cancel_url' => url('payment/cancel'),
            
        ];
        $amount = $Reservation->Net - $Reservation->reste ;
        $response = $this->provider->createPayRequest($data);
        $email=$response['senderEmail'];
        $this->provider = new AdaptivePayments('AdaptivePay');
        $data = [
            'receivers'  => [
                [
                    'email'   => $email,
                    'amount'  => $amount,
                    
                ],
              
            ],
            'payer'      => 'EACHRECEIVER', // (Optional) Describes who pays PayPal fees. Allowed values are: 'SENDER', 'PRIMARYRECEIVER', 'EACHRECEIVER' (Default), 'SECONDARYONLY'
             'return_url' =>URL::route('successpay2',['reservation'=>$id]),
             'cancel_url' => URL::route('cancelpay2'),
        ];
		
		
		$response = $this->provider->createPayRequest($data);
//$redirect_url = $this->provider->getRedirectUrl('approved', $response['payKey']);

$redirect_url = $this->provider->getRedirectUrl('approved', $response['payKey']);
		return redirect($redirect_url);
    }

//-------------------------------------------end---------------------------------------------

    // appler lorssque le prestataire rembourse les argent au vlient  (annuler Res)
public function successpay2(Request $request)
    {
      Reservation::where('id', $request->get('reservation'))->update(array('statut' => 2 ));
      $Reservation = Reservation::where('id',$request->get('reservation'))->first();
      //dd($Reservation);
      $client=User::find($Reservation->client);
      $date = new DateTime($Reservation->date_reservation);
    $date = $date->format('d-m-Y');
    $heure = new DateTime($Reservation->date_reservation);
    $heure = $heure->format('H:i');
    $prestataire=User::find($Reservation->prestataire);

    // Email au prest
    $message='Bonjour,<br>';
    $message.='le rendez-vous prévue du  '.$date .' à '.$heure .'  avec les services: '.$Reservation->nom_serv_res.'  - ('.$Reservation->Net.' €) a été annulé.';
    $message.='Votre Prestataire '.$prestataire->name.' '.$prestataire->lastname.'a remboursé votre montant payé.<br>';
   
    
    $message.='<b><a href="https://prenezunrendezvous.com/" > prenezunrendezvous.com </a></b>';


    
      $this->sendMail(trim($client->email),'Réservation annulée _ Remboursement',$message) ;
      $alerte = new Alerte([
             'user' => $client->id,
       'titre'=>'Réservation annulée',       
             'details' => $message,
         ]);  
     $alerte->save();

      // ------------------delete l'évenement dans google calendar------------------------------------

  if($prestataire->google_path_json && $prestataire->google_access_token && $prestataire->google_refresh_token)
   {
      //voir si la réservation est récurrente ou non
       
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
            $service->events->delete('primary', $idevent);
            Reservation::where('id', $reservation->id)->update(['id_event_google_cal' => null]);

          }
          //
        }// fin test idevent


    }// fin if ( file json et les tokens existe)

   // --------------------fin delete event from google calendar----------------------------------------------------

     return redirect('/reservations/')->with('success', ' Paiement  effectué avec succès  ');
    }

    //-------------------------------------------payAcompteReservation---------------------------------------------
    public function payReservation(Request $request)
    {
        //dd('pay acompte');
        $montant=$request->get('montant');

       // dd($request->get('reservation'));
        $desc=$request->get('description');
        $reservation=$request->get('reservation');
        $prestId=$request->get('prest'); 
        $email=User::where('id',$prestId)->value('emailPaypal');
		$Reservation=Reservation::find( $reservation);
		
		$this->provider = new AdaptivePayments('AdaptivePay');

 		// Paiement d'acompte		
		if($Reservation->paiement==0 || $Reservation->paiement ==null){
		$abonnement=User::where('id',$prestId)->value('abonnement');
        if ($abonnement==3) {
            $k=60 ;
        }elseif ($abonnement==2) {
            $k=50 ;
        }elseif ($abonnement==1) {
            $k=30 ;
        }
        $acompte=($montant*$k)/100 ;
		$reste=$montant-$acompte;
 
        $data = [
            'receivers'  => [
                [
                    'email'   => $email,
                    'amount'  => $acompte,
                    
                ],
              
            ],
            'payer'      => 'EACHRECEIVER', // (Optional) Describes who pays PayPal fees. Allowed values are: 'SENDER', 'PRIMARYRECEIVER', 'EACHRECEIVER' (Default), 'SECONDARYONLY'
             'return_url' =>URL::route('successpay',['reservation'=>$reservation,'type'=>'acompte','reste'=>$reste]),
             'cancel_url' => URL::route('cancelpay',['reservation'=>$reservation]),
        ];
		
		
		$response = $this->provider->createPayRequest($data);
		// dd( $response);
		//$key='';
		//if(isset($response['payKey'])){$key=$response['payKey'];}
		Reservation::where('id',$reservation)->update(array('payKey' => $response['payKey']));
		//$redirect_url = $this->provider->getRedirectUrl('approved', $key);
		$redirect_url = $this->provider->getRedirectUrl('approved', $response['payKey']);
		return redirect($redirect_url);
		} // end acompte

		
		// paiement reste
		if($Reservation->paiement==1){
  
		$reste=$Reservation->reste;

        $data = [
            'receivers'  => [
                [
                    'email'   => $email,
                    'amount'  => $reste,              
                ],
              
            ],
            'payer'      => 'EACHRECEIVER', // (Optional) Describes who pays PayPal fees. Allowed values are: 'SENDER', 'PRIMARYRECEIVER', 'EACHRECEIVER' (Default), 'SECONDARYONLY'
             'return_url' =>URL::route('successpay',['reservation'=>$reservation,'type'=>'reste','reste'=>0]),
             'cancel_url' => URL::route('cancelpay',['reservation'=>$reservation]),
        ];			
			
        $response = $this->provider->createPayRequest($data);
 		$redirect_url = $this->provider->getRedirectUrl('approved', $response['payKey']);
		return redirect($redirect_url);
		
		}
		



		
    }

//----------------------------------------------end---------------------------------------------



//-------------------------------------------successPay------------------------------------------
    public function successpay(Request $request)
    {

 
         $reservation=$request->get('reservation');
         $type=$request->get('type');
         $reste=$request->get('reste');
		 if($type=='acompte'){$titre='Acompte';}else
		 {$titre='Montant Restant'; }

	// verifier success ..
	
		 \Session::put('success', 'Paiement avec succès');
        //    return Redirect::route('/pay');

		 // ajouter +1 au carte fidelite --------------------------------------------------------------
 		$idclient=Reservation::where('id',$reservation)->value('client');
     	$idprestataire=Reservation::where('id',$reservation)->value('prestataire');
    	$test=Cartefidelite::where('id_client',$idclient)->where('id_prest',$idprestataire)->exists();
    	if ($test=='true') {
     		$val = Cartefidelite::where('id_client',$idclient)->where('id_prest',$idprestataire)->value('nbr_reservation');
    		if ($val==9) {

    			$val =0;
    			$nbr_fois = Cartefidelite::where('id_client',$idclient)->where('id_prest',$idprestataire)->value('nbr_fois') +1;
    			Cartefidelite::where('id_client',$idclient)->where('id_prest',$idprestataire)->update(array('nbr_fois' => $nbr_fois));
    		}else {
    			//dd('ok');
    			$val = Cartefidelite::where('id_client',$idclient)->where('id_prest',$idprestataire)->value('nbr_reservation') +1;
    			//dd($val);

    		}
    		Cartefidelite::where('id_client',$idclient)->where('id_prest',$idprestataire)->update(array('nbr_reservation' => $val));
    		
    	}else{
    		//dd('ok');
    		$newCarte = new Cartefidelite([
              'id_client' => $idclient,
              'id_prest' => $idprestataire,
              'nbr_reservation' => 1,
              'nbr_fois' => 0
              
           ]);

        $newCarte->save();

    	}
    	//-----------------------------------------------------------------------------------------------------
		 // Email
		$Reservation = \App\Reservation::find( $reservation);
		
 		$client =  \App\User::find($Reservation->client);
		$prestataire =  \App\User::find($Reservation->prestataire);
		$serviceid = $Reservation->service;
		
		$service = \App\Service::find( $serviceid) ;
		if($type=='acompte'){
				Reservation::where('id',$reservation)->update(array('paiement' => 1,'reste'=>$reste));	
				$date = new DateTime($Reservation->date_reservation);
				$date = $date->format('d-m-Y');
				$heure = new DateTime($Reservation->date_reservation);
				$heure = $heure->format('H:i');

$idproduits = DB::select( DB::raw("SELECT id_products as ids , quantity as qty FROM client_products s WHERE s.id_reservation='+$Reservation->id+'" ) );               if (is_array($Reservation->services_reserves)) {
                        $servicesres = $Reservation->services_reserves;
                      }else {
                        $servicesres = json_encode($Reservation->services_reserves);
                      }       


				//dd($heure);
				// Email au client
				$message='Bonjour,<br>';
				$message.='Réservation('.$titre.') payée avec succès <br>';
				$message.='Votre rendez-vous  est confirmé le <b>'.$date .'</b> à <b>'.$heure .'</b> avec le prestataire <a href="https://prenezunrendezvous.com/'.$prestataire->titre.'/'.$prestataire->id.'" > '.$prestataire->name.' '.$prestataire->lastname .' </a>. <br>';
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
 	  //dd(($client->email));
		 	    $this->sendMail(trim($client->email),'Réservation('.$titre.') payé',$message)	;	

        

		} // fin if type == acompte
		if($type=='reste'){
			 Reservation::where('id',$reservation)->update(array('paiement' => 2,'reste'=>0));	
			 
 				$date = new DateTime($Reservation->date_reservation);
				$date = $date->format('d-m-Y');
				$heure = new DateTime($Reservation->date_reservation);
				$heure = $heure->format('H:i');
				//dd($heure);
				// Email au client
				$message='Bonjour,<br>';
				$message.='Réservation('.$titre.') payée avec succès <br>';
				$message.='Votre rendez-vous  est confirmé le <b>'.$date .'</b> à <b>'.$heure .'</b> avec le prestataire <a href="https://prenezunrendezvous.com/'.$prestataire->titre.'/'.$prestataire->id.'" > '.$prestataire->name.' '.$prestataire->lastname .' </a>. <br>';
				$message.='<b>Service :</b>  '.$Reservation->nom_serv_res.'  - ('.$Reservation->Net.' €)  <br><br><br>';
					
				$message.='<b>ATTENTION :</b> <br>';	
				$message.='-Vous avez le droit d`annuler ou de reporter le rendez-vous 5 jours avant le rdv. 
				(<a href="https://prenezunrendezvous.com/reservations/modifier/'.$Reservation->id.'" > Lien </a>). <br>';
				$message.='-Au delà des 5 jours avant le rendez vous votre accompte ne sera pas remboursé.  <br>';
				$message.='-Au delà des 5 jours, Il vous sera impossible d`annuler ou de reporter le rendez-vous.  <br>';
				$message.='-Vous n`êtes pas venu au rendez-vous  pour x raison, votre accompte ne sera pas remboursé <br>car malheureusement beaucoup trop de clients prennent des rendez-vous et ne vienne pas sans prévenir et cela chamboule toute notre journée. <br> Merci d`avance d`être présent à votre rendez-vous et merci de votre compréhension. <br>';
				$message.='<b><a href="https://prenezunrendezvous.com/" > prenezunrendezvous.com </a></b>';
 	 
			 
		}
  		
				
		
    	
		//enregistrement alerte
    	$alerte = new Alerte([
             'user' => $client->id,
			 'titre'=>'Réservation payée('.$titre.')',						 
             'details' => $message,
         ]);	
		 $alerte->save();
 $idproduits = DB::select( DB::raw("SELECT id_products as ids , quantity as qty FROM client_products s WHERE s.id_reservation='+$Reservation->id+'" ) );               if (is_array($Reservation->services_reserves)) {
                        $servicesres = $Reservation->services_reserves;
                      }else {
                        $servicesres = json_encode($Reservation->services_reserves);
                      }  
		// Email au prestataire
		$message='Bonjour,<br>';
		$message.='Réservation payée('.$titre.')<br>';

		//$message.='<b>Service :</b>  '.$service->nom.'  - ('.$service->prix.' €)  <br>';
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
              

       


		$message.='<br><b>Date :</b> '.$Reservation->date .' Heure : '.$Reservation->heure .'<br>';
		$message.='<b>Client :</b> '.$client->name.' '.$client->lastname .'<br><br>';
		$message.='<b><a href="https://prenezunrendezvous.com/" > prenezunrendezvous.com </a></b>';	
		
        $this->sendMail(trim($prestataire->email),'Réservation payée('.$titre.')',$message)    ;
    	//enregistrement alerte
		$alerte = new Alerte([
             'user' => $prestataire->id,
			 'titre'=>'Réservation payée('.$titre.')',						 
             'details' => $message,
         ]);	
		 $alerte->save();		
		
		// enregistrement payment dans la base
		$paiement  =  new \App\Payment([
             'payer_id' => Input::get('PayerID'),
			 'payment_id'=>Input::get('payment_id') ,						 
             'user' => $client->id,
             'beneficiaire' => $prestataire->name. ' '.$prestataire->lastname,
             'beneficiaire_id' => $prestataire->id ,
             'details' => 'paiement de réservation('.$titre.') pour : '.$prestataire->name. ' '.$prestataire->lastname,
         ]);	
		 
		 $paiement->save();

     // avant la redirection on va sauvgarder l'évenement dans google Agenda si le type est acompte

    if($type=='acompte')
     {

    // ------------------sauvgarder l'évenement dans google calendar------------------------------------

  if($prestataire->google_path_json && $prestataire->google_access_token && $prestataire->google_refresh_token)
    {
      //voir si la réservation est récurrente ou non
        $liste_rec= array();
     if($Reservation->recurrent==1)
     {
       $idres=$Reservation->id.'reccuring'.$Reservation->id;
       $hour=0;
       $minutes=0;
      //$idcount=0;
      /*$format="Y-m-d H:i:s";
      $datecourante=new DateTime();
      $datecourante=$datecourante->format($format);
      $datecourante=str_replace(' ','',$datecourante);*/
      $debut=$Reservation->date_reservation;
        $debut=str_replace(' ','T',$debut);
        //dd($debut);
      foreach ($Reservation->services_reserves as $sr) { 
      $serv=Service::where('id',$sr)->first(["nom","duree","NbrService"]);
          $hour=substr($serv->duree, 0, 2);
         // dd($hour);
          $minutes=substr($serv->duree,3,2);
       
          }
          $fin=date('Y-m-d H:i:s',strtotime('+'.$hour.' hours +'.$minutes.' minutes',strtotime($debut)));
          $fin=str_replace(' ','T', $fin);
            $un_service_res= array('id'=>$idres,'startDateTime'=>$debut,'endDateTime'=>$fin, 'summary' =>$Reservation->nom_serv_res , 'description'=>'service récurrent (séance de début)' );
            $liste_rec[]= $un_service_res ;

            //$Reservation->update(array('id_event_google_cal'=> $idres));
            DB::table('reservations')
            ->where('id', $Reservation->id)
            ->update(['id_event_google_cal' => $idres]);
        
     // get recurring reserved services
     $recs=Reservation::whereNotNull('id_recc')->whereNotNull('date_reservation')->where('id_recc',$Reservation->id)->get();

        // browse recurring reserved services
     foreach ($recs as $rec) {
             
            //create id reserved reccuring service to save in google calendar
      $idres=$Reservation->id.'reccuring'.$rec->id;

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

            $un_service_res= array('id'=>$idres,'startDateTime'=>$debut,'endDateTime'=>$fin,'summary' =>$Reservation->nom_serv_res, 'description'=>'service récurrent '.$Reservation->nom_serv_res );
             $liste_rec[]= $un_service_res;
             //$rec->update(array('id_event_google_cal'=> $idres));
             DB::table('reservations')
            ->where('id',  $rec->id)
            ->update(['id_event_google_cal' => $idres]);
      
     }
      
   }
   else // service simple (non récurrent)
   {
        $idres=$Reservation->id.'simple'.$Reservation->id;
    $debut=$Reservation->date_reservation;
    $debut=str_replace(' ','T',$debut);
    //dd($debut);
    foreach ($Reservation->services_reserves as $sr) { 
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
        $un_service_res= array('id'=>$idres,'startDateTime'=>$debut,'endDateTime'=>$fin, 'summary' =>$Reservation->nom_serv_res , 'description'=>'service simple' );
            $liste_rec[]= $un_service_res ;

         //$Reservation->update(array('id_event_google_cal'=> $idres));
         DB::table('reservations')
            ->where('id',$Reservation->id)
            ->update(['id_event_google_cal' => $idres]);

   }
  dd($liste_rec);
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
           //  'recurrence' => array('RRULE:FREQ=DAILY;COUNT=2'), 
            $calendarId = 'primary';
           //'id'=> $lr['id'],

            foreach ($liste_rec as $lr ) {

               $event = new Google_Service_Calendar_Event([
                'id'=> $lr['id'],
                'summary' => $lr['summary'],
                'description' =>$lr['description'],
                'start' => ['dateTime' => $lr['startDateTime'], 'timeZone' => 'Africa/Tunis',],
                'end' => ['dateTime' => $lr['endDateTime'] , 'timeZone' => 'Africa/Tunis',],
              ]);
            
             $results='';
             if($lr['startDateTime'] &&  $lr['endDateTime']  )
             {
             $results = $service->events->insert($calendarId, $event);
             }
            }


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
  

     }// fin if $type=acompte
		 
		  return redirect('/reservations/')->with('success', ' Paiement ('.$titre.') effectué avec succès  ');

 
    }
	
	
//-------------------------------------------	
  public function cancelpay(Request $request)
    {
      //  dd($request);
	   $reservation=$request->get('reservation');

     return view('reservations.cancel',['reservation'=>$reservation]);

    }


//----------------------------------------------end---------------------------------------------

//-------------------------------------------AdaptivePay---------------------------------------------
    public function getAdaptivePay()
    {
        $this->provider = new AdaptivePayments('AdaptivePay');

        $data = [
            'receivers'  => [
                [
                    'email'   => 'saadiheb@gmail.com',
                    'amount'  => 150,
                    
                ],
              
            ],
            'payer'      => 'EACHRECEIVER', // (Optional) Describes who pays PayPal fees. Allowed values are: 'SENDER', 'PRIMARYRECEIVER', 'EACHRECEIVER' (Default), 'SECONDARYONLY'
            'return_url' => url('payment/success'),
            'cancel_url' => url('payment/cancel'),
        ];

        $response = $this->provider->createPayRequest($data);
        //dd($response);
$redirect_url = $this->provider->getRedirectUrl('approved', $response['payKey']);

return redirect($redirect_url);
    }

//----------------------------------------------end---------------------------------------------



//-------------------------------------------Preapproved---------------------------------------------
    public function getpreapproved(Request $request)
    {
		$montant=$request->get('montant');
        $desc=$request->get('description');
        $reservation=$request->get('reservation');
        $prestId=$request->get('prest');
        $email=User::where('id',$prestId)->value('emailPaypal');
		$Reservation=Reservation::find( $reservation);

		
        $this->provider = new AdaptivePayments('preapproved');
         
		$tranche=$montant/4;

		// $date = new \DateTime('NOW');
       // $today= $date->format('c');  
      //  $today= $date->format(\DateTime::ISO8601);

		// $today= date('Y-m-d' ).'T'.date('H:i:s').'Z';
		 $today= gmdate("Y-m-d\TH:i:s\Z");
		 $enddate=date('Y-m-d\TH:i:s\Z',strtotime("+3 months")) ;

		//$enddate= date('Y-m-dTh:i:s',strtotime("+4 months"));
		//$enddate= date($today,strtotime("+4 months"));
		$date1=date('Y-m-d H:i:s') ;
		$date2=date('Y-m-d H:i:s',strtotime("+1 month")) ;
		$date3=date('Y-m-d H:i:s',strtotime("+2 months")) ;
		$date4=date('Y-m-d H:i:s',strtotime("+3 months")) ;

        $data = [
          //  "maxAmountPerPayment"=> 45.00, 
            "maxAmountPerPayment"=> $tranche, 
            "maxNumberOfPayments"=> 4, 
            'maxTotalAmountOfAllPayments'=> $montant,
           // "senderEmail" => "haithemsahlia-buyer@gmail.com",
           //  "endingDate" => "2021-09-02T20:40:52Z",
            "endingDate" => $enddate,
            // "startingDate" => "2021-05-02T10:45:52Z",
             "startingDate" => $today,
            'return_url' => URL::route('approved',['email'=>$email,'tranche'=>$tranche,'reservation'=>$reservation,'date1'=>$date1,'date2'=>$date2,'date3'=>$date3,'date4'=>$date4 ]),
            'cancel_url' => URL::route('cancelpay',['reservation'=>$reservation]) ,
           'ipnNotificationUrl' => URL::route('notification') ,
        ];
		//dd($data);
        $response = $this->provider->createPayRequest($data);
 
	    \Session::forget('preapprovalKey');

		// save key
		 \Session::put(['preapprovalKey' => $response['preapprovalKey']]);
 
$redirect_url = $this->provider->getRedirectUrl('pre-approved', $response['preapprovalKey']);

return redirect($redirect_url);
    }

//----------------------------------------------end----------------------------------------------------




//-------------------------------------------PreapprovedPay---------------------------------------------
    public function getPreapprovedPay()
    {
        $this->provider = new AdaptivePayments('preapproved-pay');

        $data = [
            'preapprovalKey'=>'PA-1BA57335FD044912K',
            'receivers'  => [
                [
                    'email'   => 'saadiheb@gmail.com',
                    'amount'  => 20,
                    
                ],
              
            ],
            'senderEmail'=>"mohamed.achraf.besbes@gmail.com",
            'payer'      => 'EACHRECEIVER', // (Optional) Describes who pays PayPal fees. Allowed values are: 'SENDER', 'PRIMARYRECEIVER', 'EACHRECEIVER' (Default), 'SECONDARYONLY'
            'return_url' => url('payment/success'),
            'cancel_url' => url('payment/cancel'),
        ];

        $response = $this->provider->createPayRequest($data);
        //dd($response);


    return $response;
       
    }
//-------------------------------------------end---------------------------------------------




public function sendMail($to,$sujet,$contenu){

		$swiftTransport =  new \Swift_SmtpTransport( 'smtp.gmail.com', '587', 'tls');
    //$swiftTransport->setUsername(\Config::get('mail.username')); //adresse email
    //$swiftTransport->setPassword(\Config::get('mail.password')); // mot de passe email

    $swiftTransport->setUsername('prestataire222@gmail.com'); //adresse email
    $swiftTransport->setPassword('123prestataire'); // mot de passe email eSolutions2020*

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
	
	
	
	
  public function approved(Request $request)
    {
       // dd($request);
	 
	 $reservation=$request->get('reservation');
	 $email=$request->get('email');
	 $tranche=$request->get('tranche');
	 $date1=$request->get('date1');
	 $date2=$request->get('date2');
	 $date3=$request->get('date3');
	 $date4=$request->get('date4');
	// $preapprovalKey=$request->get('preapprovalKey');
	// get key from session
	  $preapprovalkey = \Session::get('preapprovalKey');
	//	$senderEmail = Input::get('senderEmail');
	//	dd($senderEmail);
	//dd( \Session::get('senderEmail')   );
	// creation 4 lignes de retrait	 
	 
  		 $retrait1 = new Retrait([ 'email' =>  $email , 'date' =>  $date1, 'preapprovalkey' =>  $preapprovalkey , 'amount' =>  $tranche , 'reservation' =>  $reservation  ]);
  		 $retrait2 = new Retrait([ 'email' =>  $email , 'date' =>  $date2, 'preapprovalkey' =>  $preapprovalkey , 'amount' =>  $tranche , 'reservation' =>  $reservation  ]);
  		 $retrait3 = new Retrait([ 'email' =>  $email , 'date' =>  $date3, 'preapprovalkey' =>  $preapprovalkey , 'amount' =>  $tranche , 'reservation' =>  $reservation  ]);
  		 $retrait4 = new Retrait([ 'email' =>  $email , 'date' =>  $date4, 'preapprovalkey' =>  $preapprovalkey , 'amount' =>  $tranche , 'reservation' =>  $reservation  ]);
	  
	   $retrait1->save(); 
	   $retrait2->save(); 
	   $retrait3->save(); 
	   $retrait4->save(); 
	  

		 $this->payertranche();
		 
	 return redirect('/reservations')->with('success', ' Accord fait avec succès  ');

 
    }	
	
  public function canceled(Request $request)
    {
        dd($request);

	return redirect('/');
    }	

  public function preapproved(Request $request)
    {
        dd($request);

	return redirect('/');
    }	
	
	
   public  function payertranche(  )
    {
 
		$now = date('Y-m-d H:i:s'); 
 		
    // tous les retraits non effectué
       $retraits= Retrait::where('statut',0)->get( );
	 foreach($retraits as $retrait){
         // vérification date retrait par rapport heure actuelle		 
		 if( $retrait->date < $now ){
			 
         $this->provider = new AdaptivePayments('preapproved-pay');

        $data = [
            'preapprovalKey'=>$retrait->preapprovalkey,
            'receivers'  => [
                [
                    'email'   => $retrait->email,
                    'amount'  => $retrait->amount,
                    
                ],
              
            ],
			//https://prenezunrendezvous.com/payertranche/11/mohamed.achraf.besbes@gmail.com/87.5/PA-7TU76130YT554970G
           //  'senderEmail'=>'haithemsahlia-buyer@gmail.com',
            'payer'      => 'EACHRECEIVER', // (Optional) Describes who pays PayPal fees. Allowed values are: 'SENDER', 'PRIMARYRECEIVER', 'EACHRECEIVER' (Default), 'SECONDARYONLY'
            'return_url' => URL::route('home' ),
            'cancel_url' => URL::route('cancelpay',['reservation'=>$retrait->reservation]),
        ];

        $response = $this->provider->createPayRequest($data);
		 
		if( $response['paymentExecStatus'] =='COMPLETED'){
			// mise à jour statut retrait à effectuer
			Retrait::where('id',$retrait->id)->update(
			array('statut'=>1)
			);
			
			
			
	$reservation=  $retrait->reservation ;
	    
 // Email
 $titre='Tranche';
        $Reservation = \App\Reservation::find( $reservation);
         $client =  \App\User::find($Reservation->client);
        $prestataire =  \App\User::find($Reservation->prestataire);
        $serviceid = $Reservation->service;
        $service = \App\Service::find( $serviceid) ;
          // mettre à jour le statut paiement de réservation
         Reservation::where('id',$reservation)->update(array('paiement' => 3,'reste'=>0));    
    // Email au client
        $message='Bonjour,<br>';
        $message.='Réservation payée('.$titre.')<br>';
        $message.='<b>Service :</b>  '.$service->nom.'  - ('.$service->prix.' €)  <br>';
        $message.='<b>Date :</b> '.$Reservation->date .' Heure : '.$Reservation->heure .'<br>';
        $message.='Prestataire <a href="https://prenezunrendezvous.com/'.$prestataire->titre.'/'.$prestataire->id.'" > '.$prestataire->name.' '.$prestataire->lastname .' </a>. <br>';
        $message.='<b>Service :</b>  '.$Reservation->nom_serv_res.'  - ('.$Reservation->Net.' €)  <br><br><br>';
        $message.='<b><a href="https://prenezunrendezvous.com/" > prenezunrendezvous.com </a></b>';    
        //enregistrement alerte
        $alerte = new Alerte([
             'user' => $client->id,
             'titre'=>'Réservation payée('.$titre.')',                         
             'details' => $message,
         ]);    
         $alerte->save();
        // Email au prestataire
        $message='Bonjour,<br>';
        $message.='Réservation payée('.$titre.')<br>';
        $message.='<b>Service :</b>  '.$service->nom.'  - ('.$service->prix.' €)  <br>';
        $message.='<b>Date :</b> '.$Reservation->date .' Heure : '.$Reservation->heure .'<br>';
        $message.='<b>Client :</b> '.$client->name.' '.$client->lastname .'<br><br>';
        $message.='<b><a href="https://prenezunrendezvous.com/" > prenezunrendezvous.com </a></b>';    
        
        $this->sendMail(trim($prestataire->email),'Réservation payée('.$titre.')',$message)    ;
        //enregistrement alerte
        $alerte = new Alerte([
             'user' => $prestataire->id,
             'titre'=>'Réservation payée('.$titre.')',                         
             'details' => $message,
         ]);    
         $alerte->save();        
        
        // enregistrement payment dans la base
        $paiement  =  new \App\Payment([
            // 'payer_id' => Input::get('PayerID'),
            // 'payment_id'=>Input::get('payment_id') ,                         
             'user' => $client->id,
             'beneficiaire' => $prestataire->name. ' '.$prestataire->lastname,
             'beneficiaire_id' => $prestataire->id ,
             'details' => 'paiement de réservation('.$titre.') pour : '.$prestataire->name. ' '.$prestataire->lastname,
         ]);    
         
         $paiement->save();        			
			
			
		 
			
			
			
		}
		 
         


		return $response;

 
		 } //if
	 }// foreach
       
       
    }
	
	
	 public  function payertranchesuccess($id)
	 {
		 
			Retrait::where('id',$id)->update(
			array('statut'=>1)
			); 
		 
	 }
	 
	 public function notification (Request $request)
	 {
		 dd($request);
		 
	 }

     public function oauth()
    {
        //session_start();
    //  DB::table('payments')
      $prestataire = auth()->user();
        $rurl = action('MyPaypalController@oauth');
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


}
