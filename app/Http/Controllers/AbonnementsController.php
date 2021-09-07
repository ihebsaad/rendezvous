<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Session;
use \App\User;
use \App\Abonnement;

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

	 
	DB::table('abonnements')->where('id', $id)->delete();
	return redirect (url('/MesAbonnements'));

	}
	 
	
  
 }
