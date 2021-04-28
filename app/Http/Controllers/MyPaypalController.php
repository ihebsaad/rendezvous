<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Route;
use App\Invoice;
use App\IPNStatus;
use App\Item;
use App\User;
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


class MyPaypalController extends Controller
{
	protected $provider;
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


    //-------------------------------------------payAcompteReservation---------------------------------------------
    public function payReservation(Request $request)
    {
        $montant=$request->get('montant');
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
		 //dd( $response);
		//$key='';
		//if(isset($response['payKey'])){$key=$response['payKey'];}

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
        // dd( $response);
		//$key='';
		//if(isset($response['payKey'])){$key=$response['payKey'];}
		//$redirect_url = $this->provider->getRedirectUrl('approved', $key);
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
		
		if($type=='acompte'){
				Reservation::where('id',$reservation)->update(array('paiement' => 1,'reste'=>$reste));	
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
				(<a href="https://localhost/rendezvous/reservations/modifier/'.$Reservation->id.'" > Lien </a>). <br>';
				$message.='-Au delà des 5 jours avant le rendez vous votre accompte ne sera pas remboursé.  <br>';
				$message.='-Au delà des 5 jours, Il vous sera impossible d`annuler ou de reporter le rendez-vous.  <br>';
				$message.='-Vous n`êtes pas venu au rendez-vous  pour x raison, votre accompte ne sera pas remboursé <br>car malheureusement beaucoup trop de clients prennent des rendez-vous et ne vienne pas sans prévenir et cela chamboule toute notre journée. <br> Merci d`avance d`être présent à votre rendez-vous et merci de votre compréhension. <br>';
				$message.='<b><a href="https://prenezunrendezvous.com/" > prenezunrendezvous.com </a></b>';
 

				
		 	    $this->sendMail(trim($client->email),'Réservation('.$titre.') payé',$message)	;	
		}
		if($type=='reste'){
			 Reservation::where('id',$reservation)->update(array('paiement' => 2,'reste'=>0));	
		}
  		
		
		
		 // Email
		$Reservation = \App\Reservation::find( $reservation);
		
 		$client =  \App\User::find($Reservation->client);
		$prestataire =  \App\User::find($Reservation->prestataire);
		$serviceid = $Reservation->service;
		
		$service = \App\Service::find( $serviceid) ;
		
		
    	
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
		
	    $this->sendMail(trim($prestataire->email),'Réservation payée',$message)	;
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
		 
		  return redirect('/reservations/')->with('success', ' Paiement ('.$titre.') effectué avec succès  ');


 
 
 
 
 
    }
	
	
//-------------------------------------------	
  public function cancelpay(Request $request)
    {
        dd($request);

return redirect('/');
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
		 
		//$enddate= date('Y-m-dTh:i:s',strtotime("+4 months"));
		//$enddate= date($today,strtotime("+4 months"));
		$enddate=date('Y-m-d\TH:i:s\Z',strtotime("+4 months")) ;

        $data = [
          //  "maxAmountPerPayment"=> 45.00, 
            "maxAmountPerPayment"=> $tranche, 
            "maxNumberOfPayments"=> 4, 
            'maxTotalAmountOfAllPayments'=> $montant,
           //  "endingDate" => "2021-09-02T20:40:52Z",
            "endingDate" => $enddate,
            // "startingDate" => "2021-05-02T10:45:52Z",
             "startingDate" => $today,
            'return_url' => URL::route('approved',['email'=>$email,'tranche'=>$tranche,'reservation'=>$reservation,'enddate'=>$enddate]),
            'cancel_url' => URL::route('canceled') ,
        ];
		//dd($data);
        $response = $this->provider->createPayRequest($data);
        //  dd($response);
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
	
	
	
	
  public function approved(Request $request)
    {
        dd($request);

	return redirect('/');
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
	
	
	
	

}
