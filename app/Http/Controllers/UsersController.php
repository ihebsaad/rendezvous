<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
//use Illuminate\Http\PostRequest;
use DB;
use Illuminate\Support\Facades\Auth;
use Session;
use \App\User;
use \App\Service;
use \App\Categorie;
use \App\Image;
use \App\Reservation;
use \App\Alerte;

use Twilio\Rest\Client;
 
class UsersController extends Controller
{


    public function __construct()
    {
     //   $this->middleware('auth');
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
 
 
     public function parametres()
    {
 		  $cuser = auth()->user();

		$User =\App\User::find($cuser->id);
 		$user_type=$User->user_type;

		if(   $user_type=='admin' )
        { 
	    
	  return view('parametres' );       
		}else{
			
			//return back();
		}
		
	}
	
 	
    public function prestataires()
    {   
	    $cuser = auth()->user();
 
		$user_type=$cuser->user_type;
 
		if(   $user_type=='admin' )
        { 
	   
	   $users = User::where('user_type','prestataire')->get();

	  return view('users.prestataires',  compact('users') );       
		}     

	}
	
	
	    public function favoris()
    {   
 
 	    $cuser = auth()->user();

	    $idusers= DB::table('favoris')->where('client',$cuser->id)->pluck('prestataire');

	   $users = User::whereIn('id',$idusers)->get();

	  return view('users.prestataires',  compact('users') );       
	    

	}
	
		   public function faqs()
    {
      	 
	  return view('faqs' );       

	}
	
	
   public function dashboard()
    {
	  	
	  return view('dashboard' );   
		   
	}
	
	   public function listings()
    {
      	 
	  return view('listings' );       

	}
	
	  public function home()
    {
      	 
	  return view('home' );       

	}
	
	   public function pricing()
    {
      	 
	  return view('pricing' );       

	}
	
	   public function abonnements()
    {
      	 
	  return view('abonnements' );       

	}
	
	  public function apropos()
    {
      	 
	  return view('apropos' );       

	}
	
	  public function contact()
    {
      	 
	  return view('contact' );       

	}
	 
	  public function viewlisting($id)
    {
  	
		$user = User::find($id);
		
	  return view('viewlisting' ,  compact('user','id'));       

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
		
		 $services =\App\Service::where('user',$id)->get();
		
 	    if(  $user_id == $id || $user_type=='admin' )
        {  	
		$user = User::find($id);
		$categories = Categorie::orderBy('nom', 'asc')->get();
        $categories_user =  DB::table('categories_user')->where('user',$id)->pluck('categorie');

		return view('users.listing',  compact('user','id','services','categories','categories_user')); 
		
		}
		
	}
	
	
	    public function parametring(Request $request)
    {
        $champ= $request->get('champ');
          $val= $request->get('val');
 
 	DB::table('parametres')->where('id', 1)->update(array($champ => $val));

 
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
		public function ajoutlogo(Request $request)
	{
 	 //$temp_file = $_FILES['file']['tmp_name'];

		 $name='';
		if($request->file('file')!=null)
		{$image=$request->file('file');
		 $name =  $image->getClientOriginalName();
                 $path = storage_path()."/images/";
 
          $image->move($path, $name);
		}
		 DB::table('parametres')->where('id', 1)->update(array('logo' => $name));

		 
	}
	
		public function ajoutvideoslider(Request $request)
	{
 	 

 	 //$temp_file = $_FILES['file']['tmp_name'];

		 $name='';
		if($request->file('file')!=null)
		{$image=$request->file('file');
		 $name =  $image->getClientOriginalName();
                 $path = storage_path()."/images/";
 
          $image->move($path, $name); 

          
		}
		  DB::table('parametres')->where('id', 1)->update(array('video' => $name));

		 // return 'ok';

		 /* $_IMAGE = $request->file('file');
        $filename = time().$_IMAGE->getClientOriginalName();
        $uploadPath = 'public/images/';
        $_IMAGE->move($uploadPath,$filename);

        echo json_encode($filename);*/
  
	}
	
			public function ajoutvideo(Request $request)
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
		  User::where('id', $id)->update(array('video' => $name));
  
	}
	
		public function ajoutcouv(Request $request)
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
		  User::where('id', $id)->update(array('couverture' => $name));
 	
	}
	

		public function ajoutimages(Request $request)
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
 
		  	 $image  = new Image([
              'user' => $request->get('user'),
              'thumb' => $name,
             ]);
 
        $image->save();
		
		
	}
	
	
	
		
     public function removeimage($id,$user)
    {
   
	DB::table('images')->where('id', $id)->delete();
	return redirect (url('/listing/'.$user.'#images'));

	}
	
	     public function removevideo($id)
    {
   
	  User::where('id', $id)->update(array('video' => ''));

		  return redirect (url('/listing/'.$id.'#videos'));

	}
	
	    public static function  ChampById($champ,$id)
    {
        $user = User::find($id);
        if (isset($user[$champ])) {
            return $user[$champ] ;
        }else{return '';}

    }
  
  
  
     public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/users')->with('success', '  supprimé avec succès');
    }

	
     public function remove($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/prestataires')->with('success', '  supprimé avec succès');
    }

    public function sendsms()
    {
    	// test send sms
      //$sid    = "AC3d7083cec682b78152d5e320cc6b80a2";
    	$sid    = "ACa9a8bf9d60934bca1e18517dc5102062";
    	
      //$token  = "dda3e46929618cd01ef5144360b645c0";
    	//$token  = "f469833a67aa9762a846ae5be7965257";
    	$token  = "c45f6d2e87d34e98182eb0bdc0abc665";
      
      $twilio_number = "+13347589498";
      $client = new Client($sid, $token);
		$client->messages->create(
		    // Where to send a text message (your cell phone?)
		    '+21654076876',
		    array(
		        'from' => $twilio_number,
		        'body' => 'Bonjour, 
		        test du site: prenezunrendezvous.com !'
		    )
		);
		$client->messages->create(
		    // Where to send a text message (your cell phone?)
		    '+596696930477',
		    array(
		        'from' => $twilio_number,
		        'body' => 'Bonjour, 
		        test du site: prenezunrendezvous.com !'
		    )
		);
		// creation service
/*$service = $client->verify->v2->services
                              ->create("Verification Tel");

$serviceid= $service->sid ;
	
$verification = $client->verify->v2->services($serviceid)
                                   ->verifications
                                   ->create('+21654076876', "sms");*/
    }
	
 }
