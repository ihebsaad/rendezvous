<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Session;
use \App\User;
use \App\Abonnement;
use Stripe\Stripe;
use Stripe\Subscription;
use DateTime;

class AbonnementsController extends Controller
{

 
  public function __construct()
    {
        $this->middleware('auth');
    }

	
	
    public function index()
    {
		
		  $cuser = auth()->user();
		if($cuser->user_type=='admin')
        {
			$abonnements = Abonnement::orderBy('id','desc')->get();}
		else{
		 $abonnements = Abonnement::where('user',$cuser->id)->orderBy('id','desc')->get();
		 }
 

        return view('abonnements.index', compact('abonnements'));


    }
   public function bindex()
    {
		
		  $cuser = auth()->user();
		if($cuser->user_type=='admin')
        {
			$abonnements = Abonnement::orderBy('id','desc')->get();
			return view('abonnements.Aindex', compact('abonnements'));
		}
		else{
		 $abonnements = Abonnement::where('user',$cuser->id)->orderBy('id','desc')->get();
		 return view('abonnements.bindex', compact('abonnements'));
		 }
 

        


    }

		
	public function add(Request $request)
	{
		
  		 $abonnement  = new Abonnement([
              ]);
 
        $abonnement->save();
 		
    return back();
		 

 	}
	
	public function store(Request $request)
	{
		 $abonnement  = new Abonnement([ ]);
  
        $abonnement->save();
 
 	}
  

    public function updating(Request $request)
    {
        $id= $request->get('user');
        $champ= strval($request->get('champ'));
        $val= strval($request->get('val'));
    
          Abonnement::where('id', $id)->update(array($champ => $val));

    }


	
     public function remove($id)
    {
    	$todayy = date('Y-m-d H:i:s');
    	$dateAbn=DB::table('abonnements')->where('id', $id)->value('created_at');
    	$dateAbn = new DateTime($dateAbn);
    	$date = $dateAbn->format('Y-m-d H:i:s');
        $today= new DateTime();
        $m = $dateAbn->format('n');
        $x = $today->format('n');
        $interval = date_diff($dateAbn, $today)->m;
        $y = date('Y-m-d H:i:s', strtotime($date. ' + '.$interval.' month'));
        if ($todayy > $y) {
        	//dd("ok");
        	$y = date('Y-m-d H:i:s', strtotime($y. ' + 1 month'));
        }
        Abonnement::where('id', $id)->update(array('expire' => $y ));
        dd($y);
        
        
    	$idstripe=DB::table('abonnements')->where('id', $id)->value('IdStripe');
    //dd($idstripe);
	 Stripe::setApiKey('sk_test_51IyZEOLYsTAPmLSFOUPFtTTEusJc2G7LSMDZEYDxBsv0iJblsOpt1dfaYu8PrEE6iX6IX7rCbpifzhdPfW7S0lzA007Y8kjGAx');
	 

$subscription = \Stripe\Subscription::retrieve('sub_KC84atiVrzYoyY');
//dd($subscription);
$subscription->cancel();
 Abonnement::where('id', $id)->update(array('statut' => "annuler" ));

	//DB::table('abonnements')->where('id', $id)->delete();
	return redirect (url('/MesAbonnements'));

	}
	 
	
  
 }
