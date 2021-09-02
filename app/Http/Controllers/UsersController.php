<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator as Paginator; 
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;

use Illuminate\Support\Facades\Hash;
//use Illuminate\Http\PostRequest;
use DB;
use QrCode;
use URL;
use \App\Contact;
use \App\Parametre;

use Illuminate\Support\Facades\Auth;
use Session;
use \App\User;
use \App\Service;
use \App\Client_product;
use \App\Categorie;
use \App\Image;
use \App\Reservation;
use \App\Alerte;
use \App\Produit;
use \App\Calendrier;
use \App\Cartefidelite;
use \App\Codepromo;
use \App\Happyhour;
use \App\Contenu_plan;    
use \App\Emailslist;  
 use Swift_Mailer;
 use Mail;  

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
    public function bindex()
    {
         $cuser = auth()->user();
         
        $User =\App\User::find($cuser->id);
        $user_type=$User->user_type;

        if(   $user_type=='admin' )
        { 
       
       $users = User::where('user_type','client')->get();

      return view('users.bindex',  compact('users') );       
        }
        
    }
    public function editPlan(Request $request)
    {
        //dd($request->idligne);
        if ($request->idligne==0) {

            $a= new Contenu_plan([
                 'abonnement' => $request->abonnement,
                 'contenu'=> $request->contenuPlan
             ]);
            $a->save();  
        } else {
           DB::table('contenu_plans')->where('id', $request->idligne)->update(array('contenu'=> $request->contenuPlan)); 
        }
        return back();
         
    }
    public function deleteLine(Request $request){
        DB::table('contenu_plans')->where('id', $request->idligne)->delete();
        return "ok" ;
    }
    public static function ChangeApropos(Request $request)
    {

        $apropos1a=$request->get('apropos1a');
        DB::table('parametres')->where('id', 1)->update(array('apropos1a'=> $apropos1a));
        $apropos1b=$request->get('apropos1b');
        DB::table('parametres')->where('id', 1)->update(array('apropos1b'=> $apropos1b));

        $apropos2a=$request->get('apropos2a');
        DB::table('parametres')->where('id', 1)->update(array('apropos2a'=> $apropos2a));
        $apropos2b=$request->get('apropos2b');
        DB::table('parametres')->where('id', 1)->update(array('apropos2b'=> $apropos2b));

        $apropos3a=$request->get('apropos3a');
        DB::table('parametres')->where('id', 1)->update(array('apropos3a'=> $apropos3a));
        $apropos3b=$request->get('apropos3b');
        DB::table('parametres')->where('id', 1)->update(array('apropos3b'=> $apropos3b));
        $apropos3c=$request->get('apropos3c');
        DB::table('parametres')->where('id', 1)->update(array('apropos3c'=> $apropos3c));
        
        
        return "ok";
    }
    public static function ChangeBoxes(Request $request)
    {
        $Box1a=$request->get('Box1a');
        DB::table('parametres')->where('id', 1)->update(array('Box1a'=> $Box1a));
        $Box1b=$request->get('Box1b');
        DB::table('parametres')->where('id', 1)->update(array('Box1b'=> $Box1b));

        $Box2a=$request->get('Box2a');
        DB::table('parametres')->where('id', 1)->update(array('Box2a'=> $Box2a));
        $Box2b=$request->get('Box2b');
        DB::table('parametres')->where('id', 1)->update(array('Box2b'=> $Box2b));

        $Box3a=$request->get('Box3a');
        DB::table('parametres')->where('id', 1)->update(array('Box3a'=> $Box3a));
        $Box3b=$request->get('Box3b');
        DB::table('parametres')->where('id', 1)->update(array('Box3b'=> $Box3b));

        $Box4a=$request->get('Box4a');
        DB::table('parametres')->where('id', 1)->update(array('Box4a'=> $Box4a));
        $Box4b=$request->get('Box4b');
        DB::table('parametres')->where('id', 1)->update(array('Box4b'=> $Box4b));
        
        
        return "ok";
    }
    public static function changetext(Request $request)
    {
        $val=$request->get('val');
        $valta1=$request->get('valta1');
        $valta2=$request->get('valta2');
        $valta3=$request->get('valta3');
        $valta4=$request->get('valta4');
        $valta5=$request->get('valta5');
        DB::table('parametres')->where('id', 1)->update(array('hometext'=> $val,'texta1'=> $valta1,'texta2'=> $valta2,'texta3'=> $valta3,'texta4'=> $valta4,'texta5'=> $valta5));
        
        return "ok";
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
            
        $abonnementA =  Contenu_plan::where('abonnement',1)->get();
        $abonnementB =  Contenu_plan::where('abonnement',2)->get();
        $abonnementC =  Contenu_plan::where('abonnement',3)->get();
      return view('parametres', compact('abonnementA','abonnementB','abonnementC') );       
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
    public function prestatairesPro()
    {   
        $cuser = auth()->user();
 
        $user_type=$cuser->user_type;
 
        if(   $user_type=='admin' )
        { 
       
       $users = User::where('user_type','prestataire')->get();

      return view('users.prestatairesPro',  compact('users') );       
        }     

    }
    
    
        public function favoris()
    {   
        
        $cuser = auth()->user();

        $idusers= DB::table('favoris')->where('client',$cuser->id)->pluck('prestataire');

       $users = User::whereIn('id',$idusers)->get();

      return view('users.prestataires',  compact('users') );       
        

    }
    public function favorisPro()
    {   
 
        $cuser = auth()->user();

        $idusers= DB::table('favoris')->where('client',$cuser->id)->pluck('prestataire');

       $users = User::whereIn('id',$idusers)->get();

      return view('users.favorisPro',  compact('users') );       
        

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
    
       public function monespace()
    {
        
      return view('monespace' );   
           
    }
    
       public function listings()
    {
         
      return view('listings' );       

    }
    public function pageprestataires(Request $request)
    {
        $prest_tag= trim($request->get('prest_tag'));
        $prest_emplacement= trim($request->get('prest_emplacement'));
        $Toutes_les_categories=trim($request->get('toutes_categories')); 
        if ($Toutes_les_categories=="Toutes les catégories") {
            $Toutes_les_categories=false;
        }
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
        $krows=\App\User::where('user_type','prestataire')->whereIn('id',$result)->count();
          $listings=\App\User::where('user_type','prestataire')->whereIn('id',$result)->orderBy('id', 'asc')->paginate(5);
          $listings->appends(['tagsearch' => $prest_tag, 'emplacementsearch' => $prest_emplacement, 'catsearch' => $Toutes_les_categories]);

        }
//---------------------------------------------------------------------------------------------
         // cas 000
       if(!$prest_tag && !$prest_emplacement && !$Toutes_les_categories)//tous les prestataires (car toutes les categories)
        {
         // dd('cas 2');
        $krows=\App\User::where('user_type','prestataire')->count();
          $listings=\App\User::where('user_type','prestataire')->orderBy('id', 'asc')->paginate(5);
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
        $krows=\App\User::where('user_type','prestataire')->whereIn('id',$result)->count();
          $listings=\App\User::where('user_type','prestataire')->whereIn('id',$result)->orderBy('id', 'asc')->paginate(5);
          $listings->appends(['catsearch' => $Toutes_les_categories]);
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
        $krows=\App\User::where('user_type','prestataire')->whereIn('id',$result)->count();
          $listings=\App\User::where('user_type','prestataire')->whereIn('id',$result)->orderBy('id', 'asc')->paginate(5);

          $listings->appends(['emplacementsearch' => $prest_emplacement]);
      
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
        $krows=\App\User::where('user_type','prestataire')->whereIn('id',$result)->count();
          $listings=\App\User::where('user_type','prestataire')->whereIn('id',$result)->orderBy('id', 'asc')->paginate(5);
          $listings->appends(['emplacementsearch' => $prest_emplacement, 'catsearch' => $Toutes_les_categories]);
      

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
        $krows=\App\User::where('user_type','prestataire')->whereIn('id',$result)->count();
          $listings=\App\User::where('user_type','prestataire')->whereIn('id',$result)->orderBy('id', 'asc')->paginate(5);
          $listings->appends(['tagsearch' => $prest_tag]);

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
        $krows=\App\User::where('user_type','prestataire')->whereIn('id',$result)->count();
          $listings=\App\User::where('user_type','prestataire')->whereIn('id',$result)->orderBy('id', 'asc')->paginate(5);
          $listings->appends(['tagsearch' => $prest_tag, 'catsearch' => $Toutes_les_categories]);

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
        $krows=\App\User::where('user_type','prestataire')->whereIn('id',$result)->count();
          $listings=\App\User::where('user_type','prestataire')->whereIn('id',$result)->orderBy('id', 'asc')->paginate(5);
          $listings->appends(['tagsearch' => $prest_tag, 'emplacementsearch' => $prest_emplacement]);

        }
//new \Illuminate\Pagination\LengthAwarePaginator
        //$page_links = new \Illuminate\Pagination\LengthAwarePaginator($listings , $krows, 5);

      return view('pageprestataires')->with('listings',$listings);
      //->with('page_links',$page_links);
      //, compact('listings') );       
      //return view('pageprestataires')->with(['listings' => $listings->paginate(10)]);

    }
    
    public function comingsoon()
    {
         
      return view('comingsoon' );       

    }

      public function home()
    {
         
      //return view('home' );     
      return view('comingsoon' );     

    }

          public function accueil()
    {
         
      return view('accueil' );       

    }
    
              public function inscriptionpro()
    {
         
      return view('inscriptionpro' );       

    }
              public function inscriptionClient()
    {
         
      return view('inscriptionclient' );       

    }
       public function pricing()
    {
        $abonnementA =  Contenu_plan::where('abonnement',1)->get();
        $abonnementB =  Contenu_plan::where('abonnement',2)->get();
        $abonnementC =  Contenu_plan::where('abonnement',3)->get();
         
      return view('pricing' , compact('abonnementA','abonnementB','abonnementC'));       

    }
    
    public function abonnements()
    {
       
      return view('abonnements' );       

    }
    
    public function remerciments()
    {
       
      return view('remerciments');       

    }

    public function choixpayement ()
    {

    	 return view('choix_payement');
    }
    
  public function offrelancement()
    {
    	$abonnementA =  Contenu_plan::where('abonnement',1)->get();
        $abonnementB =  Contenu_plan::where('abonnement',2)->get();
        $abonnementC =  Contenu_plan::where('abonnement',3)->get();
         
      return view('offrelancement' , compact('abonnementA','abonnementB','abonnementC')); 
      
    
    }
    public function OffreLancement_anne2()
    {
    	$abonnementA =  Contenu_plan::where('abonnement',1)->get();
        $abonnementB =  Contenu_plan::where('abonnement',2)->get();
        $abonnementC =  Contenu_plan::where('abonnement',3)->get();
         
      return view('OffreLancement_anne2' , compact('abonnementA','abonnementB','abonnementC'));     
    
    }
    
    
      public function apropos()
    {
         
      return view('apropos' );       

    }
    
      public function contact()
    {

         
      return view('contact');       

    }
    public function contactv2(Request $request)
    {
     
   $contact  = new Contact([
        'nom' => $request->input('nom'),
        'prenom' => $request->input('prenom'),
        'email' => $request->input('email'),
        'telephone' => $request->input('telephone'),

        'contenu' => $request->input('contenu'),
     ]);

  $contact->save();

  Session::put('sucmessage', 'Envoyer avec succès');

  return redirect()->route('contactv2'); 
          

    }
     
      public function viewlisting($slug,$id)
    {
        $reduction=0;
        $user = User::find($id);
        $today= new DateTime();
        $happyhours = Happyhour::where('id_user',$id)->where('dateFin','>=',$today)->get();
        
        $produit= Produit::where('user',$id)->get();
         //dd($today);
        $myhappyhours = Happyhour::where('id_user' ,$id)->where('dateDebut','<=',$today)->where('dateFin','>=',$today)->where('places','>','Beneficiaries')->first();
        //dd($myhappyhours);

         if (Auth::guest())
            return view('viewlisting' ,  compact('user','id','reduction','happyhours','myhappyhours','produit'));
            //return view('viewprestataire' ,  compact('user','id','reduction','happyhours','myhappyhours','produit'));
        $cuser = auth()->user();
        $clientProduct= Client_product::where('id_client',$cuser->id)->get();

        //dd($cuser->id);
        $test=Cartefidelite::where('id_client',$cuser->id)->where('id_prest',$id)->exists();
        if ($test=='true') {
            $nbrRes=Cartefidelite::where('id_client',$cuser->id)->where('id_prest',$id)->value('nbr_reservation');
            if ($nbrRes==9) {
                $reduction=User::where('id',$id)->value('reduction');
            }
            }
        return view('viewlisting' ,  compact('user','id','reduction','happyhours','myhappyhours','produit'));
        
        //return view('viewprestataire' ,  compact('user','id','reduction','happyhours','myhappyhours','produit'));     

    }
    
     public function profile($id)
    {
        $cuser = auth()->user();
         
        $user_type=$cuser->user_type;
        $user_id=$cuser->id;

        if(  $user_id == $id || $user_type=='admin' )
        {   
        $user = User::find($id);
       

       // return view('users.profile',  compact('user','id')); 
        return view('users.profile2',  compact('user','id')); 
        
        }
        

    }
      
  public function FirstService(Request $request)
  {
     
    $id= $request->get('idchange');
  
    $val= $request->get('valchange');
    User::where('id', $id)->update(array('FirstService' => $val));



   }
    public function SectionProd(Request $request)
    {
      
       
      $id= $request->get('idchange');
      $val= strval($request->get('valchange'));
      User::where('id', $id)->update(array('section_product' => $val));
  return "ok";
  
  
     }
     public function ClientProd(Request $request)
     {
      $val= $request->get('idProduit');
      $id= $request->get('idclient');
      $clientProduct= new Client_product([
        'id_products' => $val,
        'id_client' => $id,
       ]);

  $clientProduct->save();
        

   
   
   
      }
    public function listing($id)
    {
        $cuser = auth()->user();
        $user_type=$cuser->user_type;
        $user_id=$cuser->id;

         $services =\App\Service::where('user',$id)->get();
         $produit= Produit::where('user',$id)->get();
         $clientProduct= Client_product::where('id_client',$cuser->id)->get();


        
        if(  $user_id == $id || $user_type=='admin' )
        {   
        $user = User::find($id);
        $categories = Categorie::orderBy('nom', 'asc')->get();
        $categories_user =  DB::table('categories_user')->where('user',$id)->pluck('categorie');


        $serviceWithCode = Codepromo::where('user_id',$user_id)->get();
        $happyhours = Happyhour::where('id_user',$user_id)->get();


        return view('users.listing',  compact('user','id','services','categories','categories_user','serviceWithCode','happyhours','produit','clientProduct')); 
        
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
        if($champ=='titre' && $id)
        {
           $valkbs= trim($request->get('val'));
           if($valkbs)
           {
             $nouv_slug=Str::slug($valkbs,'-');
             $nouv_qrcode=$nouv_slug.'-'.$id.'.png';
            // $ancien_qrcode=User::where('id',$id)->first()->qr_code;
             $ancien_qrcode=User::where('id',$id)->first();
             if($ancien_qrcode)
             {
              $ancien_qrcode= $ancien_qrcode->titre;
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
    return back();

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

        return back();
    }

    
     public function remove($id)
    {
        $user = User::find($id);
        $user->delete();

        return back();
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

    public function addemail(Request $request)
    {
        //dd($request->emailprest);
        if ($request->addemail!=="") {

            $a= new Emailslist([
                 'email' => $request->emailprest
             ]);
            $a->save();  
        } 
        return redirect()->route('comingsoon')->with([
            'smessage' => ' successfully'
        ]);
         
    }
    
    public function changeAcompte(Request $request)
    {
        //dd($request->emailprest);
      DB::table('users')->where('id', $request->user)->update(array('acompte'=> $request->val));
        return "ok";
         
    }
    public function downloadCSV(Request $request)
    {
        //dd($request->emailprest);
      $cuser = auth()->user();
      $todayy=date('Y-m-d');
        $today= new DateTime();
        $x = $today->format('d');
        $m = $today->format('M');
       $y=$x[1]-1;
        $debut = date('Y-m-d', strtotime($todayy. ' - '.$y.' days'));
        $fin=date('Y-m-d');
      $CA = DB::select( DB::raw("SELECT sum(Net) as somme FROM reservations WHERE prestataire='+$cuser->id+'AND created_at <='$fin 23:59:59' AND created_at  >='$debut 00:00:00'" ) );
      $s=$CA[0]->somme ;
      if ($s==null) {
        $s=0;
      }
      $data = array();
     $data[] ='chifre d\'affaire, mois' ;
      $data[] = ''.$s.','.$m.'';
      
      header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="sample.csv"');
//$data = array('chifre d\'affaire, mois', '1289, aout');

$fp = fopen('php://output', 'wb');
foreach ( $data as $line ) {
    $val = explode(",", $line);
    fputcsv($fp, $val);
}
fclose($fp);
        //return "ok";
         
    }
    public function portefeuilles($id)
    {
        $cuser = auth()->user();
        $user_type=$cuser->user_type; 
        $user_id=$cuser->id;
        
        if(  $user_id == $id || $user_type=='admin' )
           
        { 
        $todayy=date('Y-m-d');
        $today= new DateTime();
        $x = $today->format('d');
       $y=$x[1]-1;
        $debut = date('Y-m-d', strtotime($todayy. ' - '.$y.' days'));
        $fin=date('Y-m-d');
        $user = User::find($id);
        $Somme = DB::select( DB::raw("SELECT sum(Net) as somme FROM reservations WHERE prestataire='+$cuser->id+'" ) );
        //dd($Somme[0]);
        
        $CA = DB::select( DB::raw("SELECT sum(Net) as somme FROM reservations WHERE prestataire='+$cuser->id+'AND created_at <='$fin 23:59:59' AND created_at  >='$debut 00:00:00'" ) );
        $res= DB::select( DB::raw("SELECT count(Net) as nbr FROM reservations WHERE prestataire='+$cuser->id+'" ) );
        $payment = DB::select( DB::raw("SELECT * FROM payments WHERE user='+$cuser->id+'" ) );
        $revenues  = DB::select( DB::raw("SELECT * FROM payments WHERE beneficiaire_id  ='+$cuser->id+'" ) );
        //dd($payment);

        return view('users.portefeuilles',  compact('user','id','Somme','CA','res','payment','revenues')); 
        
        }
        
    }

      public function titredescription($id)
    {
        $cuser = auth()->user();
        $user_type=$cuser->user_type;
        $user_id=$cuser->id;
        
        if(  $user_id == $id || $user_type=='admin' )
        {   
        $user = User::find($id);


        return view('entreprise.titredescription',  compact('user','id')); 
        
        }
        
    }

    // change titre description entreprise
        public static function changetitredescription(Request $request)
    {
        $id=$request->get('id');
        $valta1=$request->get('titre');
        $valta2=$request->get('responsable');
        $valta3=$request->get('description');
        $valta4=$request->get('keywords');
        DB::table('users')->where('id', $id)->update(array('titre'=> $valta1,'responsable'=> $valta2,'description'=> $valta3,'keywords'=> $valta4));
        
        Session::put('ttmessage', 'Enregistré avec succès');
        return back();
    }


            public function emplacement($id)
    {
        $cuser = auth()->user();
        $user_type=$cuser->user_type;
        $user_id=$cuser->id;
        
        if(  $user_id == $id || $user_type=='admin' )
        {   
        $user = User::find($id);


        return view('entreprise.emplacement',  compact('user','id')); 
        
        }
        
    }

    // change titre description entreprise
        public static function changeemplacement(Request $request)
    {
        $id=$request->get('id');
        $valta1=$request->get('adresse');
        $valta2=$request->get('ville');
        $valta3=$request->get('fhoraire');
        $valta4=$request->get('latitude');
        $valta5=$request->get('longitude');
        DB::table('users')->where('id', $id)->update(array('adresse'=> $valta1,'ville'=> $valta2,'fhoraire'=> $valta3,'latitude'=> $valta4,'longitude'=> $valta5));
        
        
        Session::put('empmessage', 'Enregistré avec succès');
        return back();
    }


        public function InfosContact($id)
    {
        $cuser = auth()->user();
        $user_type=$cuser->user_type;
        $user_id=$cuser->id;
        
        if(  $user_id == $id || $user_type=='admin' )
        {   
        $user = User::find($id);


        return view('entreprise.InfosContact',  compact('user','id')); 
        
        }
    }
    // change Infos de Contact entreprise
        public static function changeInfosContact(Request $request)
    {
        $id=$request->get('id');
        
        DB::table('users')->where('id', $id)->update(array(
          'tel'=> $request->get('Phone'),
          'email'=> $request->get('email'),
          'linkedin'=> $request->get('linkedin'),
          'twitter'=> $request->get('twitter'),
          'instagram'=> $request->get('instagram'),
          'fb'=> $request->get('fb')));
        
        Session::put('ttmessage', 'Enregistré avec succès');
        return back();
    }
     public function HoraireOuverture($id)
    {
        $cuser = auth()->user();
        $user_type=$cuser->user_type;
        $user_id=$cuser->id;
        
        if(  $user_id == $id || $user_type=='admin' )
        {   
        $user = User::find($id);


        return view('entreprise.HoraireOuverture',  compact('user','id')); 
        
        }
    }
    public function changeHeuresOuverture(Request $request)
    {
        //dd($request);
        $id=$request->get('id');
        
        DB::table('users')->where('id', $id)->update(array(
          'lundi_o'=> $request->get('lundi_o'),
          'lundi_f'=> $request->get('lundi_f'),
          'mardi_o'=> $request->get('mardi_o'),
          'mardi_f'=> $request->get('mardi_f'),
          'mercredi_o'=> $request->get('mercredi_o'),
          'mercredi_f'=> $request->get('mercredi_f'),
          'jeudi_o'=> $request->get('jeudi_o'),
          'jeudi_f'=> $request->get('jeudi_f'),
          'vendredi_o'=> $request->get('vendredi_o'),
          'vendredi_f'=> $request->get('vendredi_f'),
          'samedi_o'=> $request->get('samedi_o'),
          'samedi_f'=> $request->get('samedi_f'),
          'dimanche_o'=> $request->get('dimanche_o'),
          'dimanche_f'=> $request->get('dimanche_f')));
        
        Session::put('ttmessage', 'Enregistré avec succès');
        return back();
    }
     public function Categories($id)
    {
        $cuser = auth()->user();
        $user_type=$cuser->user_type;
        $user_id=$cuser->id;
        
        if(  $user_id == $id || $user_type=='admin' )
        {   
        $user = User::find($id);
        $categories = Categorie::orderBy('nom', 'asc')->get();
        $categories_user =  DB::table('categories_user')->where('user',$id)->pluck('categorie');


        return view('entreprise.Categories',  compact('user','id','categories' ,'categories_user')); 
        
        }
    }
    public function changeCategories()
    {
        dd("okkkkkkkk");
    }
    public function ImagesVideo($id)
    {
        $cuser = auth()->user();
        $user_type=$cuser->user_type;
        $user_id=$cuser->id;
        
        if(  $user_id == $id || $user_type=='admin' )
        {   
        $user = User::find($id);


        return view('entreprise.ImagesVideo',  compact('user','id')); 
        
        }
    }
    public function HeuresIndisponibilite($id)
    {
        $cuser = auth()->user();
        $user_type=$cuser->user_type;
        $user_id=$cuser->id;
        
        if(  $user_id == $id || $user_type=='admin' )
        {   
        $user = User::find($id);


        return view('entreprise.HeuresIndisponibilite',  compact('user','id')); 
        
        }
    }
   public function existance_email (Request $request)
   {
   	 $email=$request->get('email');

   	 $existe=User::where('email',$email)->first();
   
      if($existe)
      {
        return "existe";
      }
      else
      {
        return "nonexiste";
      }

   	  
   }

   public function send_email_to_all_subcribers()
   {

   	$users_offre_lancement=Emailslist::get(["email"]);

   	$destinataires = array();

        if ($users_offre_lancement && count($users_offre_lancement)>0) {
            foreach ($users_offre_lancement as $uol) {
                array_push($destinataires, $uol);

            }
        }

     $chunks = array_chunk($destinataires, 50);

        // parcours divisions
        foreach ($chunks as $chunk)
        {

        	 $message='Bonjour,<br>';
             $message.='Notre plateforme est maitenant lancée <br>';
             $message.="Veuillez visiter le lien suivant : <br>";
             $message.='<b><a href="https://prenezunrendezvous.com/" > prenezunrendezvous.com </a></b>'; 
    
    //mohamed.achraf.besbes@gmail.com
     $this->sendMail($chunk,'Invitation',$message) ;
   


         }


   }

   public function sendMail($to,$sujet,$contenu){

    $swiftTransport =  new \Swift_SmtpTransport( 'smtp.gmail.com', '587', 'tls');
    //$swiftTransport->setUsername(\Config::get('mail.username')); //adresse email
    //$swiftTransport->setPassword(\Config::get('mail.password')); // mot de passe email

    $swiftTransport->setUsername('prestataire.client@gmail.com'); //adresse email
    $swiftTransport->setPassword('prestataire1998'); // mot de passe email eSolutions2020*

        $swiftMailer = new Swift_Mailer($swiftTransport);
    Mail::setSwiftMailer($swiftMailer);
    $from=\Config::get('mail.from.address') ;
    $fromname=\Config::get('mail.from.name') ;
    
    Mail::send([], [], function ($message) use ($to,$sujet, $contenu,$from,$fromname   ) {
      //dd($contenu);

         $message
                 ->to($to)
                    ->subject($sujet)
                       ->setBody($contenu, 'text/html')
                    ->setFrom([$from => $fromname]);         

      });
    
  }
    

public function Services($id)
    {
      //dd("ok")
        $cuser = auth()->user();
        $user_type=$cuser->user_type;
        $user_id=$cuser->id;
        
        if(  $user_id == $id || $user_type=='admin' )
        {   
        $user = User::find($id);
         $services =\App\Service::where('user',$id)->get();



        return view('entreprise.Servicess',  compact('user','id','services')); 
        
        }
    }
    public function AjouterService(Request $request)
    
      {
      //dd("ok")
        $id=$request->get('id');
        $cuser = auth()->user();
        $user_type=$cuser->user_type;
        $user_id=$cuser->id;
        
        if(  $user_id == $id || $user_type=='admin' )
        {   
        $user = User::find($id);
         $services =\App\Service::where('user',$id)->get();
         $produit= Produit::where('user',$id)->get();
         $service =\App\Service::where('id',5)->first();



        return view('entreprise.AddService',  compact('user','id','services','produit','service')); 
        
        }
    }
    
    
    public function ServicesSupplementaires($id)
    {
        $cuser = auth()->user();
        $user_type=$cuser->user_type;
        $user_id=$cuser->id;
        
        if(  $user_id == $id || $user_type=='admin' )
        {   
        $user = User::find($id);


        return view('entreprise.ServicesSupplementaires',  compact('user','id')); 
        
        }
    }
    public function Produits($id)
    {
        $cuser = auth()->user();
        $user_type=$cuser->user_type;
        $user_id=$cuser->id;
        
        if(  $user_id == $id || $user_type=='admin' )
        {   
        $user = User::find($id);
        $produit= Produit::where('user',$id)->get();

        return view('entreprise.Produits',  compact('user','id','produit')); 
        
        }
    }
    public function CodesPromo($id)
    {
        $cuser = auth()->user();
        $user_type=$cuser->user_type;
        $user_id=$cuser->id;
        
        if(  $user_id == $id || $user_type=='admin' )
        {   
        $user = User::find($id);
        $serviceWithCode = Codepromo::where('user_id',$user_id)->get();
        $services =\App\Service::where('user',$id)->get();


        return view('entreprise.CodesPromo',  compact('user','id','serviceWithCode','services')); 
        
        }
    }
    public function CarteFidelite($id)
    {
        $cuser = auth()->user();
        $user_type=$cuser->user_type;
        $user_id=$cuser->id;
        
        if(  $user_id == $id || $user_type=='admin' )
        {   
        $user = User::find($id);


        return view('entreprise.CarteFidelite',  compact('user','id')); 
        
        }
    }
    public function HappyHours($id)
    {
        $cuser = auth()->user();
        $user_type=$cuser->user_type;
        $user_id=$cuser->id;
        
        if(  $user_id == $id || $user_type=='admin' )
        {   
        $user = User::find($id);
        $happyhours = Happyhour::where('id_user',$user_id)->get();


        return view('entreprise.HappyHours',  compact('user','id','happyhours')); 
        
        }
    }
    public function FAQ($id)
    {
        $cuser = auth()->user();
        $user_type=$cuser->user_type;
        $user_id=$cuser->id;
        
        if(  $user_id == $id || $user_type=='admin' )
        {   
        $user = User::find($id);


        return view('entreprise.FAQ',  compact('user','id')); 
        
        }
    }

    public function changepassword(Request $request)
    {
       /* $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);*/
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

       Session::put('changeprofile', 'mot de passe a été changé avec succès');

   
       return back();
    }

     public function changeinfoprofile(Request $request)
    {
       /* $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);*/
   
       
         $photo='';
        if($request->file('photo')!=null)
		    {
		    	$image=$request->file('photo');
		      $photo =  $image->getClientOriginalName();
		                 $path = storage_path()."/photo_profile/";
		      $date=date('d-m-Y-H-i-s');
		     $photo=$date.'_pf_'.$photo ;
		         $image->move($path, $photo );
		    }


		     User::find(auth()->user()->id)->update([
                'name'=> $request->get('name'),
                'lastname'=> $request->get('lastname'), 
                'phone'=> $request->get('phone'),
                'email'=> $request->get('email'),
                'adresse'=> $request->get('adresse'),
                 'ville'=> $request->get('ville'),
                 'codep'=> $request->get('codep'),
                 'fb'=> $request->get('fb'),
                 'instagram'=> $request->get('instagram'),
                 'twitter'=> $request->get('twitter'),
                 

		     	]);

		     if($photo)
		     {
		     	 User::find(auth()->user()->id)->update(['photo_profil'=> $photo]);

		     }

       Session::put('changeprofile', 'Votre profile a été mis à jour avec succès');

   
       return back();
    }

 }
