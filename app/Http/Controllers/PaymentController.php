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
 
class PaymentController extends Controller
{

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
		$payment = \App\Payment::get($payment_id, $this->_api_context);
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
	
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
		/** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
		 \Session::put('error', 'Paiement échouée');
       //     return Redirect::route('/pay');
	     return redirect('/reservations')->with('error', ' Paiement échouée  ');

		}
		$payment = \App\Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
		/**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
		if ($result->getState() == 'approved') {
		 \Session::put('success', 'Paiement avec succès');
        //    return Redirect::route('/pay');
		
		// changement statut réservation
		Reservation::where('id',$reservation)->update(array('paiement' => 1));
		
		
		 // Email
		$Reservation = \App\Reservation::find( $reservation);
		$client = $Reservation->client;
		$prestataire = $Reservation->prestataire;
		$serviceid = $Reservation->service;
		
		$service = \App\Service::find( $serviceid) ;
		
		// Email au client
		$message='';
		$message.='Réservation payée avec succès ';
		$message.='<b>Service :</b>  '.$service->nom.'  - ('.$service->prix.' )  <br>';
		$message.='<b>Date :</b> '.$Reservation->date .' Heure : '.$Reservation->heure .'<br>';
		$message.='<b>Prestatire :</b> '.$prestataire->name.' '.$prestataire->lastname .'<br>';
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
		$message='';
		$message.='Réservation payée';
		$message.='<b>Service :</b>  '.$service->nom.'  - ('.$service->prix.' )  <br>';
		$message.='<b>Date :</b> '.$Reservation->date .' Heure : '.$Reservation->heure .'<br>';
		$message.='<b>Client :</b> '.$client->name.' '.$client->lastname .'<br>';
		$message.='<b><a href="https://prenezunrendezvous.com/" > prenezunrendezvous.com </a></b>';	
		
	    $this->sendMail(trim($prestataire->email),'Réservation payée',$message)	;
    	//enregistrement alerte
		$alerte = new Alerte([
             'user' => $prestataire->id,
			 'titre'=>'Réservation payée',						 
             'details' => $message,
         ]);	
		 $alerte->save();		
		
		  return redirect('/reservations/')->with('success', ' Paiement avec succès  ');

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
	
	
	
	
	
	
	
	
}

?>