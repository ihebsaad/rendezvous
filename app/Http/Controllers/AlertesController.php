<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Session;
use \App\User;
use \App\Alerte;

class AlertesController extends Controller
{

 
  public function __construct()
    {
        $this->middleware('auth');
    }

	
	
    public function index()
    {
		
		  $cuser = auth()->user();
 
        $alertes = Alerte::where('user',$cuser->id)->orderBy('id','desc')->get();

        return view('alertes.index', compact('alertes'));


    }
   

		
	public function add(Request $request)
	{
		
  		 $alerte  = new Alerte([
              ]);
 
        $alerte->save();
 		
    return back();
		 

 	}
	
	public function store(Request $request)
	{
		 $alerte  = new Alerte([ ]);
  
        $alerte->save();
 
 	}
  

    public function updating(Request $request)
    {
        $id= $request->get('user');
        $champ= strval($request->get('champ'));
        $val= strval($request->get('val'));
    
          Alerte::where('id', $id)->update(array($champ => $val));

    }


	
     public function remove($id,$user)
    {
  
	 
	DB::table('alertes')->where('id', $id)->delete();
	return redirect (url('/alertes'));

	}
	 
	
  
 }
