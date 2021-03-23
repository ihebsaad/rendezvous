<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
//use Illuminate\Http\PostRequest;
use DB;
use QrCode;
use URL;

use Illuminate\Support\Facades\Auth;
use Session;
use \App\User;
use \App\Service;
use \App\Categorie;
use \App\Image;
use \App\Reservation;
use \App\Alerte;
use \App\Calendrier;
use \App\Cartefidelite;
use \App\Codepromo;
use \App\Happyhour;   


use Illuminate\Support\Str;


 use DateTime;
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
 	
 	public static function infouser($id)
    {
    	$infouser=\App\User::find($id);
    	return $infouser;
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

 public function ConditionsUtilisation()
    {
      	 
	  return view('conditions_utilisation' );       

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
	 
	  public function viewlisting($slug,$id)
    {
  		$reduction=0;
		$user = User::find($id);
		$happyhours = Happyhour::where('id_user',$id)->get();
		$today= new DateTime();
		//dd($today);
  		$myhappyhours = Happyhour::where('id_user' ,$id)->where('dateDebut','<=',$today)->where('dateFin','>=',$today)->where('places','>','Beneficiaries')->first();
  		//dd($myhappyhours);
		 if (Auth::guest())
            return view('viewlisting' ,  compact('user','id','reduction','happyhours','myhappyhours'));
        $cuser = auth()->user();
  		//dd($cuser->id);
  		$test=Cartefidelite::where('id_client',$cuser->id)->where('id_prest',$id)->exists();
		if ($test=='true') {
			$nbrRes=Cartefidelite::where('id_client',$cuser->id)->where('id_prest',$id)->value('nbr_reservation');
			if ($nbrRes==9) {
				$reduction=User::where('id',$id)->value('reduction');
			}
			}
        return view('viewlisting' ,  compact('user','id','reduction','happyhours','myhappyhours'));
		
	         

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



        $serviceWithCode = Codepromo::where('user_id',$user_id)->get();
        $happyhours = Happyhour::where('id_user',$user_id)->get();


		return view('users.listing',  compact('user','id','services','categories','categories_user','serviceWithCode','happyhours')); 
		
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
        $id= trim($request->get('user'));
        $champ= strval($request->get('champ'));
        if($champ=='password'){
            $val= bcrypt(trim($request->get('val')));

        }else{
            $val= $request->get('val');

        }

        // mise à jour qr code
        if($champ=='titre')
        {
           $valkbs= trim($request->get('val'));
           if($valkbs)
           {
           	 $nouv_slug=Str::slug($valkbs,'-');
             $nouv_qrcode=$nouv_slug.'-'.$id.'.png';
            // $ancien_qrcode=User::where('id',$id)->first()->qr_code;
             $ancien_qrcode=User::where('id',$id)->first()->titre;
             $ancien_qrcode=Str::slug($ancien_qrcode,'-');
             $ancien_qrcode=$ancien_qrcode.'-'.$id.'.png';

             $ancien_qrcode=storage_path().'/qrcodes/'.$ancien_qrcode;
             if(file_exists($ancien_qrcode))
                {
                 unlink($ancien_qrcode) ;
             	}
               $baseurl=URL::to('/');

              QrCode::size(200)->format('png')->generate($baseurl.'/'.$nouv_slug.'/'.$id,storage_path().'/qrcodes/'.$nouv_qrcode);

              User::where('id', $id)->update(array("qr_code"=> $nouv_qrcode));            

           }

        } // fin mise à jour qr code
          User::where('id', $id)->update(array($champ => $val));
       /* $cal='';
        $a='';
        if(trim($champ)=='lundi_o' || trim($champ)=='lundi_f' )
        {
        	$cal=Calendrier::where('prest_id', $id)->where('type_indisp','like','%of%')->where('sous_type_indisp','like','%lundi%')->first();
        	if($cal)
        	{
        		if(trim($champ)=='lundi_o')
        		{
                   $cal->update(array("start"=>trim($champ))); 
        		}
        		if(trim($champ)=='lundi_f')
        		{
        		  $cal->update(array("end"=>trim($champ))); 
        		}

        	}
        	else
        	{
        		$usr_of=User::where('id',$id)->first(['lundi_o','lundi_f']);

        		if(trim($champ)=='lundi_o')
        		{
                   $a= new Calendrier([
			             'prest_id' => $id,
			             'title'=> 'Horaire travail',
						 'start'=>trim($champ),						 
			             'end' => $usr_of->lundi_f,
			             'allDay' => 0,
			             'color' => 'red' ,
			             'textColor' => 'white',
			             'type_indisp'=>'of',
			             'sous_type_indisp'=>'lundi'
			         ]);
			         $a->save();	
					  
        		}
        		if(trim($champ)=='lundi_f')
        		{
        	     $a= new Calendrier([
			             'prest_id' => $id,
			             'title'=> 'Horaire travail',
						 'start'=>$usr_of->lundi_o,					 
			             'end' => trim($champ),
			             'allDay' => 0,
			             'color' => 'red',
			             'textColor' => 'white',
			             'type_indisp'=>'of',
			             'sous_type_indisp'=>'lundi'
			         ]);
			         $a->save(); 
        		}

        	}

        }*/
         
       

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
    	/*$sid    = "ACa9a8bf9d60934bca1e18517dc5102062";
    	$token  = "2b5518ac73d42b7ff70703cd524302ae";
      
      $twilio_number = "+13347589498";
      $client = new Client($sid, $token);
		$client->messages->create(
		    '+21654076876',
		    array(
		        'from' => $twilio_number,
		        'body' => 'Bonjour, 
		        test du site: prenezunrendezvous.com !'
		    )
		);*/
		/*$client->messages->create(
		    '+596696930477',
		    array(
		        'from' => $twilio_number,
		        'body' => 'Bonjour, 
		        test du site: prenezunrendezvous.com !'
		    )
		);*/
		$account = app('SMSFactor\Message');
		$response = $account->send([
			'to' => '+21654076876',
			'text' => 'Bonjour, 
		        test du site: prenezunrendezvous.com !'
		]);
		print_r($response->getJson());
    }
	
 }
