<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Session;
use \App\User;
use \App\Service;

class ServicesController extends Controller
{


     public function __construct()
    {
        $this->middleware('auth');
    }

	
  
  /*   public function addg (Request $request)
    {
		  $garantie =$request->get('garantie');
		  $assure =$request->get('assure');

		  DB::table('garanties_assure')->insert(
    ['id_assure' => $assure , 'garantie' => $garantie]);
	
	$rubriques= Rubrique::where('garantie', $garantie)->get();
	$annee=date('Y');
	foreach($rubriques as $rb){
	
	DB::table('rubriques_assure')->insert(
    ['id_assure' => $assure ,'rubriqueinitial' => $rb->rubriqueinitial,'rubrique' => $rb->id,'montant' =>$rb->montant,'mrestant' =>$rb->montant, 'annee' => $annee,'updated_at'=>NOW()]);	
		
	}
	
	}
	*/
	

		
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
				$name='';
		if($request->file('photo')!=null)
		{$image=$request->file('photo');
		 $name =  $image->getClientOriginalName();
                 $path = storage_path()."/images/";
			$date=date('d-m-Y-H-i-s');
		$name=$name.'-service-'.$date ;
         $image->move($path,  $name );
		}
		             $user =  $request->get('user');

		     $service  = new Service([
              'user' => $request->get('user'),
              'nom' => $request->get('nom'),
              'description' => $request->get('description'),
              'prix' => $request->get('prix'),
              'thumb' => $name,
           ]);

        $service->save();
       return redirect('/listing/'.$user.'#services')->with('success', ' ajouté  ');

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
  
	$res= \App\Reservation::where('service', $id)->count();
	
	if($res==0)
	{DB::table('services')->where('id', $id)->delete();
	return redirect (url('/listing/'.$user.'#services'));
	}else{
       return redirect('/listing/'.$user.'#services')->with('error', ' Service rélié aux réservations  ');
	}
	}
	
	
  	    public static function  ChampById($champ,$id)
    {
        $service = Service::find($id);
        if (isset($service[$champ])) {
            return $service[$champ] ;
        }else{return '';}

    }
	
	
 }
