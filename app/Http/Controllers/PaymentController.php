<?php
namespace App\Http\Controllers;

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
 


 
 use Swift_Mailer;
 use Mail;
 
class PaymentController extends Controller
{

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
		
		// Email au client
		$message='Bonjour,<br>';
		$message.='Réservation payée avec succès <br>';
		$message.='<b>Service :</b>  '.$service->nom.'  - ('.$service->prix.' €)  <br>';
		$message.='<b>Date :</b> '.$Reservation->date .' Heure : '.$Reservation->heure .'<br>';
		$message.='<b>Prestatire :</b> '.$prestataire->name.' '.$prestataire->lastname .'<br><br>';
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
		$message.='<b>Service :</b>  '.$service->nom.'  - ('.$service->prix.' €)  <br>';
		$message.='<b>Date :</b> '.$Reservation->date .' Heure : '.$Reservation->heure .'<br>';
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
			$datee = (new \DateTime())->modify('+366 days')->format($format);
		}
	  
		 }else{
			 

		 
		 // abonnement fait expiré
		  if($expiration< $today){
			 // today + abonnement
		if($abn!=3){$datee = (new \DateTime())->modify('+31 days')->format($format);}
		else{
			$datee = (new \DateTime())->modify('+366 days')->format($format);
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
		else{$daysToAdd = 365;}
		 
		 $newdate = $newdate->addDays($daysToAdd);
		 $datee =  $newdate;
 
		 }
		 			 
		 }
		 
      //  $date1 = (new \DateTime())->format('Y-m-d H:i:s');

       // $dtc = (new \DateTime())->modify('+31 days')->format($format);

		  
		User::where('id',$user)->update(array('expire' => $datee,'abonnement'=>$abn));
		
		
		 // Email
 		
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
	
	
	
	
	
	
	
	
	
	
	
	/****** Recurring *******/

public function createplan( )
{	
$plan_name=$request->get('plan_name');
$plan_description=$request->get('plan_description');
$amount=$request->get('amount');
	// Create a new billing plan
//if (! empty($_POST["plan_name"]) && ! empty($_POST["plan_description"]))  
    $plan = new Plan();
    $plan->setName($plan_name )
        ->setDescription($plan_description);

    // Set billing plan definitions
    $paymentDefinition = new PaymentDefinition();
    $paymentDefinition->setName('Regular Payments')
        ->setType('REGULAR')
        ->setFrequency('DAY')
        ->setFrequencyInterval('1')
        ->setCycles('4')
        ->setAmount(new Currency(array(
        'value' => $amount,
        'currency' => 'EUR'
    )));
$tranche=$amount/4;
$tranche=200;

    // Set charge models
    $chargeModel = new ChargeModel();
    $chargeModel->setType('SHIPPING')->setAmount(new Currency(array(
        'value' => $tranche,
        'currency' => 'EUR'
    )));
    $paymentDefinition->setChargeModels(array(
        $chargeModel
    ));

    // Set merchant preferences
    $merchantPreferences = new MerchantPreferences();
	
    $merchantPreferences
		->setReturnUrl(URL::route('statusplan'))
		//->setReturnUrl('http://<host>/how-to-manage-recurring-payments-using-paypal-subscriptions-in-php/index.php?status=success')
        ->setCancelUrl('https://prenezunrendezvous.com/')
        ->setAutoBillAmount('yes')
        ->setInitialFailAmountAction('CONTINUE')
        ->setMaxFailAttempts('3')
     /*   ->setSetupFee(new Currency(array(
        'value' => 0,
        'currency' => 'EUR'
    )))*/;

    $plan->setPaymentDefinitions(array(
        $paymentDefinition
    ));
    $plan->setMerchantPreferences($merchantPreferences);

    try {
        $createdPlan = $plan->create($apiContext);
    } catch (PayPal\Exception\PayPalConnectionException $ex) {
        echo $ex->getCode();
        echo $ex->getData();
        die($ex);
    } catch (Exception $ex) {
        die($ex);
    }
	
	
	
/***** activate Plan ***/	
	
try {
    $patch = new Patch();
    $value = new PayPalModel('{"state":"ACTIVE"}');
    $patch->setOp('replace')
        ->setPath('/')
        ->setValue($value);
    $patchRequest = new PatchRequest();
    $patchRequest->addPatch($patch);
    $createdPlan->update($patchRequest, $apiContext);
    $patchedPlan = Plan::get($createdPlan->getId(), $apiContext);
    
  //  require_once "createPHPTutorialSubscriptionAgreement.php";
} catch (PayPal\Exception\PayPalConnectionException $ex) {
    echo $ex->getCode();
    echo $ex->getData();
    die($ex);
} catch (Exception $ex) {
    die($ex);
}
	
/*********/	




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
    $agreement = $agreement->create($apiContext);
    
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
	
 	
	
	
public function	statusplan(){
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
		
if (!empty($_GET['status'])) {
    if($_GET['status'] == "success") {
        $token = $_GET['token'];
        $agreement = new \PayPal\Api\Agreement();
        
        try {
            // Execute agreement
            $agreement->execute($token, $apiContext);
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
        echo "user canceled agreement";
    }
    	\Session::put('error', 'Paiement plan échoué');
      //  return Redirect::route('/pay');
	    return redirect('/pay/')->with('error', ' Paiement échoué  ');
	
}		
		
		
 }
 	
	
	
	
	
	
}

?>