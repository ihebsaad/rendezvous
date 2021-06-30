<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use \App\Alerte;
use \App\Reservation;
use Gloudemans\Shoppingcart\Facades\Cart;
use Stripe\Stripe;
use Stripe\Account;
use Stripe\Product;
use Stripe\Price;

use Stripe\AccountLink;
use Stripe\PaymentIntent;
use Illuminate\Support\Arr;
use \App\Cartefidelite;
use DB;
use Route;

use Redirect;

use URL;
 use DateTime;
 use Swift_Mailer;
 use Mail;
class PaymentStripeController extends Controller
{
  public function addcustomerStripe(Request $request){
    $today = new DateTime();
    $today = $today->getTimestamp();
    $fin = strtotime('+95 day', $today);
    
    
    
    
    //dd($request);nom_serv_res
    $resId = $request->get('resId');
    $Reservation=Reservation::where('id',$resId)->first();

    $client = User::where('id',$Reservation->client)->first();
    $account = User::where('id',$Reservation->prestataire)->value('id_stripe');
    Stripe::setApiKey('sk_test_51IyZEOLYsTAPmLSFOUPFtTTEusJc2G7LSMDZEYDxBsv0iJblsOpt1dfaYu8PrEE6iX6IX7rCbpifzhdPfW7S0lzA007Y8kjGAx');

$pm = \Stripe\PaymentMethod::retrieve($request->get('valpaymentMethod'));
    $pm->attach(['customer' => $request->get('customerid')]);
    \Stripe\Customer::update(
        $request->get('customerid'),
        [
            'email' => $client->email,
            'invoice_settings' => [
              'default_payment_method' => $request->get('valpaymentMethod'),
            ],
        ]
    );


    
    $produit = Product::create([
    'name' => $Reservation->nom_serv_res,
    'type' => 'service',
  ]);
              $price = \Stripe\Price::create([
    'product' => $produit->id,
    'unit_amount' => ($Reservation->reste/4) *100,
    'currency' => 'usd',
    'recurring' => ['interval' => 'month'],
  ]);
             
  $Subscription = \Stripe\Subscription::create([
    'customer' => $request->get('customerid'),
    'cancel_at' => $fin ,
   
    'items' => [
      [
        'price' => $price->id ,
        'quantity' => 1,
      ],
    ],
    "transfer_data" => [
    "destination" => $account,
  ],
  ]);
  Reservation::where('id',$resId)->update(array('paiement' => 2,'reste'=>0));
    return $fin;
  }
    public function connect()
    {
    	//dd("ok");
      $cuser = auth()->user();
    	Stripe::setApiKey('sk_test_51IyZEOLYsTAPmLSFOUPFtTTEusJc2G7LSMDZEYDxBsv0iJblsOpt1dfaYu8PrEE6iX6IX7rCbpifzhdPfW7S0lzA007Y8kjGAx');

            /*$account = Account::create([
              'country' => 'CA',
              'type' => 'express',
            ]);*/
            
            $account = Account::create([
              'country' => 'CA',
              'type' => 'express',
              'capabilities' => [
                'card_payments' => [
                  'requested' => true,
                ],
                'transfers' => [
                  'requested' => true,
                ],
              ],
            ]);
            //dd($account);
            $account_links = AccountLink::create([
              'account' => $account->id,
              'refresh_url' => URL::route('reauth'),
              'return_url' => URL::route('return',['id_account'=>$account->id , 'id_prestataire'=>$cuser->id]),
              'type' => 'account_onboarding',
            ]);
            //dd($account_links->url);
           return redirect($account_links->url);

    }
    public function reauth()
    {
    	dd("ok");

    }
    public function return(Request $request)
    {
    	//dd($request->get());
      User::where('id', $request->get('id_prestataire'))->update(array('id_stripe' => $request->get('id_account') ));
      return redirect('/listing/'.$request->get('id_prestataire'));
    }
    public function pay($k)
    {
      $idprestataire=Reservation::where('id',$k)->value('prestataire');
      $idaccount = User::where('id',$idprestataire)->value('id_stripe');
      Stripe::setApiKey('sk_test_51IyZEOLYsTAPmLSFOUPFtTTEusJc2G7LSMDZEYDxBsv0iJblsOpt1dfaYu8PrEE6iX6IX7rCbpifzhdPfW7S0lzA007Y8kjGAx');

        //dd($request);
    $montant=Reservation::where('id',$k)->value('Net');

       
       
    $Reservation=Reservation::where('id',$k)->first();
    // Paiement d'acompte   
    //dd($Reservation);
    if($Reservation->paiement==0 || $Reservation->paiement ==null){

    $abonnement=User::where('id',$idprestataire)->value('abonnement');
        if ($abonnement==3) {
            $x=60 ;
        }elseif ($abonnement==2) {
            $x=50 ;
        }elseif ($abonnement==1) {
            $x=30 ;
        }
        $acompte=($montant*$x)/100 ;
    $reste=$montant-$acompte;


$intent = PaymentIntent::create([
            'amount' => $acompte*100,
            'currency' => 'eur',
        ], ['stripe_account' => $idaccount]);
//dd($intent);
        $clientSecret = Arr::get($intent, 'client_secret');

return view('payments.pay', [
            'clientSecret' => $clientSecret , 'idaccount' => $idaccount , 'Res' => $k
        ]);



  }// end acompte

  // paiement reste
  if($Reservation->paiement==1){
    
        $reste=$Reservation->reste;

$intent = PaymentIntent::create([
            'amount' => $reste*100,
            'currency' => 'eur',
        ], ['stripe_account' => $idaccount]);
 $clientSecret = Arr::get($intent, 'client_secret');
return view('payments.pay', [
            'clientSecret' => $clientSecret , 'idaccount' => $idaccount , 'Res' => $k
        ]);

    
    

  }// end pay rest


    }



  

    public function successpayStripe($k , Request $request)
    {
      //return $k ;

      $reservation = $k;
            $idprestataire=Reservation::where('id',$k)->value('prestataire');

      $Reservation=Reservation::where('id',$k)->first();
       $montant=Reservation::where('id',$k)->value('Net');
       // dd($Reservation);
      if($Reservation->paiement==0 || $Reservation->paiement ==null){
        $abonnement=User::where('id',$idprestataire)->value('abonnement');
        if ($abonnement==3) {
            $k=60 ;
        }elseif ($abonnement==2) {
            $k=50 ;
        }elseif ($abonnement==1) {
            $k=30 ;
        }
        $acompte=($montant*$k)/100 ;
        $reste=$montant-$acompte;
        $titre='Acompte';
        $type='acompte';

      } else
      { 
        $titre='Montant Restant';
        $type='reste';  
        $reste=0;


      }

    
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
        Reservation::where('id',$reservation)->update(array('paiement' => 1,'reste'=>$reste,'stripe_id'=>$request->paymentIntent));
          
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
               $message.= ' Prix:'.DB::table('produits')->where('id', $idp->ids )->value('prix_unité')."€ ";
              
               if (DB::table('produits')->where('id', $idp->ids )->value('type')=='Numérique') {
                if (DB::table('produits')->where('id', $idp->ids )->value('URL_telechargement')==Null) {
                  $message.=', <a href="https://prenezunrendezvous.com/public/Fichiers/'.DB::table('produits')->where('id', $idp->ids )->value('Fichier').'" download="'.DB::table('produits')->where('id', $idp->ids )->value('Fichier').'"> Télécharger mon produit </a>';
                } else {
                  $message.=', <a href="'.DB::table('produits')->where('id', $idp->ids )->value('URL_telechargement').'" > Télécharger mon produit </a>';
                }
                 
               }
                $message.= "), ";
                
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
          $this->sendMail(trim($client->email),'Réservation('.$titre.') payé',$message) ; 

        

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
              

       


    $message.='<br><b>Date :</b> '.$date .' Heure : '.$heure .'<br>';
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
    /*$paiement  =  new \App\Payment([
             'payer_id' => Input::get('PayerID'),
       'payment_id'=>Input::get('payment_id') ,            
             'user' => $client->id,
             'beneficiaire' => $prestataire->name. ' '.$prestataire->lastname,
             'beneficiaire_id' => $prestataire->id ,
             'details' => 'paiement de réservation('.$titre.') pour : '.$prestataire->name. ' '.$prestataire->lastname,
         ]);  
     
     $paiement->save();*/

     // avant la redirection on va sauvgarder l'évenement dans google Agenda si le type est acompte

    if($type=='acompte')
     {

    // ------------------sauvgarder l'évenement dans google calendar------------------------------------

  
    // fin if ( file json et les tokens existe)

   // --------------------fin sauvgarde au google calendar ----------------------------------------------------
  

     }// fin if $type=acompte
     
      
      return 'ok';


  }
public function Remboursement($k)
    {
        $stripe_id=Reservation::where('id',$k)->value('stripe_id');
        $idprestataire=Reservation::where('id',$k)->value('prestataire');
        $account = User::where('id',$idprestataire)->value('id_stripe');

       Stripe::setApiKey('sk_test_51IyZEOLYsTAPmLSFOUPFtTTEusJc2G7LSMDZEYDxBsv0iJblsOpt1dfaYu8PrEE6iX6IX7rCbpifzhdPfW7S0lzA007Y8kjGAx');

     $refund = \Stripe\Refund::create([
  'payment_intent' => $stripe_id,
], ['stripe_account' => $account]);



        dd($refund);

    }

public function pay4($resId)
    {
       Stripe::setApiKey('sk_test_51IyZEOLYsTAPmLSFOUPFtTTEusJc2G7LSMDZEYDxBsv0iJblsOpt1dfaYu8PrEE6iX6IX7rCbpifzhdPfW7S0lzA007Y8kjGAx');

         $customer = \Stripe\Customer::create();

    $setupIntent = \Stripe\SetupIntent::create([
      'customer' => $customer->id
    ]);
     $clientSecret = Arr::get($setupIntent, 'client_secret');
//dd($setupIntent);
        return view('payments.pay2', [
            'clientSecret' => $clientSecret , 'customerid' => $customer->id , 'resId' => $resId
        ]);
    dd($setupIntent);


    }






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









}
