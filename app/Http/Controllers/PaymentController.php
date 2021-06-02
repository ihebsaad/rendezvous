<?php
namespace App\Http\Controllers;
use PayPal\Api\Details;
use PayPal\Api\Payee;
use PayPal\Exception\PayPalConnectionException;
use PHPUnit\TextUI\ResultPrinter;

use Route;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Agreement;
use PayPal\Api\Payer;
use PayPal\Api\Plan;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\PayerInfo;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls; 
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use Illuminate\Support\Facades\Input;
use Redirect;
use URL;
use DB;
use Illuminate\Support\Facades\Auth;
use Session;
use \App\User;
use \App\Reservation;
use \App\Alerte;

use Carbon\Carbon;
use \App\Cartefidelite;

use PayPal\Api\ChargeModel;
use PayPal\Api\Currency;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\Patch;
use PayPal\Api\PatchRequest;
use PayPal\Common\PayPalModel;
use PayPal\Api\ShippingAddress;
 
use PayPal\Api\BillingInfo;
use PayPal\Api\Invoice;
use PayPal\Api\InvoiceAddress;
use PayPal\Api\InvoiceItem;
use PayPal\Api\MerchantInfo;
use PayPal\Api\PaymentTerm;
use PayPal\Api\ShippingInfo;

use Illuminate\Support\Facades\Log;
use App\IPNStatus;
use App\Retrait;
use App\Service;


  use DateTime;
 use Swift_Mailer;
 use Mail;
 



use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;
class PaymentController extends Controller
{
	public function payAcompteReservation()
    {
    	dd("ok");
    }


	public function index()
    { 
 
		 $cuser = auth()->user();
		 
		$User =\App\User::find($cuser->id);
 		$user_type=$User->user_type;
		
		if($user_type=='admin' ){
        $payments = \App\Payment::orderBy('id','desc')->get();
		}else{
 
	$payments = DB::table('payments')
        //   ->where('name', '=', 'John')
           ->where(function ($query) use($cuser) {
               $query->where('user', $cuser->id)
                     ->orWhere('beneficiaire', $cuser->id);
           })
           ->orderBy('id','desc')->get();
		   
		}
		 
		//$this->sendMail('ihebsaad@gmail.com','Test','test Hello world')	;
        return view('payments.index', compact('payments'));
 
	}
	
	
	public function __construct()
    {

       if(Route::current()->action['as']=='payreservationwithemail' || Route::current()->action['as']=='statuspayreservationwithemail' || Route::current()->action['as']=='oauthCallback' || Route::current()->action['as']=='successpay2')
       {
        if(Route::current()->action['as']=='payreservationwithemail' || Route::current()->action['as']=='statuspayreservationwithemail' || Route::current()->action['as']=='successpay2' )
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

	/** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
	}	
	
	public function pay()
    {
		   return view('pay');
	}
	
	public function payWithpaypal(Request $request)
    {
		$payer = new Payer();
        $payer->setPaymentMethod('paypal');
		$item_1 = new Item();
		$item_1->setName('Item 1') /** item name **/
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($request->get('amount')); /** unit price **/
		$item_list = new ItemList();
        $item_list->setItems(array($item_1));
		$amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($request->get('amount'));
		$transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');
		$redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('status')) /** Specify return URL **/
            ->setCancelUrl(URL::route('status'));
		$payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {
		$payment->create($this->_api_context);
		} catch (\PayPal\Exception\PPConnectionException $ex) {
		if (\Config::get('app.debug')) {
	//	\Session::put('error', 'Session expirée');
     //           return Redirect::route('pay');
				return redirect('/pay')->with('error', ' Session expirée  ');

		} else {
		// \Session::put('error', 'erreur survenue');
        //        return Redirect::route('pay');
			 return redirect('/pay')->with('error', ' erreur survenue  ');

		}
		}
		foreach ($payment->getLinks() as $link) {
		if ($link->getRel() == 'approval_url') {
		$redirect_url = $link->getHref();
                break;
		}
		}
		/** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
		if (isset($redirect_url)) {
		/** redirect to paypal **/
            return Redirect::away($redirect_url);
		}
	//	\Session::put('error', 'Erreur survenue');
    //    return Redirect::route('pay');
	 return redirect('/pay')->with('error', ' erreur survenue  ');

	}
 
 
 
 	public function payreservation(Request $request)
    {
		$montant=$request->get('montant');
		$desc=$request->get('description');
		$reservation=$request->get('reservation');
		//dd($reservation);
		$payer = new Payer();
        $payer->setPaymentMethod('paypal');
		$item_1 = new Item();
		$item_1->setName('Item 1') /** item name **/
            ->setCurrency('EUR')
            ->setQuantity(1)
            ->setPrice($montant); /** unit price **/
		$item_list = new ItemList();
        $item_list->setItems(array($item_1));
		$amount = new Amount();
        $amount->setCurrency('EUR')
            ->setTotal($montant);
		$transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription($desc);
		$redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('statusres',['reservation'=>$reservation])) /** Specify return URL **/
            ->setCancelUrl(URL::route('statusres',['reservation'=>$reservation]));
		$payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {
		$payment->create($this->_api_context);
		} catch (\PayPal\Exception\PayPalConnectionException $ex) {
		if (\Config::get('app.debug')) {
	 	\Session::put('error', 'Session expirée');
     //           return Redirect::route('pay');
				return redirect('/reservations')->with('error', ' Session expirée  ');

		} else {
		// \Session::put('error', 'erreur survenue');
        //        return Redirect::route('pay');
			 return redirect('/reservations')->with('error', ' erreur survenue  ');

		}
		}
		foreach ($payment->getLinks() as $link) {
		if ($link->getRel() == 'approval_url') {
		$redirect_url = $link->getHref();
                break;
		}
		}
		/** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
		if (isset($redirect_url)) {
		/** redirect to paypal **/
            return Redirect::away($redirect_url);
		}
	//	\Session::put('error', 'Erreur survenue');
    //    return Redirect::route('pay');
	 return redirect('/reservations')->with('error', ' erreur survenue  ');

	}
 
 
  
  public function payabn(Request $request)
    {
		$montant=$request->get('amount');
		$user=$request->get('user');
		$abn=$request->get('abonnement');
		$desc=$request->get('description');
		 
		//$reservation=$request->get('reservation');
		$payer = new Payer();
        $payer->setPaymentMethod('paypal');
		$item_1 = new Item();
		$item_1->setName('Item 1') /** item name **/
            ->setCurrency('EUR')
            ->setQuantity(1)
            ->setPrice($montant); /** unit price **/
		$item_list = new ItemList();
        $item_list->setItems(array($item_1));
		$amount = new Amount();
        $amount->setCurrency('EUR')
            ->setTotal($montant);
		$transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Abonnement '. $desc );
		$redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('statusabn',['user'=>$user,'abn'=>$abn])) /** Specify return URL **/
            ->setCancelUrl(URL::route('pricing'));
		$payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {
		$payment->create($this->_api_context);
		} catch (\PayPal\Exception\PayPalConnectionException $ex) {
		if (\Config::get('app.debug')) {
	 	\Session::put('error', 'Session expirée');
     //           return Redirect::route('pay');
				return redirect('/pricing')->with('error', ' Session expirée  ');

		} else {
		// \Session::put('error', 'erreur survenue');
        //        return Redirect::route('pay');
			 return redirect('/pricing')->with('error', ' erreur survenue  ');

		}
		}
		foreach ($payment->getLinks() as $link) {
		if ($link->getRel() == 'approval_url') {
		$redirect_url = $link->getHref();
                break;
		}
		}
		/** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
		if (isset($redirect_url)) {
		/** redirect to paypal **/
            return Redirect::away($redirect_url);
		}
	//	\Session::put('error', 'Erreur survenue');
    //    return Redirect::route('pay');
	 return redirect('/pricing')->with('error', ' erreur survenue  ');

	}
  
  
  
  
  
  
 
 public function getPaymentStatus()
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
		/** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
		 \Session::put('error', 'Paiement échouée');
       //     return Redirect::route('/pay');
	     return redirect('/pay')->with('error', ' Paiement échouée  ');

		}
		$payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
		/**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
		if ($result->getState() == 'approved') {
		 \Session::put('success', 'Paiement avec succès');
        //    return Redirect::route('/pay');
		  return redirect('/pay/')->with('success', ' Paiement avec succès  ');

		}
		\Session::put('error', 'Paiement échoué');
      //  return Redirect::route('/pay');
	    return redirect('/pay/')->with('error', ' Paiement échoué  ');

	}
	
	
	 public function getPaymentStatusRes(Request $request)
    {
			$reservation=$request->get('reservation');
			//dd($reservation);
	
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
		/** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
		 \Session::put('error', 'Paiement échouée');
       //     return Redirect::route('/pay');
	     return redirect('/reservations')->with('error', ' Paiement échouée  ');

		}
		$payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
		/**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
		if ($result->getState() == 'approved') {
		 \Session::put('success', 'Paiement avec succès');
        //    return Redirect::route('/pay');

		 // ajouter +1 au carte fidelite --------------------------------------------------------------
		 //dd($reservation);
		$idclient=Reservation::where('id',$reservation)->value('client');
		//dd($idclient);
    	$idprestataire=Reservation::where('id',$reservation)->value('prestataire');
    	$test=Cartefidelite::where('id_client',$idclient)->where('id_prest',$idprestataire)->exists();
    	if ($test=='true') {
		//dd('okkkokokoko');
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
		// changement statut réservation
		Reservation::where('id',$reservation)->update(array('paiement' => 1));
		// ajout commission ici
		
		
		
		 // Email
		$Reservation = \App\Reservation::find( $reservation);
		
 		$client =  \App\User::find($Reservation->client);
		$prestataire =  \App\User::find($Reservation->prestataire);
		$serviceid = $Reservation->service;
		
		$service = \App\Service::find( $serviceid) ;

		// info prestation
        $infprests = rtrim($Reservation->nom_serv_res, ", ");
        if (strpos($infprests, ',') !== FALSE)
        {
          $titrprest ="les prestations";
          
        }
        else {
          $titrprest ="la prestation";
        }
		
		// Email au client
		$message='Bonjour,<br>';
		$message.='Réservation payée avec succès <br>';
		$message.='<b>'.$titrprest.' :</b>  '.$infprests.'<br>';
		$message.='<b>Totale :</b>  '.$Reservation->montant_tot.' €<br>';
		$message.='<b>Remise :</b>  '.$Reservation->Remise.' €<br>';
		$message.='<b>Montant payé :</b>  '.$Reservation->Net.' €<br>';
		$message.='<b>Date :</b> '.$Reservation->date_reservation .'<br>';
		$message.='<b>Prestataire :</b> '.$prestataire->name.' '.$prestataire->lastname .'<br><br>';
		$message.='<b><a href="https://prenezunrendezvous.com/" > prenezunrendezvous.com </a></b>';	
		
 	    $this->sendMail(trim($client->email),'Réservation payée',$message)	;
    	
		//enregistrement alerte
    	$alerte = new Alerte([
             'user' => $client->id,
			 'titre'=>'Réservation payée',						 
             'details' => $message,
         ]);	
		 $alerte->save();
 
		// Email au prestataire
		$message='Bonjour,<br>';
		$message.='Réservation payée<br>';
		$message.='<b>'.$titrprest.' :</b>  '.$infprests.'<br>';
		$message.='<b>Totale :</b>  '.$Reservation->montant_tot.' €<br>';
		$message.='<b>Remise :</b>  '.$Reservation->Remise.' €<br>';
		$message.='<b>Montant payé :</b>  '.$Reservation->Net.' €<br>';
		$message.='<b>Date :</b> '.$Reservation->date_reservation .'<br>';
		$message.='<b>Client :</b> '.$client->name.' '.$client->lastname .'<br><br>';
		$message.='<b><a href="https://prenezunrendezvous.com/" > prenezunrendezvous.com </a></b>';	
		
	    $this->sendMail(trim($prestataire->email),'Réservation payée',$message)	;
    	//enregistrement alerte
		$alerte = new Alerte([
             'user' => $prestataire->id,
			 'titre'=>'Réservation payée',						 
             'details' => $message,
         ]);	
		 $alerte->save();		
		
		// enregistrement payment dans la base
		$paiement  =  new \App\Payment([
             'payer_id' => Input::get('PayerID'),
			 'payment_id'=>$payment_id,						 
             'user' => $client->id,
             'beneficiaire' => $prestataire->name. ' '.$prestataire->lastname,
             'beneficiaire_id' => $prestataire->id ,
             'details' => 'paiement  de réservation pour : '.$prestataire->name. ' '.$prestataire->lastname,
         ]);	
		 
		 $paiement->save();
		 
		  return redirect('/reservations/')->with('success', ' Paiement effectué avec succès  ');

		}
		\Session::put('error', 'Paiement échoué');
      //  return Redirect::route('/pay');
	    return redirect('/reservations/')->with('error', ' Paiement échoué  ');

	}
	
	
	
	
		 public function getPaymentStatusAbn(Request $request)
    {
 			$user=$request->get('user');
			$abn=$request->get('abn');
	
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
		/** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
		 \Session::put('error', 'Paiement échouée');
       //     return Redirect::route('/pay');
	     return redirect('/reservations')->with('error', ' Paiement échouée  ');

		}
		$payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
		/**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
		if ($result->getState() == 'approved') {
		 \Session::put('success', 'Paiement avec succès');
        //    return Redirect::route('/pay');
		
		 $prestataire =  \App\User::find($user);
 
		// calcul expiration
		 $format = "Y-m-d H:i:s";
		 $today = (new \DateTime())->format($format);

		 $expiration= $prestataire->expire;
		 
		 
		 // aucun abonnement fait
		 if($expiration==''){
			 // today + abonnement
 		if($abn!=3){$datee = (new \DateTime())->modify('+31 days')->format($format);}
		else{
			//$datee = (new \DateTime())->modify('+366 days')->format($format);
			$datee = (new \DateTime())->modify('+31 days')->format($format);

		}
	  
		 }else{
			 

		 
		 // abonnement fait expiré
		  if($expiration< $today){
			 // today + abonnement
		if($abn!=3){$datee = (new \DateTime())->modify('+31 days')->format($format);}
		else{
			//$datee = (new \DateTime())->modify('+366 days')->format($format);
			$datee = (new \DateTime())->modify('+31 days')->format($format);

		}
		 }
		 
		 // abonnement fait et non expiré
		  if($expiration> $today){
			 // expiration + abonnement

			// $datee=$prestataire->expire->addDays(31);
			/// $prestataire->expire->addDays(31);
		/* $datee = ($expiration)->format($format);

		 $datee = (new \DateTime())->modify('+366 days')->format($format);
*/
		 $newdate = Carbon::createFromFormat('Y-m-d H:i:s', $prestataire->expire);
		 if($abn!=3){$daysToAdd = 31;}
		else{//$daysToAdd = 365;
           $daysToAdd = 31;
		}
		 
		 $newdate = $newdate->addDays($daysToAdd);
		 $datee =  $newdate;
 
		 }
		 			 
		 }
		 
      //  $date1 = (new \DateTime())->format('Y-m-d H:i:s');

       // $dtc = (new \DateTime())->modify('+31 days')->format($format);

		  
		User::where('id',$user)->update(array('expire' => $datee,'abonnement'=>$abn));
		if($abn==1){
		User::where('id',$user)->update(array('type_abonn_essai' => null,'type_abonn'=>'type1'));
		}
		if($abn==2){
		User::where('id',$user)->update(array('type_abonn_essai' => null,'type_abonn'=>'type2'));
		}
		if($abn==3){
		User::where('id',$user)->update(array('type_abonn_essai' => null,'type_abonn'=>'type3'));
		}
		
		 // Email
 		 $typeabn='';
  		 $parametres=DB::table('parametres')->where('id', 1)->first();
			if($abn==1){
				$abonnement='N°: 1 | ' .$parametres->abonnement1.' (mensuel)';
			}
			if($abn==2){
				$abonnement='N°: 2 | ' .$parametres->abonnement2.' (mensuel)';
			}
			if($abn==3){
				$abonnement='N°: 3 | ' .$parametres->abonnement3.' (annuel)';
			}
 		
		// Email au prestataire
		$message='Bonjour,<br>';
		$message.='Votre abonnement est payé avec succès <br>';
		$message.='Abonnement : '.$abonnement.'<br>';
		$message.="La date d'expiration de votre abonnement est : ". date('d/m/Y H:i', strtotime($datee))." <br>";
		$message.='<b><a href="https://prenezunrendezvous.com/" > prenezunrendezvous.com </a></b>';	
		
 	    $this->sendMail(trim($prestataire->email),'Abonnement payé',$message)	;
    	
		//enregistrement alerte
    	$alerte = new Alerte([
             'user' => $user,
			 'titre'=>'Abonnement payé',						 
             'details' => $message,
         ]);	
		 $alerte->save();
 
		// Email à l'admin
		$message='Bonjour,<br>';
		$message.='Abonnement payé : '.$abonnement.'<br>';
  		$message.='<b>Prestatire :</b> '.$prestataire->name.' '.$prestataire->lastname .'<br><br>';
		$message.='<b><a href="https://prenezunrendezvous.com/" > prenezunrendezvous.com </a></b>';	
		
	    $this->sendMail('saadiheb@gmail' ,'Abonnement payée',$message)	;
    	//enregistrement alerte
		$alerte = new Alerte([
             'user' => 1,
			 'titre'=>'Abonnement payé',						 
             'details' => $message,
         ]);	
		 $alerte->save();		
		
		// enregistrement payment dans la base
		$paiement  =  new \App\Payment([
             'payer_id' => Input::get('PayerID'),
			 'payment_id'=>$payment_id,						 
             'user' => $user,
             'beneficiaire' => 'prenezunrendezvous.com',
             'beneficiaire_id' => 1 ,
             'details' => 'paiement  de l\'abonnement : '.$abonnement,
         ]);	
		 
		 $paiement->save();
		 
		 // ajout abonnement
		 		$abonnement  =  new \App\Abonnement([
 			 'abonnement'=>$abn,						 
             'user' => $user,
              'details' =>  $abonnement,
              'expire' =>  $datee,
         ]);	
		 
		 $abonnement->save();
		 
		  return redirect('/abonnements/')->with('success', ' Paiement effectué avec succès  ');

		}
		\Session::put('error', 'Paiement échoué');
      //  return Redirect::route('/pay');
	    return redirect('/reservations/')->with('error', ' Paiement échoué  ');

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
	
	
	
	
	
	
	
	
	
	
	/****** Recurring *******/

public function createplan(Request $request)
{	

	//------------------------------------------------------------------------------------------------------
$plan = new Plan();
$plan->setName('T-Shirt of the Month Club Plan')
  ->setDescription('Template creation.')
  ->setType('FIXED');

// Set billing plan definitions
$paymentDefinition = new PaymentDefinition();
$paymentDefinition->setName('Regular Payments')
  ->setType('REGULAR')
  ->setFrequency('Month')
  ->setFrequencyInterval('2')
  ->setCycles('12')
  ->setAmount(new Currency(array('value' => 800, 'currency' => 'USD')));

// Set charge models
$chargeModel = new ChargeModel();
$chargeModel->setType('SHIPPING')
  ->setAmount(new Currency(array('value' => 10, 'currency' => 'USD')));
$paymentDefinition->setChargeModels(array($chargeModel));

// Set merchant preferences
$merchantPreferences = new MerchantPreferences();
$merchantPreferences->setReturnUrl(URL::route('statusagreement'))
  ->setCancelUrl('http://localhost:3000/cancel')
  ->setAutoBillAmount('yes')
  ->setInitialFailAmountAction('CONTINUE')
  ->setMaxFailAttempts('0')
  ->setSetupFee(new Currency(array('value' => 1, 'currency' => 'USD')));

$plan->setPaymentDefinitions(array($paymentDefinition));
$plan->setMerchantPreferences($merchantPreferences);
//dd($plan);


$request = clone $plan;
try {
    $output = $plan->create($this->_api_context);
} catch (Exception $ex) {
	dd("Erreur");
	//ResultPrinter::printError("Created Plan", "Plan", null, $request, $ex);
    exit(1);
}

//dd($output->getid());

//return $output;


try {
    $patch = new Patch();

    $value = new PayPalModel('{
	       "state":"ACTIVE"
	     }');

    $patch->setOp('replace')
        ->setPath('/')
        ->setValue($value);
    $patchRequest = new PatchRequest();
    $patchRequest->addPatch($patch);

    $output->update($patchRequest, $this->_api_context);

    $plan1 = Plan::get($output->getId(),  $this->_api_context);
} catch (Exception $ex) {
	dd("Erreur");
    //ResultPrinter::printError("Updated the Plan to Active State", "Plan", null, $patchRequest, $ex);
    exit(1);
}

 //ResultPrinter::printResult("Updated the Plan to Active State", "Plan", $plan->getId(), $patchRequest, $plan);

//dd($plan1->getId());

 // return redirect($response['paypal_link']);


// Create new agreement
$startDate = date('c', time() + 3600);
$given = new DateTime("now");
$st = $given->format("Y-m-d") . "T00:00:00Z";
//dd($startDate);
$agreement = new Agreement();
$agreement->setName('test1 ')
  ->setDescription('test2 ')
  ->setStartDate('2021-06-29T00:00:00Z');

// Set plan id
$plan = new Plan();
$plan->setId($plan1->getId());
//dd($plan);

$agreement->setPlan($plan);

// Add payer type
$payer = new Payer();
$payer->setPaymentMethod('paypal');
$agreement->setPayer($payer);
//dd($agreement);
// Adding shipping details
$shippingAddress = new ShippingAddress();
$shippingAddress->setLine1('111 First Street')
  ->setCity('Saratoga')
  ->setState('CA')
  ->setPostalCode('95070')
  ->setCountryCode('US');
  
$agreement->setShippingAddress($shippingAddress);
/*$payee = new Payee();
$payee->setEmail("mohamed.achraf.besbes@gmail.com");
$agreement->setInvoiceNumber(uniqid())
            ->setPayee($payee);*/
$request = clone $agreement;
try {
		$agreement->create($this->_api_context);
		$approvalUrl = $agreement->getApprovalLink();
		Session::put('status', 'success');
		return redirect($approvalUrl);

		dd($approvalUrl);
		} catch (\PayPal\Exception\PayPalConnectionException $ex) {
		if (\Config::get('app.debug')) {
	 	\Session::put('error', 'Session expirée');
     //           return Redirect::route('pay');
	 	dd($ex->getData());
				return redirect('/pricing')->with('error', ' Session expirée  ');

		} else {
		// \Session::put('error', 'erreur survenue');
        //        return Redirect::route('pay');
			 return redirect('/pricing')->with('error', ' erreur survenue  ');

		}
		}

	
	





// Create new agreement
$startDate = date('c', time() + 3600);
$agreement = new Agreement();
$agreement->setName($plan_name)
    ->setDescription($plan_description)
    ->setStartDate($startDate);

// Set plan id
$plan = new Plan();
$plan->setId($patchedPlan->getId());
$agreement->setPlan($plan);

// Add payer type
$payer = new Payer();
$payer->setPaymentMethod('paypal');
$agreement->setPayer($payer);

// Adding shipping details
$shippingAddress = new ShippingAddress();
$shippingAddress->setLine1('111 First Street')
    ->setCity('Saratoga')
    ->setState('CA')
    ->setPostalCode('95070')
    ->setCountryCode('US');
$agreement->setShippingAddress($shippingAddress);

try {
    // Create agreement
    $agreement = $agreement->create($this->_api_context);
    
    // Extract approval URL to redirect user
    $approvalUrl = $agreement->getApprovalLink();
    
    header("Location: " . $approvalUrl);
    exit();
} catch (PayPal\Exception\PayPalConnectionException $ex) {
    echo $ex->getCode();
    echo $ex->getData();
    die($ex);
} catch (Exception $ex) {
    die($ex);
}





	
} // end createPlan function
	
 	
	
	
public function	statusagreement(Request $request){
	//dd(Session::get('status'));
		/*
        $payment_id = Session::get('paypal_payment_id');
         Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
		 \Session::put('error', 'Paiement échouée');
       //     return Redirect::route('/pay');
	     return redirect('/pay')->with('error', ' Paiement échouée  ');

		}
		$payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
         $result = $payment->execute($execution, $this->_api_context);
		if ($result->getState() == 'approved') {
		 \Session::put('success', 'Paiement avec succès');
        //    return Redirect::route('/pay');
		  return redirect('/pay/')->with('success', ' Paiement avec succès  ');

		}
		\Session::put('error', 'Paiement échoué');
      //  return Redirect::route('/pay');
	    return redirect('/pay/')->with('error', ' Paiement échoué  ');
		*/
		
if (!empty(Session::get('status'))) {
    if(Session::get('status') == "success") {
    	
        $token = $_GET['token'];
        //dd($token);
        $agreement = new \PayPal\Api\Agreement();
        
        try {
            // Execute agreement
            $agreement->execute($token, $this->_api_context);
			 \Session::put('success', 'Paiement tranche avec succès');
        //    return Redirect::route('/pay');
		  return redirect('/pay/')->with('success', ' Paiement avec succès  ');

        } catch (PayPal\Exception\PayPalConnectionException $ex) {
            echo $ex->getCode();
            echo $ex->getData();
            die($ex);
        } catch (Exception $ex) {
            die($ex);
        }
    } else {
    	dd("no");
        echo "user canceled agreement";
    }
    dd("ooo");
    	\Session::put('error', 'Paiement plan échoué');
      //  return Redirect::route('/pay');
	    return redirect('/pay/')->with('error', ' Paiement échoué  ');
	
}		
		
		
 }
 	
	
 public function payreservationwithemail(Request $request)
 	{
 		//dd($request);
 		$montant=$request->get('montant');

       // dd($request->get('reservation'));
        $desc=$request->get('description');
        $reservation=$request->get('reservation');
        $prestId=$request->get('prest'); 
        $email=User::where('id',$prestId)->value('emailPaypal');
		$Reservation=Reservation::find( $reservation);
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



		
		$payee = new Payee();
		$payee->setEmail($email);
		 
		//$reservation=$request->get('reservation');
		$payer = new Payer();
        $payer->setPaymentMethod('paypal');
		$item_1 = new Item();
		$item_1->setName('Item 1') /** item name **/
            ->setCurrency('EUR')
            ->setQuantity(1)
            ->setPrice($acompte); /** unit price **/
		$item_list = new ItemList();
        $item_list->setItems(array($item_1));
		$amount = new Amount();
        $amount->setCurrency('EUR')
            ->setTotal($acompte);
		$transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Abonnement '. $desc )
            ->setInvoiceNumber(uniqid())
            ->setPayee($payee);
		$redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('statuspayreservationwithemail',['reservation'=>$reservation,'type'=>'acompte','reste'=>$reste])) /** Specify return URL **/
            ->setCancelUrl(URL::route('cancelpay',['reservation'=>$reservation]));
		$payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {
		$payment->create($this->_api_context);
		} catch (\PayPal\Exception\PayPalConnectionException $ex) {
		if (\Config::get('app.debug')) {
	 	\Session::put('error', 'Session expirée');
     //           return Redirect::route('pay');
				return redirect('/pricing')->with('error', ' Session expirée  ');

		} else {
		// \Session::put('error', 'erreur survenue');
        //        return Redirect::route('pay');
			 return redirect('/pricing')->with('error', ' erreur survenue  ');

		}
		}
		foreach ($payment->getLinks() as $link) {
		if ($link->getRel() == 'approval_url') {
		$redirect_url = $link->getHref();
                break;
		}
		}
		/** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
		if (isset($redirect_url)) {
		/** redirect to paypal **/
            return Redirect::away($redirect_url);
		}
	//	\Session::put('error', 'Erreur survenue');
    //    return Redirect::route('pay');
	 return redirect('/pricing')->with('error', ' erreur survenue  ');

	}// end acompte

	// paiement reste
	if($Reservation->paiement==1){
		
        $reste=$Reservation->reste;



		
		$payee = new Payee();
		$payee->setEmail($email);
		 
		//$reservation=$request->get('reservation');
		$payer = new Payer();
        $payer->setPaymentMethod('paypal');
		$item_1 = new Item();
		$item_1->setName('Item 1') /** item name **/
            ->setCurrency('EUR')
            ->setQuantity(1)
            ->setPrice($reste); /** unit price **/
		$item_list = new ItemList();
        $item_list->setItems(array($item_1));
		$amount = new Amount();
        $amount->setCurrency('EUR')
            ->setTotal($reste);
		$transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Abonnement '. $desc );
		$redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('statuspayreservationwithemail',['reservation'=>$reservation,'type'=>'reste','reste'=>0])) /** Specify return URL **/
            ->setCancelUrl(URL::route('cancelpay',['reservation'=>$reservation]));
		$payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {
		$payment->create($this->_api_context);
		} catch (\PayPal\Exception\PayPalConnectionException $ex) {
		if (\Config::get('app.debug')) {
	 	\Session::put('error', 'Session expirée');
     //           return Redirect::route('pay');
				return redirect('/pricing')->with('error', ' Session expirée  ');

		} else {
		// \Session::put('error', 'erreur survenue');
        //        return Redirect::route('pay');
			 return redirect('/pricing')->with('error', ' erreur survenue  ');

		}
		}
		foreach ($payment->getLinks() as $link) {
		if ($link->getRel() == 'approval_url') {
		$redirect_url = $link->getHref();
                break;
		}
		}
		/** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
		if (isset($redirect_url)) {
		/** redirect to paypal **/
            return Redirect::away($redirect_url);
		}
	//	\Session::put('error', 'Erreur survenue');
    //    return Redirect::route('pay');
	 return redirect('/pricing')->with('error', ' erreur survenue  ');

	}// end pay rest







}
	//---------------------------------------------------------------------------------------------------------------------------
	
 //---------------------------------------------------------------------------------------------------------------------------	
	 public function statuspayreservationwithemail(Request $request)
    {
 			
 			/** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
 			//dd($payment_id);

		/** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
		 \Session::put('error', 'Paiement échouée');
       //     return Redirect::route('/pay');
	     return redirect('/pay')->with('error', ' Paiement échouée  ');

		} 
		$payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
		/**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        
		if ($result->getState() == 'approved') {
		 \Session::put('success', 'Paiement avec succès');
        //    return Redirect::route('/pay');
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
		User::where('id',$Reservation->client)->update(array('emailPaypal' => ((($result->getpayer())->getPayerInfo())->getemail('email'))));

		if($type=='acompte'){
				Reservation::where('id',$reservation)->update(array('paiement' => 1,'reste'=>$reste,'statut'=>1));
					
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
		// dd("uoi");
		 // return redirect('/pay/')->with('success', ' Paiement avec succès  ');

		}
		\Session::put('error', 'Paiement échoué');
      //  return Redirect::route('/pay');


		dd("no");
	    return redirect('/pay/')->with('error', ' Paiement échoué  ');


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
	 public function PaymentDetails($id)
    {	
    	$Reservation=Reservation::find($id);
    	$amount = $Reservation->Net - $Reservation->reste ;
    	//dd();
    	$amount1 =strval($amount);

    	$email=User::where('id',$Reservation->client)->value('emailPaypal');

		
		$payee = new Payee();
		$payee->setEmail($email);
		 
		//$reservation=$request->get('reservation');
		$payer = new Payer();
        $payer->setPaymentMethod('paypal');
		$item_1 = new Item();
		$item_1->setName('Item 1') /** item name **/
            ->setCurrency('EUR')
            ->setQuantity(1)
            ->setPrice($amount1); /** unit price **/
		$item_list = new ItemList();
        $item_list->setItems(array($item_1));
		$amount = new Amount();
        $amount->setCurrency('EUR')
            ->setTotal($amount1);
		$transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Abonnement '. $desc )
            ->setInvoiceNumber(uniqid())
            ->setPayee($payee);
		$redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('successpay2',['reservation'=>$id])) /** Specify return URL **/
            ->setCancelUrl(URL::route('cancelpay2',['reservation'=>$reservation]));
		$payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {
		$payment->create($this->_api_context);
		} catch (\PayPal\Exception\PayPalConnectionException $ex) {
		if (\Config::get('app.debug')) {
	 	\Session::put('error', 'Session expirée');
     //           return Redirect::route('pay');
				return redirect('/pricing')->with('error', ' Session expirée  ');

		} else {
		// \Session::put('error', 'erreur survenue');
        //        return Redirect::route('pay');
			 return redirect('/pricing')->with('error', ' erreur survenue  ');

		}
		}
		foreach ($payment->getLinks() as $link) {
		if ($link->getRel() == 'approval_url') {
		$redirect_url = $link->getHref();
                break;
		}
		}
		/** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
		if (isset($redirect_url)) {
		/** redirect to paypal **/
            return Redirect::away($redirect_url);
		}
	//	\Session::put('error', 'Erreur survenue');
    //    return Redirect::route('pay');
	 return redirect('/pricing')->with('error', ' erreur survenue  ');

	

    }
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

	
}

?>