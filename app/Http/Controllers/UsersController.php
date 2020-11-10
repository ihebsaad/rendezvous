<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Session;
use \App\User;
use \App\Service;
use \App\Categorie;

class UsersController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

	
    public function index()
    {
       	 $cuser = auth()->user();
		 
		$User =\App\User::find($cuser->id);
 		$user_type=$User->user_type;

		if(   $user_type=='admin' )
        { 
	   
	   $users = User::where('user_type','client')->get();

	  return view('users.index',  compact('users') );       
		}
		
	}
 
 	
    public function perstataires()
    {   
	    $cuser = auth()->user();
 
		$user_type=$cuser->user_type;
 
		if(   $user_type=='admin' )
        { 
	   
	   $users = User::where('user_type','prestataire')->get();

	  return view('users.prestataires',  compact('users') );       
		}     

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
		$categories = Categorie::orderBy('nom', 'asc')->get();
        $categories_user =  DB::table('categories_user')->where('user',$id)->pluck('categorie');

		return view('users.listing',  compact('user','id','services','categories','categories_user')); 
		
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

	public function ajoutimage(Request $request)
	{
		  $id= $request->get('user');
	 //$temp_file = $_FILES['file']['tmp_name'];

		 $name='';
		if($request->file('file')!=null)
		{$image=$request->file('file');
		 $name =  $image->getClientOriginalName();
                 $path = storage_path()."/images/";
 
          $image->move($path, $name);
		}
		  User::where('id', $id)->update(array('logo' => $name));

		
		
	}

	
  
 }
