<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Session;
use \App\User;
use \App\Service;

class UsersController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

	
    public function index()
    {
      		$users = User::get();

	  return view('users.index',  compact('users') );       

	}
 
   public function dashboard()
    {
      	 
	  return view('dashboard' );       

	}
	
     public function profile($id)
    {
		$cuser = auth()->user();
		 
		$user_type=$cuser->user_type;
		$user_id=$cuser->id;

		if(  $user_id == $id || $user_type=='admin' )
        {  	
		$user = User::find($id);
  
		return view('users.profile',  compact('user','id')); 
		
		}
		

	}
	
	public function listing($id)
    {
		$cuser = auth()->user();
		$user_type=$cuser->user_type;
		$user_id=$cuser->id;
		
		$services= Service::where('user',$user_id)->get() ;
 	 if(  $user_id == $id || $user_type=='admin' )
        {  	
		$user = User::find($id);
  
		return view('users.listing',  compact('user','id','services')); 
		
		}
		
	}
	

    public function updating(Request $request)
    {
        $id= $request->get('user');
        $champ= strval($request->get('champ'));
        if($champ=='password'){
            $val= bcrypt(trim($request->get('val')));

        }else{
            $val= $request->get('val');

        }
          User::where('id', $id)->update(array($champ => $val));

    }



	
  
 }
