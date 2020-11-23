<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Session;
use \App\User;
use \App\Reservation;

class ReservationsController extends Controller
{


     public function __construct()
    {
        $this->middleware('auth');
    }

		
    public function index()
    {
		
		  $cuser = auth()->user();
 
        $reservations = Reservation::where('prestataire',$cuser->id)->get();

        return view('reservations.index', compact('reservations'));


    }
  

		
	public function add(Request $request)
	{
		$user=$request->get('user');
		 $reservation  = new Reservation([
              'client' => $request->get('client'),
              'prestataire' => $request->get('prestataire'),
              'service' => $request->get('service'),
              'date' => $request->get('date'),
              'heure' => $request->get('heure'),
              'adultes' => $request->get('adultes'),
              'enfants' => $request->get('enfants'),
              'remarques' => $request->get('remarques'),
              'rappel' => $request->get('rappel'),
            ]);
 
        $reservation->save();
    return $reservation->id;
		 

 	}
	
	public function store(Request $request)
	{
		 $reservation  = new Reservation([
              'user' => $request->get('user'),
              'question' => $request->get('question'),
              'reponse' => $request->get('reponse'),
            ]);

        $reservation->save();
 
 	}
  

    public function updating(Request $request)
    {
        $id= $request->get('user');
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
	
  
 }
