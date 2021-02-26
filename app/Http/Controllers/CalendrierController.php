<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Session;
use \App\User;
use \App\Indisponibilite;
use \App\Service;

class CalendrierController extends Controller
{


     public function __construct()
    {
        $this->middleware('auth');
    }

  public static function indisponibilte_rendezvous_horaire($id)
  {

    $user_indisp=Indisponibilite::where('prest_id',$id)->get(['titre', 'date_debut','date_fin' ]);
    $res=array();
   foreach ($user_indisp as $ui) {
    $debut=$ui->date_debut;
    $fin=$ui->date_fin;
   str_replace(" ","T",$debut); 
   str_replace(" ","T",$fin);     
   $res[]=array('title'=>$ui->titre,'start'=>$debut, 'end'=> $fin, 'color' => 'red');
   }

   return json_encode($res);
    
  }
	
	public static function ouverture_fermeture_horaire($id)
  {
     $usr_fer_ouv=User::where('id',$id)->first(['lundi_o',  'lundi_f',  'mardi_o',  'mardi_f',  'mercredi_o', 'mercredi_f', 'jeudi_o' , 'jeudi_f' , 'vendredi_o' ,  'vendredi_f' ,  'samedi_o' ,  'samedi_f' ,'dimanche_o' ,  'dimanche_f']);
     $i=0;
       
     $res=array();
     if($usr_fer_ouv->lundi_o && $usr_fer_ouv->lundi_f )
     {
     $res[$i]=array('startTime'=>$usr_fer_ouv->lundi_o,'endTime'=>$usr_fer_ouv->lundi_f, 'daysOfWeek'=>['1']);
     $i++;
     }


    if($usr_fer_ouv->mardi_o && $usr_fer_ouv->mardi_f )
     {
     $res[$i]=array('startTime'=>$usr_fer_ouv->mardi_o,'endTime'=>$usr_fer_ouv->mardi_f, 'daysOfWeek'=>['2']);
      $i++;
     }


     if($usr_fer_ouv->mercredi_o && $usr_fer_ouv->mercredi_f )
     {
     $res[$i]=array('startTime'=>$usr_fer_ouv->mercredi_o,'endTime'=>$usr_fer_ouv->mercredi_f, 'daysOfWeek'=>['3']);
     $i++;
      }

    if($usr_fer_ouv->jeudi_o && $usr_fer_ouv->jeudi_f )
     {
     $res[$i]=array('startTime'=>$usr_fer_ouv->jeudi_o,'endTime'=>$usr_fer_ouv->jeudi_f, 'daysOfWeek'=>['4']);
      $i++;
     }

     if($usr_fer_ouv->vendredi_o && $usr_fer_ouv->vendredi_f )
     {
     $res[$i]=array('startTime'=>$usr_fer_ouv->vendredi_o,'endTime'=>$usr_fer_ouv->vendredi_f, 'daysOfWeek'=>['5']);
     $i++;
     }
     if($usr_fer_ouv->samedi_o && $usr_fer_ouv->samedi_f )
     {
     $res[$i]=array('startTime'=>$usr_fer_ouv->samedi_o,'endTime'=>$usr_fer_ouv->samedi_f, 'daysOfWeek'=>['6']);
     $i++;
     }

     if($usr_fer_ouv->dimanche_o && $usr_fer_ouv->dimanche_f )
     {
     $res[$i]=array('startTime'=>$usr_fer_ouv->dimanche_o,'endTime'=>$usr_fer_ouv->dimanche_f, 'daysOfWeek'=>['7']);
     $i++;
      }



     return json_encode($res);

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

		     $periode_disp = new Indisponibilite([
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
