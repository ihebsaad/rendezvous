<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Session;
use \App\User;
use \App\Alerte;

class RechercheController extends Controller
{

 
 /* public function __construct()
    {
        $this->middleware('auth');
    }*/
  public static function show_prestataire_search()
  {

   return view('listings_search');
  }

    public function search_prestataires(Request $request)
    {

        $prest_tag= trim($request->get('prest_tag'));
        $prest_emplacement= trim($request->get('prest_emplacement'));
        $Toutes_les_categories=trim($request->get('toutes_categories'));

       // dd($prest_tag."-".$prest_emplacement."-".$Toutes_les_categories);
        // cas 111
        if($prest_tag && $prest_emplacement && $Toutes_les_categories)
        {
          //dd('cas 1');
          // recherche the user of categorie
         $idcategories=DB::table('categories')->where('nom','like',$Toutes_les_categories)->pluck('id')->toArray();
         $idcategories=array_values($idcategories);
         $idprest_categories= DB::table('categories_user')->whereIn('categorie',$idcategories )->pluck('user')->toArray();
         $idprest_categories=array_values($idprest_categories);


         // emplacement
         $idprest_emplacement=DB::table('users')->where('user_type','prestataire')->where(function($q) use($prest_emplacement){
               $q->where('adresse','like','%'.$prest_emplacement.'%')->orWhere('ville','like','%'.$prest_emplacement.'%');
             })->pluck('id')->toArray();
         $idprest_emplacement=array_values($idprest_emplacement);

         //tags
         if(stripos($prest_tag, ' ') == false && stripos($prest_tag, ',') == false)
         {
         $idprest_tag=DB::table('users')->where(function($q) use($prest_tag){
               $q->where('titre','like','%'.$prest_tag.'%')->orWhere('keywords','like','%'.$prest_tag.'%')->orWhere('description','like','%'.$prest_tag.'%');
             })->pluck('id')->toArray();
         $idprest_tag=array_values($idprest_tag);
         
         }

         if(stripos($prest_tag, ' ') !== false || stripos($prest_tag, ',') !== false)
         {
              if(stripos($prest_tag, ' ') !== false)
              {
                $prest_tag=str_replace(" ",",",$prest_tag);
              }

             $parcourir_tags=explode(',', $prest_tag);
             $parcourir_tags=array_values( $parcourir_tags);
             //dd($parcourir_tags);
             $idprest_tag=array();
             for($i=0; $i<count($parcourir_tags); $i++)
             {
              
              $idprest_t=DB::table('users')->where(function($q) use($parcourir_tags,$i){
               $q->where('titre','like','%'. $parcourir_tags[$i].'%')->orWhere('keywords','like','%'.$parcourir_tags[$i].'%')->orWhere('description','like','%'.$parcourir_tags[$i].'%');
             })->pluck('id')->toArray();

              $idprest_t=array_values($idprest_t);
              $idprest_tag=array_merge($idprest_tag,$idprest_t);
              
             }

              $idprest_tag=array_values($idprest_tag);
         }

          $result=array_intersect($idprest_categories,$idprest_emplacement,$idprest_tag);
          $result=array_unique($result);
          //$result=[5,6];
          $listings=\App\User::where('user_type','prestataire')->whereIn('id',$result)->get();

        }
//---------------------------------------------------------------------------------------------
         // cas 000
       if(!$prest_tag && !$prest_emplacement && !$Toutes_les_categories)//tous les prestataires (car toutes les categories)
        {
         // dd('cas 2');
          $listings=\App\User::where('user_type','prestataire')->get();
        }
//----------------------------------------------------------------------------------------------------
        // cas 001
        if(!$prest_tag && !$prest_emplacement && $Toutes_les_categories)
        {
           // recherche the user of categorie
         $idcategories=DB::table('categories')->where('nom','like',$Toutes_les_categories)->pluck('id')->toArray();
         $idcategories=array_values($idcategories);
         $idprest_categories= DB::table('categories_user')->whereIn('categorie',$idcategories )->pluck('user')->toArray();
         $idprest_categories=array_values($idprest_categories);


          $result=array_unique($idprest_categories);
          $listings=\App\User::where('user_type','prestataire')->whereIn('id',$result)->get();
        }
  //----------------------------------------------------------------------------------------------------
        // cas 010
        if(!$prest_tag && $prest_emplacement && !$Toutes_les_categories)
        {
           // emplacement
         $idprest_emplacement=DB::table('users')->where('user_type','prestataire')->where(function($q) use($prest_emplacement){
               $q->where('adresse','like','%'.$prest_emplacement.'%')->orWhere('ville','like','%'.$prest_emplacement.'%');
             })->pluck('id')->toArray();
         $idprest_emplacement=array_values($idprest_emplacement);

          $result=array_unique($idprest_emplacement);
          $listings=\App\User::where('user_type','prestataire')->whereIn('id',$result)->get();
      
        }
  //------------------------------------------------------------------------------------------------------
         // cas 011
        if(!$prest_tag && $prest_emplacement && $Toutes_les_categories)
        {
           $idcategories=DB::table('categories')->where('nom','like',$Toutes_les_categories)->pluck('id')->toArray();
         $idcategories=array_values($idcategories);
         $idprest_categories= DB::table('categories_user')->whereIn('categorie',$idcategories )->pluck('user')->toArray();
         $idprest_categories=array_values($idprest_categories);


         // emplacement
         $idprest_emplacement=DB::table('users')->where('user_type','prestataire')->where(function($q) use($prest_emplacement){
               $q->where('adresse','like','%'.$prest_emplacement.'%')->orWhere('ville','like','%'.$prest_emplacement.'%');
             })->pluck('id')->toArray();
         $idprest_emplacement=array_values($idprest_emplacement);

          $result=array_intersect($idprest_emplacement,$idprest_categories);
          $result=array_unique($result);
          $listings=\App\User::where('user_type','prestataire')->whereIn('id',$result)->get();
      

        }
//-----------------------------------------------------------------------------------------------------
         // cas 100
        if($prest_tag && !$prest_emplacement && !$Toutes_les_categories)
        {
          //tags
         if(stripos($prest_tag, ' ') == false && stripos($prest_tag, ',') == false)
         {
         $idprest_tag=DB::table('users')->where(function($q) use($prest_tag){
               $q->where('titre','like','%'.$prest_tag.'%')->orWhere('keywords','like','%'.$prest_tag.'%')->orWhere('description','like','%'.$prest_tag.'%');
             })->pluck('id')->toArray();
         $idprest_tag=array_values($idprest_tag);
         
         }

         if(stripos($prest_tag, ' ') !== false || stripos($prest_tag, ',') !== false)
         {
              if(stripos($prest_tag, ' ') !== false)
              {
                $prest_tag=str_replace(" ",",",$prest_tag);
              }

             $parcourir_tags=explode(',', $prest_tag);
             $parcourir_tags=array_values( $parcourir_tags);
             //dd($parcourir_tags);
             $idprest_tag=array();
             for($i=0; $i<count($parcourir_tags); $i++)
             {
              
              $idprest_t=DB::table('users')->where(function($q) use($parcourir_tags,$i){
               $q->where('titre','like','%'. $parcourir_tags[$i].'%')->orWhere('keywords','like','%'.$parcourir_tags[$i].'%')->orWhere('description','like','%'.$parcourir_tags[$i].'%');
             })->pluck('id')->toArray();

              $idprest_t=array_values($idprest_t);
              $idprest_tag=array_merge($idprest_tag,$idprest_t);
              
             }

              $idprest_tag=array_values($idprest_tag);
         }

          
          $result=array_unique($idprest_tag);
          //$result=[5,6];
          $listings=\App\User::where('user_type','prestataire')->whereIn('id',$result)->get();

        }
//-------------------------------------------------------------------------------------------
        // cas 101
        if($prest_tag && !$prest_emplacement && $Toutes_les_categories)
        {
           $idcategories=DB::table('categories')->where('nom','like',$Toutes_les_categories)->pluck('id')->toArray();
         $idcategories=array_values($idcategories);
         $idprest_categories= DB::table('categories_user')->whereIn('categorie',$idcategories )->pluck('user')->toArray();
         $idprest_categories=array_values($idprest_categories);


         //tags
         if(stripos($prest_tag, ' ') == false && stripos($prest_tag, ',') == false)
         {
         $idprest_tag=DB::table('users')->where(function($q) use($prest_tag){
               $q->where('titre','like','%'.$prest_tag.'%')->orWhere('keywords','like','%'.$prest_tag.'%')->orWhere('description','like','%'.$prest_tag.'%');
             })->pluck('id')->toArray();
         $idprest_tag=array_values($idprest_tag);
         
         }

         if(stripos($prest_tag, ' ') !== false || stripos($prest_tag, ',') !== false)
         {
              if(stripos($prest_tag, ' ') !== false)
              {
                $prest_tag=str_replace(" ",",",$prest_tag);
              }

             $parcourir_tags=explode(',', $prest_tag);
             $parcourir_tags=array_values( $parcourir_tags);
             //dd($parcourir_tags);
             $idprest_tag=array();
             for($i=0; $i<count($parcourir_tags); $i++)
             {
              
              $idprest_t=DB::table('users')->where(function($q) use($parcourir_tags,$i){
               $q->where('titre','like','%'. $parcourir_tags[$i].'%')->orWhere('keywords','like','%'.$parcourir_tags[$i].'%')->orWhere('description','like','%'.$parcourir_tags[$i].'%');
             })->pluck('id')->toArray();

              $idprest_t=array_values($idprest_t);
              $idprest_tag=array_merge($idprest_tag,$idprest_t);
              
             }

              $idprest_tag=array_values($idprest_tag);
         }

          $result=array_intersect($idprest_categories,$idprest_tag);
          $result=array_unique($result);
          //$result=[5,6];
          $listings=\App\User::where('user_type','prestataire')->whereIn('id',$result)->get();

        }

        // cas 110
        if($prest_tag && $prest_emplacement && !$Toutes_les_categories)
        {
          // emplacement
         $idprest_emplacement=DB::table('users')->where('user_type','prestataire')->where(function($q) use($prest_emplacement){
               $q->where('adresse','like','%'.$prest_emplacement.'%')->orWhere('ville','like','%'.$prest_emplacement.'%');
             })->pluck('id')->toArray();
         $idprest_emplacement=array_values($idprest_emplacement);

         //tags
         if(stripos($prest_tag, ' ') == false && stripos($prest_tag, ',') == false)
         {
         $idprest_tag=DB::table('users')->where(function($q) use($prest_tag){
               $q->where('titre','like','%'.$prest_tag.'%')->orWhere('keywords','like','%'.$prest_tag.'%')->orWhere('description','like','%'.$prest_tag.'%');
             })->pluck('id')->toArray();
         $idprest_tag=array_values($idprest_tag);
         
         }

         if(stripos($prest_tag, ' ') !== false || stripos($prest_tag, ',') !== false)
         {
              if(stripos($prest_tag, ' ') !== false)
              {
                $prest_tag=str_replace(" ",",",$prest_tag);
              }

             $parcourir_tags=explode(',', $prest_tag);
             $parcourir_tags=array_values( $parcourir_tags);
             //dd($parcourir_tags);
             $idprest_tag=array();
             for($i=0; $i<count($parcourir_tags); $i++)
             {
              
              $idprest_t=DB::table('users')->where(function($q) use($parcourir_tags,$i){
               $q->where('titre','like','%'. $parcourir_tags[$i].'%')->orWhere('keywords','like','%'.$parcourir_tags[$i].'%')->orWhere('description','like','%'.$parcourir_tags[$i].'%');
             })->pluck('id')->toArray();

              $idprest_t=array_values($idprest_t);
              $idprest_tag=array_merge($idprest_tag,$idprest_t);
              
             }

              $idprest_tag=array_values($idprest_tag);
         }

          $result=array_intersect($idprest_emplacement,$idprest_tag);
          $result=array_unique($result);
          //$result=[5,6];
          $listings=\App\User::where('user_type','prestataire')->whereIn('id',$result)->get();

        }




        //return Redirect::route('clients.show, $id')->with( ['data' => $data] );
        //return redirect()->action('RechercheController@show_prestataire_search');
        //\App\Http\Controllers\DossierImmobileController::setCalculDossImm(true);

      /*  return redirect()->action(
            'UserController@profile', ['id' => 1]
        );*/
                
              /*return 'prest_emplacement :'.$prest_emplacement.'/prest_tag : '.$prest_tag .'/Toutes_les_categories : '.$Toutes_les_categories ;*/
   return view('listings_search', compact('listings'));

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
