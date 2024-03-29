<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use \App\Payment;
use \App\Abonnement;
use \App\Alerte;
use \App\Happyhour;
use \App\Reservation;
use Gloudemans\Shoppingcart\Facades\Cart;
use Stripe\Stripe;
use Stripe\Account;
use Stripe\Product;
use Stripe\Price;
 use Message;
use Stripe\AccountLink;
use Stripe\PaymentIntent;
use Illuminate\Support\Arr;
use \App\Cartefidelite;
use DB;
use Route;
use Carbon\Carbon;
use Redirect;

use Session;
use URL;
use DateTime;
use Swift_Mailer;
use Mail;
use Auth;

class PaymentStripeController extends Controller
{
  public function addcustomerStripe(Request $request){
    Stripe::setApiKey('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');
    $subscription_id = $request->get('subscriptionId'); 
    $payment_method = $request->get('res');
      $stripeSub = \Stripe\Subscription::update(
    $subscription_id,
    ['default_payment_method' => $payment_method],
  );
//dd($stripeSub);
    $resId = $request->get('resId');
    \Session::put('success', 'Paiement avec succès');
    Reservation::where('id',$resId)->update(array('paiement' => 2,'reste'=>0));
    
    return "ok";
  }
  public function addcustomerStripeAbn(Request $request){
    Stripe::setApiKey('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');
    $subscription_id = $request->get('subscriptionId'); 
    $payment_method = $request->get('res');
      $stripeSub = \Stripe\Subscription::update(
    $subscription_id,
    ['default_payment_method' => $payment_method],
  );
//dd($stripeSub);
   
    \Session::put('success', 'Paiement avec succès');
    
    return "ok";
  }
    public function connect()
    {
    	//dd("ok");
      $cuser = auth()->user();
    	Stripe::setApiKey('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');

            /*$account = Account::create([
              'country' => 'CA',
              'type' => 'express',
            ]);*/
            
            $account = Account::create([
              
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
    public function reauth(Request $request)
    {
    	//dd($request); //errorStripeConnect.blade
      return view('errorStripeConnect');

    }
    public function return(Request $request)
    {
    	//dd($request->get());
      User::where('id', $request->get('id_prestataire'))->update(array('id_stripe' => $request->get('id_account') ));
      \Session::put('StripeMessage', 'La connexion avec votre compte stripe est effectuée avec succès');
      return redirect('/portefeuilles/'.$request->get('id_prestataire'));
    }
    public function pay($k)
    {
      $idprestataire=Reservation::where('id',$k)->value('prestataire');
      $idaccount = User::where('id',$idprestataire)->value('id_stripe');
      //Stripe::setApiKey('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');
      Stripe::setApiKey('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');

        //dd($request);
    $montant=Reservation::where('id',$k)->value('Net');

       
       
    $Reservation=Reservation::where('id',$k)->first();
    // Paiement d'acompte   
    //dd($Reservation);
    if($Reservation->paiement==0 || $Reservation->paiement ==null){

    $abonnement=User::where('id',$idprestataire)->value('abonnement');
    $pcgAcompte=User::where('id',$idprestataire)->value('acompte');
       /* if ($abonnement==3) {
            $x=60 ;
        }elseif ($abonnement==2) {
            $x=50 ;
        }elseif ($abonnement==1) {
            $x=30 ;
        }*/
        $acompte=($montant*$pcgAcompte)/100 ;
    $reste=$montant-$acompte;

//dd($idaccount);
$intent = PaymentIntent::create([
            'amount' => intval($acompte*100),
            'currency' => 'eur',
        ], ['stripe_account' => $idaccount]);
        /*$intent = PaymentIntent::create([
            'amount' => $acompte*100,
            'currency' => 'eur',
        ]);*/
//dd($intent);
        $clientSecret = Arr::get($intent, 'client_secret');

return view('payments.pay', [
            'clientSecret' => $clientSecret , 'idaccount' => $idaccount , 'Res' => $k, 'acompte' => 1 , 'valAcompte' => $acompte
        ]);



  }// end acompte

  // paiement reste
  if($Reservation->paiement==1){
    
        $reste=$Reservation->reste;

$intent = PaymentIntent::create([
            'amount' => intval($reste*100),
            'currency' => 'eur',
        ], ['stripe_account' => $idaccount]);
 $clientSecret = Arr::get($intent, 'client_secret');
return view('payments.pay', [
            'clientSecret' => $clientSecret , 'idaccount' => $idaccount , 'Res' => $k , 'acompte' => 0 , 'valAcompte' => 0
        ]);

    
    

  }// end pay rest 


    }
public function payabnMensuel(Request $request)
{
//dd(Session::get('email'));
       //Stripe::setApiKey('sk_test_51IyZEOLYsTAPmLSFOUPFtTTEusJc2G7LSMDZEYDxBsv0iJblsOpt1dfaYu8PrEE6iX6IX7rCbpifzhdPfW7S0lzA007Y8kjGAx');
  $montant=$request->get('amount');
  
    $user=$request->get('user');
    $abn=$request->get('abonnement');
    $desc=$request->get('description');

    $nature_abonn=$request->get('nature_abonn');

    $mensuel_annuel='';
    if($nature_abonn=="offre_lanc"){
        //$mensuel_annuel=$request->get('mensuel_annuel');
       $mensuel_annuel=Session::get('mensuel_annuel');

      }
     //dd($mensuel_annuel);
   // nouvelle inscription 
       $username=0;
       $name=0;
       $lastname=0;
       $phone=0;
       $email=0;

       $titre=0;
       $siren=0;
       $adresse=0;
       $ville=0;
       $codep=0;

       $fhoraire=0;
       $date_inscription=0;
       $urlqrcode=0;
       $user_type=0;
       $password=0;
       $ind_tel=0;
       $pays=0; 

     if($user==0)
     {


       $username=Session::get('username');
       $name=Session::get('name');
       $lastname=Session::get('lastname');
       $phone=Session::get('phone');
       $email=Session::get('email');

       $titre=Session::get('titre');
       $siren=Session::get('siren');
       $adresse=Session::get('adresse');
       $ville=Session::get('ville');
       $codep=Session::get('codep');

       $fhoraire=Session::get('fhoraire');
       $date_inscription=Session::get('date_inscription');
       $urlqrcode=Session::get('qr_code');
       $user_type=Session::get('user_type');
       $password=Session::get('password');
       $pays=Session::get('pays');
       $ind_tel=Session::get('ind_tel');

   // dd( $urlqrcode);
     }
       $today = new DateTime();
    $today = $today->getTimestamp();
    $fin = strtotime('+350 day', $today);
    
    //Stripe::setApiKey('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');
    Stripe::setApiKey('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');

$customer = \Stripe\Customer::create();
    \Stripe\Customer::update(
        $customer->id,
        [
            'email' => Session::get('email'),
            
        ]
    );


    
    $produit = Product::create([
    'name' => 'Abonnement mensuel',
    'type' => 'service',
  ]);
    $price = \Stripe\Price::create([
    'product' => $produit->id,
    'unit_amount' => $montant *100,
    'currency' => 'eur',
    'recurring' => ['interval' => 'month'],
  ]);
             
  $Subscription = \Stripe\Subscription::create([
    'customer' => $customer->id,
    'cancel_at' => $fin ,
   
    'items' => [
      [
        'price' => $price->id ,
        'quantity' => 1,
      ],
    ],
    'payment_behavior' => 'default_incomplete',
    'expand' => ['latest_invoice.payment_intent'],
    
  ]);
  //dd($Subscription);
  $clientSecret = Arr::get($Subscription->latest_invoice->payment_intent, 'client_secret');
  $subscriptionId = Arr::get($Subscription, 'id');
  //dd($clientSecret);
  return view('payments.payAbn3', [
            'clientSecret' => $clientSecret ,'subscriptionId' => $subscriptionId , 'customerid' => $customer->id ,'montant'=>$montant, 'usr' => $user , 'abn' => $abn, 'nature_abonn' => $nature_abonn,'mensuel_annuel' => $mensuel_annuel, 'abn' => $abn, 'username' => $username , 'name' => $name , 'lastname' => $lastname, 'phone' => $phone, 'email' => $email , 'titre' => $titre ,'siren' => $siren , 'adresse' => $adresse, 'ville' => $ville ,'codep' => $codep ,'fhoraire' => $fhoraire, 'date_inscription' => $date_inscription , 'urlqrcode' => $urlqrcode ,'user_type' => $user_type ,  'password' => $password,'ind_tel' => $ind_tel ,  'pays' => $pays
        ]);

    }
 public function payabn(Request $request)
    { 
      
      $abn=$request->get('abonnement');
      if($abn=="2"){
        $mensuel_annuel="annuel";}else{$mensuel_annuel="mensuel";}
    $montant=$request->get('amount');
    $user=$request->get('user');
    $desc=$request->get('description');
    $nature_abonn=$request->get('nature_abonn');
    if($nature_abonn=="offre_lanc"){
       // $mensuel_annuel=$request->get('mensuel_annuel');

      }
     //dd($mensuel_annuel);
   // nouvelle inscription 
       $username=0;
       $name=0;
       $lastname=0;
       $phone=0;
       $email=0;

       $titre=0;
       $siren=0;
       $adresse=0;
       $ville=0;
       $codep=0;

       $fhoraire=0;
       $date_inscription=0;
       $urlqrcode=0;
       $user_type=0;
       $password=0;
       $ind_tel=0;
       $pays=0; 

     if($user==0)
     {


       $username=Session::get('username');
       $name=Session::get('name');
       $lastname=Session::get('lastname');
       $phone=Session::get('phone');
       $email=Session::get('email');

       $titre=Session::get('titre');
       $siren=Session::get('siren');
       $adresse=Session::get('adresse');
       $ville=Session::get('ville');
       $codep=Session::get('codep');

       $fhoraire=Session::get('fhoraire');
       $date_inscription=Session::get('date_inscription');
       $urlqrcode=Session::get('qr_code');
       $user_type=Session::get('user_type');
       $password=Session::get('password');
       $pays=Session::get('pays');
       $ind_tel=Session::get('ind_tel');
       $typeAbn=Session::get('typeAbn');

   // dd( $urlqrcode);
     }
    Stripe::setApiKey('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');    


     // Stripe::setApiKey('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');


  $intent = PaymentIntent::create([
            'amount' => $montant*100,
            'currency' => 'eur',
        ]);
 // dd($intent);
 $clientSecret = Arr::get($intent, 'client_secret');



/*return view('payments.payAbn', [
            'clientSecret' => $clientSecret , 'usr' => $user , 'abn' => $abn, 'nature_abonn' => $nature_abonn
        ]);*/
return view('payments.payAbn2', [
            'clientSecret' => $clientSecret ,'montant'=>$montant, 'usr' => $user , 'abn' => $abn, 'nature_abonn' => $nature_abonn,'mensuel_annuel' => $mensuel_annuel, 'abn' => $abn, 'username' => $username , 'name' => $name , 'lastname' => $lastname, 'phone' => $phone, 'email' => $email , 'titre' => $titre ,'siren' => $siren , 'adresse' => $adresse, 'ville' => $ville ,'codep' => $codep ,'fhoraire' => $fhoraire, 'date_inscription' => $date_inscription , 'urlqrcode' => $urlqrcode ,'user_type' => $user_type ,  'password' => $password,'ind_tel' => $ind_tel ,  'pays' => $pays ,'desc' => $desc]);


   
  }
   public function successpayAbnStripe($k , Request $request)
    {
    $user=$k;
    $abn=$request->get('abn');
    $nature_abonn=$request->get('nature_abonn');
    $mensuel_annuel='';
    if($nature_abonn=="offre_lanc"){
        $mensuel_annuel=$request->get('mensuel_annuel');
      }

    $montant='';
    if($request->get('montant'))
    {
       $montant=$request->get('montant');
    }
   
    

     $prestataire='';
    if($user==0)
    {
        
       $username=$request->get('username');
       $name=$request->get('name');
       $lastname=$request->get('lastname');
       $phone=$request->get('phone');
       $email=$request->get('email');

       $titre=$request->get('titre');
       $siren=$request->get('siren');
       $adresse=$request->get('adresse');
       $ville=$request->get('ville');
       $codep=$request->get('codep');

       $fhoraire=$request->get('fhoraire');
       $date_inscription=$request->get('date_inscription');
       $urlqrcode=$request->get('urlqrcode');
       $user_type=$request->get('user_type');
       $password=$request->get('password');
       $pays=$request->get('pays');
       $ind_tel=$request->get('ind_tel');
      
    
        
        $prestataire= User::create ([
            'username' => $username,
            'name' => $name,
            'lastname' =>  $lastname,
            'phone' => $phone,
            'email' => $email,
            'titre' => $titre,
            'siren' => $siren,
            'adresse' => $adresse,
            'ville' => $ville,
            'codep' => $codep,
            'fhoraire' => $fhoraire,
            'date_inscription' => $date_inscription,
           
            'qr_code'=> $urlqrcode,
            'user_type' => $user_type,
            'password' =>$password,
             'pays' => $pays,
             'ind_tel' =>$ind_tel,
        ]);

        //$prestataire->save();
        Auth::login($prestataire);


    }
    else
    {

       $prestataire =  \App\User::find($user);

    }
   
     $user=$prestataire->id;
  

  \Session::put('success', 'Paiement avec succès');
        //    return Redirect::route('/pay');
    
     //$prestataire =  \App\User::find($user);
 
    // calcul expiration
     $format = "Y-m-d H:i:s";
     $today = (new \DateTime())->format($format);

     $expiration= $prestataire->expire;

     //mettre a jour mensuel ou annuel

      if($nature_abonn=="offre_lanc"){

        if($mensuel_annuel=='mensuel')
        {
          
          User::where('id',$user)->update(array('annuel_mensuel' =>'mensuel'));
        }
        else
        {

          User::where('id',$user)->update(array('annuel_mensuel' =>'annuel'));
        }

      }

      //dernier montant payé par le prestataire
       if($montant){
        User::where('id',$user)->update(array('dernier_montant' =>$montant));
       }
     
     // aucun abonnement fait
     if($expiration==''){
       // today + abonnement
    if($abn!=3)//abon annuel
      {$datee = (new \DateTime())->modify('+366 days')->format($format);}
    else{
      //$abon 2 (mensuel)

      $datee = (new \DateTime())->modify('+366 days')->format($format);

      
    }
    
     }else{
       

     
     // abonnement fait expiré
      if($expiration< $today){
       // today + abonnement
    if($abn!=3)
      {$datee = (new \DateTime())->modify('+366 days')->format($format);}
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
     $daysToAdd='';
     $newdate = Carbon::createFromFormat('Y-m-d H:i:s', $prestataire->expire);
     if($abn!=3){$daysToAdd = 366;}
    else{

      $daysToAdd = 366;        
           
    }
     
     $newdate = $newdate->addDays($daysToAdd);
     $datee =  $newdate;
 
     }
           
     }
     
      //  $date1 = (new \DateTime())->format('Y-m-d H:i:s');

       // $dtc = (new \DateTime())->modify('+31 days')->format($format);
    if($nature_abonn=="normal"){
    User::where('id',$user)->update(array('nature_abonn' =>'normal'));
    }
    if($nature_abonn=="offre_lanc"){
    User::where('id',$user)->update(array('nature_abonn' => 'offre_lance_ann1'));
    }

      
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
    
    // ajout abonnement
        $abonnement  =  new \App\Abonnement([
       'abonnement'=>$abn,             
             'user' => $user,
              'details' =>  $abonnement,
              'expire' =>  $datee,
         ]);  
     
     $abonnement->save();
     if($mensuel_annuel=='mensuel')
        {
          Abonnement::where('id',$abonnement->id)->update(array('IdStripe' => $request->get('subscriptionId')));
        }
     
     // Email
     $typeabn='';
       $parametres=DB::table('parametres')->where('id', 1)->first();
      if($nature_abonn=="normal"){ 
      if($abn==1){
        $abonnement='N°: 1 | ' .$parametres->abonnement1.' (annuel)';
      }
      if($abn==2){
        $abonnement='N°: 2 | ' .$parametres->abonnement2.' (abonnement mensuel)('.$parametres->cout_abon_annu_pricing.'/ mois)';
      }
      if($abn==3){
        $abonnement='N°: 3 | ' .$parametres->abonnement3.' (abonnement mensuel)('.$parametres->cout_abon_mens_pricing.'/ mois)';
      }
      }
    
      else
      {

        if($abn==3)
        {
          
        $abonnement='offre de Lancement | ' .$parametres->cout_offrelancement3_mens.' euros pour chaque mois';
        }
        else
        {

        $abonnement='offre de Lancement | ' .$parametres->cout_offrelancement3.' euros pour chaque mois';

        }

      }
    // Email au prestataire
    $message='Bonjour,<br>';
    $message.='Votre abonnement est payé avec succès <br>';
    $message.='Abonnement : '.$abonnement.'<br>';
    $message.="La date d'expiration de votre abonnement est : ". date('d/m/Y H:i', strtotime($datee))." <br>";
    $message.='<b><a href="https://prenezunrendezvous.com/" > prenezunrendezvous.com </a></b>'; 
    
    //mohamed.achraf.besbes@gmail.com
    if($prestataire)
    {
      if(trim($prestataire->email))
      {
        try {
        $this->sendMail(trim($prestataire->email),'Abonnement payé',$message) ;
       // break;
    } catch (\Swift_TransportException $e) {
        
    }
    // sms au prestataire
    $messageTel='Bonjour,';
    $messageTel.='Votre abonnement est payé avec succès ';
    $messageTel.='Abonnement : '.$abonnement.'';
    $messageTel.="La date d'expiration de votre abonnement est : ". date('d/m/Y H:i', strtotime($datee))." ";
    $messageTel.='https://prenezunrendezvous.com/'; 
    $numtel = $prestataire->tel ;
          try {
      
          $response = Message::send([
          'to' => $numtel,
          'text' => $messageTel
        ]);

    } catch (\SMSFactor\Error\Api $e) {

    }
         
      }

    }
    // $this->sendMail(trim($prestataire->email),'Abonnement payé',$message) ;
    // $this->sendMail('kbskhaled@gmail.com','Abonnement payé',$message) ;
    //enregistrement alerte
      $alerte = new Alerte([
             'user' => $user,
       'titre'=>'Abonnement payé',             
             'details' => $message,
         ]);  
     $alerte->save();
     $nom_p='';
     $prenom_p='';
     if($prestataire->name)
     {
        $nom_p=$prestataire->name;
     }
      if($prestataire->lastname)
     {
       $prenom_p=$prestataire->lastname; 
     }
 
    // Email à l'admin
    $message='Bonjour,<br>';
    $message.='Abonnement payé : '.$abonnement.'<br>';
    $message.='<b>Prestataire :</b> '.$nom_p.' '.$prenom_p.'<br>';
    $message.='<b>Téléphone Prestataire :</b>'.$prestataire->phone .'<br>';
    $message.='<b><a href="https://prenezunrendezvous.com/" > prenezunrendezvous.com </a></b>'; 
  //trouvezunprestataire@gmail.com
    try {
        $this->sendMail('trouvezunprestataire@gmail.com' ,'Abonnement payée - Prestataire : '.$nom_p.' '.$prenom_p,$message);
       // break;
    } catch (\Swift_TransportException $e) {
        
    }
    
  //kbskhaledfb@gmail.com  trouvezunprestataire@gmail.com
  // $this->sendMail('kbskhaledfb@gmail.com' ,'Abonnement payée - Prestataire : '.$nom_p.' '.$prenom_p,$message)  ;
      //enregistrement alerte
    $alerte = new Alerte([
             'user' => 1,
       'titre'=>'Abonnement payé',             
             'details' => $message,
         ]);  
     $alerte->save();   
    
  /*  // enregistrement payment dans la base
    $paiement  =  new \App\Payment([
             'payer_id' => ' ',
       'payment_id'=>$request->get('paymentIntent'),            
             'user' => $user,
             'beneficiaire' => 'prenezunrendezvous.com',
             'beneficiaire_id' => 1 ,
             'details' => 'paiement  de l\'abonnement : '.$abonnement,
         ]);  
     
     $paiement->save();*/
     
     
      return "ok";


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
        $pcgAcompte=User::where('id',$idprestataire)->value('acompte');
      /*  if ($abonnement==3) {
            $k=60 ;
        }elseif ($abonnement==2) {
            $k=50 ;
        }elseif ($abonnement==1) {
            $k=30 ;
        }*/
        $acompte=($montant*$pcgAcompte)/100 ;
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
     $Happyhourval = DB::table('reservations')->where('id', $reservation )->value('happyhourval');
      if ($Happyhourval != 0) { 
      $B=Happyhour::where('id',$Happyhourval)->value('Beneficiaries');
      Happyhour::where('id', $Happyhourval)->update(array("Beneficiaries"=> $B + 1));
    }
      $a= new Payment([
                 'user' => $client->id,
                 'beneficiaire_id'=> $prestataire->id,
                 'beneficiaire'=>$prestataire->titre,
                 'details' => "Acompte payé pour la réservation : ".$reservation,
                 'montant' => $acompte
             ]);
            $a->save();  
        Reservation::where('id',$reservation)->update(array('statut' => 1,'paiement' => 1,'reste'=>$reste,'stripe_id'=>$request->paymentIntent));
          
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
          
          try {
        $this->sendMail(trim($client->email),'Réservation payé ('.$titre.')',$message) ;
       // break;
    } catch (\Swift_TransportException $e) {
        
    } 
    // sms au client
        $messageTel='Bonjour, ';
        $messageTel.='Réservation ('.$titre.') payée avec succès ';
        $messageTel.='Votre rendez-vous  est confirmé le '.$date .' à '.$heure .' avec le prestataire : '.$prestataire->name.' '.$prestataire->lastname .' . ';
        $messageTel.='Services :  ';
          foreach ($servicesres as $servicesre) {
         // echo $servicesres;
        $messageTel.=  DB::table('services')->where('id', $servicesre )->value('nom');
         $messageTel.=" ( ".DB::table('services')->where('id', $servicesre )->value('prix')."€ )";
         
         if ($Reservation->recurrent==1) {
        $messageTel.= "  abonnement " ;
      }
      $messageTel.= ", ";
      }


        $messageTel.=' Produits :  ';
          foreach ($idproduits as $idp) {

               $messageTel.=  ' '.DB::table('produits')->where('id', $idp->ids )->value('nom_produit').'';
               $messageTel.=  '( Quantité:'.$idp->qty.',';
               $messageTel.= ' Prix:'.DB::table('produits')->where('id', $idp->ids )->value('prix_unité')."€ ";
              
               if (DB::table('produits')->where('id', $idp->ids )->value('type')=='Numérique') {
                if (DB::table('produits')->where('id', $idp->ids )->value('URL_telechargement')==Null) {
                  $messageTel.=', https://prenezunrendezvous.com/public/Fichiers/'.DB::table('produits')->where('id', $idp->ids )->value('Fichier').'" download="'.DB::table('produits')->where('id', $idp->ids )->value('Fichier').'';
                } else {
                  $messageTel.=', '.DB::table('produits')->where('id', $idp->ids )->value('URL_telechargement').'';
                }
                 
               }
                $messageTel.= "), ";
                
              } 


              if ($Reservation->serv_suppl != null) {
               $messageTel.=' Cadeaux :  '.$Reservation->serv_suppl.'';
              }
              

              
   
        $messageTel.=' https://prenezunrendezvous.com/';
    //dd(($client->email));
$numtel = $client->tel ;
          try {
      
          $response = Message::send([
          'to' => $numtel,
          'text' => $messageTel
        ]);

    } catch (\SMSFactor\Error\Api $e) {

    }
        

    } // fin if type == acompte
    if($type=='reste'){
      $a= new Payment([
                 'user' => $client->id,
                 'beneficiaire_id'=> $prestataire->id,
                 'beneficiaire'=>$prestataire->titre,
                 'details' => "Total payé pour la réservation : ".$reservation,
                 'montant' => $Reservation->Net
             ]);
            $a->save(); 
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
        try {
        $this->sendMail(trim($client->email),'Réservation payé ('.$titre.')',$message) ;
       // break;
    } catch (\Swift_TransportException $e) {
        
    } 
    // Email au client
        $messageTel='Bonjour, ';
        $messageTel.='Réservation ('.$titre.') payée avec succès <br>';
        $messageTel.='Votre rendez-vous  est confirmé le '.$date .' à '.$heure .' avec le prestataire '.$prestataire->name.' '.$prestataire->lastname .'. ';
        $messageTel.=' Service :  '.$Reservation->nom_serv_res.'  - ('.$Reservation->Net.' €) ';
          
        
        $messageTel.=' https://prenezunrendezvous.com/';
   $numtel = $client->tel ;
          try {
      
          $response = Message::send([
          'to' => $numtel,
          'text' => $messageTel
        ]);

    } catch (\SMSFactor\Error\Api $e) {

    }
       
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
    $message.='Réservation payée ('.$titre.')<br>';

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

    
        
         try {
          if($type=='acompte')
     {
       $this->sendMail(trim($prestataire->email),'Nouvelle Réservation (Acompte payé)',$message)    ;
       // break;

     } else {
      $this->sendMail(trim($prestataire->email),'Réservation payée ('.$titre.')',$message)    ;
     }
    } catch (\Swift_TransportException $e) {
        
    } 
    // sms au prestataire
    $messageTel='Bonjour, ';
    $messageTel.='Réservation payée ('.$titre.') ';

    $messageTel.=' Services :  ';
          foreach ($servicesres as $servicesre) {
         // echo $servicesres;
        $messageTel.=  DB::table('services')->where('id', $servicesre )->value('nom');
         $messageTel.=" ( ".DB::table('services')->where('id', $servicesre )->value('prix')."€ )";
         
         if ($Reservation->recurrent==1) {
        $messageTel.= " abonnement " ;
      }
      $messageTel.= ", ";
      }


        $messageTel.=' Produits :   ';
          foreach ($idproduits as $idp) {

               $messageTel.=  ' '.DB::table('produits')->where('id', $idp->ids )->value('nom_produit').'';
               $messageTel.=  '( Quantité:'.$idp->qty.',';
               $messageTel.= ' Prix:'.DB::table('produits')->where('id', $idp->ids )->value('prix_unité')."€ )";
               $messageTel.= ", ";
              } 
              if ($Reservation->serv_suppl != null) {
               $messageTel.=' Cadeaux :   '.$Reservation->serv_suppl.'';
              }
              

       


    $messageTel.=' Date :  '.$date .' Heure : '.$heure .' ';
    $messageTel.=' Client :  '.$client->name.' '.$client->lastname .' ';
    $messageTel.=' https://prenezunrendezvous.com/ '; 
    $numtel = $prestataire->tel ;
          try {
      
          $response = Message::send([
          'to' => $numtel,
          'text' => $messageTel
        ]);

    } catch (\SMSFactor\Error\Api $e) {

    }
      //enregistrement alerte
    $alerte = new Alerte([
             'user' => $prestataire->id,
       'titre'=>'Réservation payée('.$titre.')',             
             'details' => $message,
         ]);  
     $alerte->save();   
    
   

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

       Stripe::setApiKey('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');

     $refund = \Stripe\Refund::create([
  'payment_intent' => $stripe_id,
], ['stripe_account' => $account]);


    Reservation::where('id', $k)->update(array('statut' => 2,'paiement'=> 4 ));
      $Reservation = Reservation::where('id',$k)->first();
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


    
      
      try {
       $this->sendMail(trim($client->email),'Réservation annulée _ Remboursement',$message) ;
       // break;
    } catch (\Swift_TransportException $e) {
        
    } 
    // sms au prest
    $messageTel='Bonjour, ';
    $messageTel.='le rendez-vous prévue du  '.$date .' à '.$heure .'  avec les services: '.$Reservation->nom_serv_res.'  - ('.$Reservation->Net.' €) a été annulé. ';
    $messageTel.='Votre Prestataire '.$prestataire->name.' '.$prestataire->lastname.'a remboursé votre montant payé. ';
   
    
    $messageTel.=' https://prenezunrendezvous.com/ ';
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

     return redirect('/reservations/');
        dd($refund);

    }

public function pay4($resId)
    {
       //Stripe::setApiKey('sk_test_51IyZEOLYsTAPmLSFOUPFtTTEusJc2G7LSMDZEYDxBsv0iJblsOpt1dfaYu8PrEE6iX6IX7rCbpifzhdPfW7S0lzA007Y8kjGAx');
       $today = new DateTime();
    $today = $today->getTimestamp();
    $fin = strtotime('+95 day', $today);
    
    
    
    
    //dd($request);nom_serv_res
    
    $Reservation=Reservation::where('id',$resId)->first();

    $client = User::where('id',$Reservation->client)->first();
    $account = User::where('id',$Reservation->prestataire)->value('id_stripe');
    //Stripe::setApiKey('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');
    Stripe::setApiKey('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');

$customer = \Stripe\Customer::create();
    \Stripe\Customer::update(
        $customer->id,
        [
            'email' => $client->email,
            
        ]
    );


    
    $produit = Product::create([
    'name' => $Reservation->nom_serv_res,
    'type' => 'service',
  ]);
    $price = \Stripe\Price::create([
    'product' => $produit->id,
    'unit_amount' => intval(($Reservation->reste/4) *100),
    'currency' => 'eur',
    'recurring' => ['interval' => 'month'],
  ]);
             
  $Subscription = \Stripe\Subscription::create([
    'customer' => $customer->id,
    'cancel_at' => $fin ,
   
    'items' => [
      [
        'price' => $price->id ,
        'quantity' => 1,
      ],
    ],
    'payment_behavior' => 'default_incomplete',
    'expand' => ['latest_invoice.payment_intent'],
    "transfer_data" => [
    "destination" => $account,
  ],
  ]);
  //dd($Subscription);
  $clientSecret = Arr::get($Subscription->latest_invoice->payment_intent, 'client_secret');
  $subscriptionId = Arr::get($Subscription, 'id');
  //dd($clientSecret);
  return view('payments.pay2', [
            'clientSecret' => $clientSecret ,'subscriptionId' => $subscriptionId , 'idaccount' => $account , 'customerid' => $customer->id , 'resId' => $resId
        ]);

    }







public function sendMail($to,$sujet,$contenu){

    $swiftTransport =  new \Swift_SmtpTransport( 'smtp.gmail.com', '587', 'tls');
    //$swiftTransport->setUsername(\Config::get('mail.username')); //adresse email
    //$swiftTransport->setPassword(\Config::get('mail.password')); // mot de passe email
      $swiftTransport->setUsername(env('MAIL_USERNAME')); //adresse email
        $swiftTransport->setPassword(env('MAIL_PASSWORD')); 

        $swiftMailer = new Swift_Mailer($swiftTransport);
    Mail::setSwiftMailer($swiftMailer);
    $from=\Config::get('mail.from.address') ;
    $fromname=\Config::get('mail.from.name') ;
    
    Mail::send([], [], function ($message) use ($to,$sujet, $contenu,$from,$fromname   ) {
      //dd($contenu);

         $message
                 ->to($to)
                    ->subject($sujet)
                       ->setBody($contenu, 'text/html')
                    ->setFrom([$from => $fromname]);         

      });
    
  }


}
