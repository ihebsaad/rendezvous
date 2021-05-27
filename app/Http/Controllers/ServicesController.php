<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
use Illuminate\Support\Facades\Auth;
use Session;
use \App\User;
use \App\Produit;
use \App\Service;
use \App\Codepromo;
use \App\Happyhour;
use \App\ServiceSupp;

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
  public static function infoservice($id)
    {
      $infoservice=Service::find($id);
      return $infoservice;
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
    //  return back();
    //  return redirect('/listing/'.$user)->with('success', ' ajouté  ');

  }
  

  public function store(Request $request)
  {
    //dd( $request);
    
        $name='';
        $rec='off';
    if($request->file('photo')!=null)
    {$image=$request->file('photo');
     $name =  $image->getClientOriginalName();
                 $path = storage_path()."/images/";
      $date=date('d-m-Y-H-i-s');
    $name=$name.'-service-'.$date ;
         $image->move($path,  $name );
    }
                 $user =  $request->get('user');
           if ($request->get('toggleswitch')=='on') {
            $rec=$request->get('toggleswitch');
          }
         $service  = new Service([

              'user' => $request->get('user'),
              'nom' => $request->get('nom'),
              'description' => $request->get('description'),
              'prix' => $request->get('prix'),
              'duree' => $request->get('duree'),
              'Nfois' => $request->get('Nfois'),
              'frequence' => $request->get('mySelect'),
              'periode' => $request->get('periode'),
              'nbrService' => $request->get('nbrService'),
              'recurrent' => $rec,
              'thumb' => $name,
           ]);

        $service->save();
       return redirect('/listing/'.$user.'#services')->with('success', ' ajouté  ');

  }
  public function modif(Request $request)
    {
        $id= $request->get('idchange');
        $champ= strval($request->get('namechange'));
        $val= strval($request->get('valchange'));
    
          Service::where('id', $id)->update(array($champ => $val));

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
  public function reductionUpdate(Request $request)

    {
      $cuser = auth()->user();
        $val= $request->get('valchange');
      //dd($val);
        User::where('id', $cuser->id)->update(array("reduction" => $val));
  
  
  }
  
  
        public static function  ChampById($champ,$id)
    {
        $service = Service::find($id);
        if (isset($service[$champ])) {
            return $service[$champ] ;
        }else{return '';}

    }
    public function codepromo(Request $request){
      //dd($request);
     
      $promo = new Codepromo([
             'id_service' => $request->get('myServices'),
             'user_id' => $request->get('user'),
       'reduction'=>$request->get('redu'),       
             'code' => $request->get('code'),
         ]);  
     $promo->save();
     
     return back() ;
    }
    public function CodePromoUpdate(Request $request){
      //dd($request);
      $id = $request->get('id');
   
        $val= $request->get('valchange');
      //dd($val);
        Codepromo::where('id', $id)->update(array("reduction" => $val));
     
     
    }
    //add to table -produit_service-
    public function insertServiceProd(Request $request)
	{
    $id = $request->get('produit');

    $idService= $request->get('idservice');
    Service::where('id', $idService)->update(array('produits_id' => json_encode($id)));
    return [$id] ;
  


 	}
	//remove frome'produit_service' table
	 public function removeServiceProd(Request $request)
    {
      $id = $request->get('idproduit');

      $val= $request->get('idservice');
      DB::table('produit_service')->where('produit_id',$id)->where('service_id',$val)->delete();
    

	}
    public function CodePromoRemove($k)
    {
      DB::table('codepromos')->where('id', $k)->delete();
      
     
     return back();
    }
    public function CodePromoCheck(Request $request)
    {
       $serviceId = 0;
        $reduction = 0 ;
        $Remise = 0 ;
        $serviceNom ="" ;
       $code = Codepromo::where('code',$request->get('valCode'))->first();

        if($code==null)
        {
             $CodePromostate = 0;
        }
        else
        {
            $CodePromostate = 1;
            $serviceId = $code->id_service ;
            $service = Service::where('id',$serviceId)->first();
            $serviceNom = $service->nom ;
            $reduction = $code->reduction ;
            $Remise=($service->prix * $reduction) /100 ;
        }
      return [$CodePromostate,$serviceId,$reduction,$serviceNom,$Remise];
    
    }
    public function HappyHoursAdd(Request $request){
      //dd($request);
     
      $happyhours = new Happyhour([
             'reduction' => $request->get('reduction'),
             'dateDebut' => $request->get('date_debut'),
       'dateFin'=>$request->get('date_fin'),       
             'places' => $request->get('places'),
             'id_user' => $request->get('id_user'),
         ]);  
     $happyhours->save();
     
     return back() ;
    }
    public function HappyHoursRemove($k)
    {
      DB::table('happyhours')->where('id', $k)->delete();      
     
     return back();
    }

     public function enregistrer_regle_services_supp(Request $req)
    {
     //dd($req->all()); 
     $servicessuppl = new ServiceSupp([
             'prestataire' => trim($req->get('prestataire')),
             'regle' => trim($req->get('regle')),    
         ]);  
     $servicessuppl->save();   
     
     return back();
    }

  
    public function addP(Request $request)
  {

    $nameF='';
     if($request->file('Fichier')!=null)
    {$Fichier=$request->file('Fichier');
      
     $nameF = str_replace(' ', '', $Fichier->getClientOriginalName()); 
                 $pathF = public_path()."/Fichiers/";
      $date=date('d-m-Y-H-i-s');
    //$name=$name.'-service-'.$date ;
    
    
         $Fichier->move($pathF,  $nameF );
    }
     $name='';
     if($request->file('image')!=null)
    {$image=$request->file('image');
      
     $name =  $image->getClientOriginalName();
                 $path = storage_path()."/images/";
      $date=date('d-m-Y-H-i-s');
    //$name=$name.'-service-'.$date ;
    
    
         $image->move($path,  $name );
    }
    
    $user=$request->get('user');
     $produit  = new Produit([
              'nom_produit' => $request->get('nom_produit'),
              'description' => $request->get('description'),
              'type' => $request->get('type'),
              'prix_unité' => $request->get('prix_unité'),
              'user' => $request->get('user'),
              'image' => $name,
              'Fichier' => $nameF,
              'URL_telechargement'=>$request->get('URL_telechargement'),

           ]);
 
        $produit->save();
    return $produit->id;
    //  return back();
    //  return redirect('/listing/'.$user)->with('success', ' ajouté  ');

  }
     public function storeP(Request $request)
  {
    //dd( $request);
    $nameF='';
     if($request->file('Fichier')!=null)
    {$Fichier=$request->file('Fichier');
      
     $nameF =  $Fichier->getClientOriginalName();
     //dd($nameF);
                 $pathF = storage_path()."/images/";
      $date=date('d-m-Y-H-i-s');
    //$name=$name.'-service-'.$date ;
    
    
         $Fichier->move($pathF,  $nameF );
    }
        $name='';
        $rec='off';
    if($request->file('image')!=null)
    {$image=$request->file('image');
     $name =  $image->getClientOriginalName();
                 $path = storage_path()."/images/";
      $date=date('d-m-Y-H-i-s');
    $name=$name.'-produit-'.$date ;
         $image->move($path,  $name );
    }
                 $user =  $request->get('user');
           if ($request->get('toggleswitch')=='on') {
            $rec=$request->get('toggleswitch');
          }
         $produit  = new Produit([

              'nom_produit' => $request->get('nom_produit'),
              'description' => $request->get('description'),
              'prix_unité' => $request->get('prix_unité'),
              'type' => $request->get('type'),
              'user' => $request->get('user'),
              'image' => $name,
              'Fichier' => $nameF,
              'URL_telechargement'=>$request->get('URL_telechargement'),
           ]);

        $produit->save();
       return redirect('/listing/'.$user.'#produit')->with('success', ' ajouté  ');

  }
/*      happyhour example
 */     public function ProductRemove($k)
     {
      //suppression d'un produit
       DB::table('produits')->where('id', $k)->delete();
       
       // suppresion d'un produit affecté depuis la table Services

       $user= auth()->user()->id;
       //dd($user); 
       $services=Service::where('user', $user)->get();

       foreach ($services as $ser) {
        if($ser->produits_id)
        {
           foreach ($ser->produits_id as $prod) {
              if($prod==$k)
              {
                $arr=$ser->produits_id;
                $key = array_search($prod, $arr); 
                unset($arr[$key]);
                $ser->update(['produits_id'=>$arr]);
                $ser->save();
                //dd($arr);
              }
           }
        }
       }
      
      return back();
     }
     public function modifP(Request $request)
     {
         $id= $request->get('idchange');
         $champ= strval($request->get('namechange'));
         $val= strval($request->get('valchange'));
     
           Produit::where('id', $id)->update(array($champ => $val));
 
     }
   
 
     public function updatingP(Request $request)
     {
         $id= $request->get('user');
         $champ= strval($request->get('champ'));
         $val= strval($request->get('val'));
     
           Produit::where('id', $id)->update(array($champ => $val));
 
     }


    public function supprimer_serv_suppl($id)
    {
     //dd($req->all()); 
      //return($id);
      $serv_supp=ServiceSupp::where('id', $id)->first();
      $serv_supp->delete();
      //DB::table('services_suppl')->where('id', $id)->delete();     
      return 'ok';

    }

    public function get_liste_regles_services_suppl($id)
    {
     
      $serv_supp=ServiceSupp::where('prestataire', $id)->get();
      $res='';
      foreach ($serv_supp as $ss) {
        $res= $res.';'.$ss->regle;
      }
      //DB::table('services_suppl')->where('id', $id)->delete();     
      return $res;

    }

    
	
	

 }

