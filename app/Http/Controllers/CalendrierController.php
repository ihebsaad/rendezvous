<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Session;
use \App\User;
use \App\Calendrier;
use \App\Service;

class CalendrierController extends Controller
{


     public function __construct()
    {
        $this->middleware('auth');
    }

	
	

		
	public function add(Request $request)
	{
		 $name='';
 		 if($request->file('photo')!=null)
		{$image=$request->file('photo');
		 $name =  $image->getClientOriginalName();
                 $path = storage_path()."/images/";
			$date=date('d-m-Y-H-i-s');
		//$name=$name.'-service-'.$date ;
		
		
         $image->move($path,  $name );
		}
		
		$user=$request->get('user');
		 $service  = new Service([
              'user' => $request->get('user'),
              'nom' => $request->get('nom'),
              'description' => $request->get('description'),
              'prix' => $request->get('prix'),
              'thumb' => $name,
           ]);
 
        $service->save();
    return $service->id;
		//	return back();
    //  return redirect('/listing/'.$user)->with('success', ' ajouté  ');


 	}
	
	public function store(Request $request)
	{
				
		   $user =  $request->get('user');

		     $periode_disp = new Calendrier([
              'prest_id' => $request->get('user'),
              'titre' => $request->get('tdesc'),
              'date_debut' => $request->get('dpindisp'),
              'date_fin' => $request->get('fpindisp'),
              'couleur' => 'red',
              'couleurText'=>'balck'
           ]);

        $periode_disp->save();
       return redirect('/listing/'.$user.'#indispo')->with('success', ' ajouté  ');

 	}
  

    public function updating(Request $request)
    {
        $id= $request->get('user');
        $champ= strval($request->get('champ'));
        $val= strval($request->get('val'));
    
          Service::where('id', $id)->update(array($champ => $val));

    }


	
     public function remove($id,$user)
    {
  

	DB::table('periodes_indisp')->where('id', $id)->delete();
	return redirect (url('/listing/'.$user.'#indispo'));
	
	}
	
	
  	    public static function  ChampById($champ,$id)
    {
        $service = Service::find($id);
        if (isset($service[$champ])) {
            return $service[$champ] ;
        }else{return '';}

    }
	
	
 }
