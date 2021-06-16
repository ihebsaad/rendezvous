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
use \App\PropositionDatesServicesAbn;
use \App\Reservation;
use Swift_Mailer;
use Mail;
use DateTime;

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
        /* $service  = new Service([

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
           ]);*/
            $service  = new Service([

              'user' => $request->get('user'),
              'nom' => $request->get('nom'),
              'description' => $request->get('description'),
              'prix' => $request->get('prix'),
              'duree' => $request->get('duree'),
              'Nfois' => $request->get('Nfois'),
              
              'periode' => $request->get('mySelect'),
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
    //($request);
    $nameF='';
     if($request->file('Fichier')!=null)
    {$Fichier=$request->file('Fichier');
      
     $nameF = str_replace(' ', '', $Fichier->getClientOriginalName()); 

                 $pathF = public_path()."/Fichiers/";
                 //dd($pathF);
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
      
     $nameF = str_replace(' ', '', $Fichier->getClientOriginalName()); 

                 $pathF = public_path()."/Fichiers/";
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


    // services à abonnement récurrent  nouvelle version

     //exécuté par prestataire
    public function annulerPprestataire($id)
    {

      $proprendezvous=PropositionDatesServicesAbn::where('id',$id)->first();
      $proprendezvous->delete();
      $proprendezvous->save();

      //  envoi un mail pour le client en lui informant que le prestataire a annulé la préservation.

       // envoi mail au client pour confirmer les dates finales de seances 

           $prestataire=User::where('id',$proprendezvous->prestataire)->first();
           $client=User::where('id',$proprendezvous->client)->first();
           $service =Service::where('id',$proprendezvous->service_rec)->first();
           $mail_client="mail inexistant";
           $nom_prestataire="client inexistant";
           $nom_service="service inexistant";
           if($client)
           {
            if($client->email)
            {
               $mail_client= $client->email;
            }
           }
            if($prestataire)
           {
             if($prestataire->name && $prestataire->lastname)
             {
             $nom_prestataire= $prestataire->name." ".$prestataire->lastname;
             } 
           }
            if($service)
           {
             if($service->nom)
             { 
                $nom_service=$service->nom;
              }
            
           }
           $dateres="--";
           if($proprendezvous->datesConfirmees)
           {
           $dateres = $proprendezvous->datesConfirmees ;
           }

         
            $message=''; 
           
           $message.='<br>Bonjour Cher client<br>Le prestataire  '.$nom_prestataire.' a annulé votre pré-réservation de service récurrent: '.$nom_service.' <br> Cordialement';
           // envoi mail au prestataire 
           $this->sendMail(trim($mail_client),'Annulation de la pré-réservation de service par le prestataire  '.$nom_prestataire.'  ',$message) ; 

             return "ok" ; 

     //   return($id);

    }

    //exécuté  par client
    public function annulerPclient($id)
    {
      
      $proprendezvous=PropositionDatesServicesAbn::where('id',$id)->first();
      $proprendezvous->delete();
      $proprendezvous->save();

      //  envoi un mail pour le prestataire  en lui informant que le client a annulé la préservation.

       $prestataire=User::where('id',$proprendezvous->prestataire)->first();
           $client=User::where('id',$proprendezvous->client)->first();
           $service =Service::where('id',$proprendezvous->service_rec)->first();
           $mail_prest="mail inexistant";
           $nom_client="client inexistant";
           $nom_service="service inexistant";
           if($prestataire)
           {
            if($prestataire->email)
            {
               $mail_prest= $prestataire->email;
            }
           }
            if($client)
           {
             if($client->name && $client->lastname)
            {
             $nom_client= $client->name." ".$client->lastname;
            }
           }
            if($service)
           {
             if($service->nom)
              { 
                $nom_service=$service->nom;
              }
            
           }
           //return 'ok';
          
           
           $message='';
           $message.='<br>Bonjour <br>Le client a annulé la pré-réservation concernant le service récurrent '.$nom_service.'<br> Cordialement';
           // envoi mail au prestataire 
           $this->sendMail(trim($mail_prest),'Annulation de la pré-réservation de service par le client  '.$nom_client.' ',$message) ; 


      return('ok');



    // return($id);

    }
    
    //exécuté   par client
    public function  accepterPropDates($id)
    {
      $proprendezvous=PropositionDatesServicesAbn::where('id',$id)->first();
      $id_recc=$proprendezvous->id_reservation;
      /*$proprendezvous->update(['decision_clt'=>'accepter']);
      $proprendezvous->save();*/

      // déplacer la préservation à la table de réservation en supprimant aaisn la préservation 

      $seances = explode(";", $proprendezvous->datesProposees);

      unset($seances[0]);

      $res=array();

      for($i=1; $i<=count($seances); $i++)
      {
          $res[]=explode("à" ,$seances[$i]);         
      }
      for($j=0 ; $j<count($res); $j++)
      {
        if($j!=0)
        {
         $reservation=Reservation::whereNotNull('id_recc')->where('id_recc',$id_recc)->where('ordre_recc', $j+1)->first();
          $date=DateTime::createFromFormat("d/m/Y H:i", trim($res[$j][1]));
          $reservation->update(['date_reservation'=>$date,'visible'=>1,'statut'=>1]);
          $reservation->save(); 
        }
        else
        {
          $reservation=Reservation::where('id',$id_recc)->first();  
          $date=DateTime::createFromFormat("d/m/Y H:i", trim($res[0][1])); 
          $reservation->update(['date_reservation'=>$date,'visible'=>1,'statut'=>1]);
          $reservation->save();
         //  return($date->format('Y-m-d H:i'));
        }

      }
      $proprendezvous->delete();
      $proprendezvous->save();

      // envoi un mail au prestataire en lui informant que le client a accepté les dates proposé par le client

       $prestataire=User::where('id',$proprendezvous->prestataire)->first();
           $client=User::where('id',$proprendezvous->client)->first();
           $service =Service::where('id',$proprendezvous->service_rec)->first();
           $mail_prest="mail inexistant";
           $nom_client="client inexistant";
           $nom_service="service inexistant";
           if($prestataire)
           {
            if($prestataire->email)
            {
               $mail_prest= $prestataire->email;
            }
           }
            if($client)
           {
             if($client->name && $client->lastname)
            {
             $nom_client= $client->name." ".$client->lastname;
            }
           }
            if($service)
           {
             if($service->nom)
              { 
                $nom_service=$service->nom;
              }
            
           }
           //return 'ok';
           $dateresprop=" ";
           if($proprendezvous->datesProposees)
           {
           $dateresprop = $proprendezvous->datesProposees;
           }
           
           $message='';
           $message.='<br>Bonjour <br>Le client a accepté les dates de séances ('. $dateresprop.') pour le service récurrent '.$nom_service.'<br> Cordialement';
           // envoi mail au prestataire 
           $this->sendMail(trim($mail_prest),'Acceptation des dates de séances par le client : ('.$nom_client.')',$message) ; 


      return('ok');

      //  envoi un mail pour le prestataire en lui informant que le client a accepté la proposition de dates dee seances 



    // inseration dans les calendriers 


      //return($id);

    }

    //exécuté par client si les dates proposées par le prestataire ne convient pas au 

     public function rendezvousTel(Request $req)
     {
        // return($req->get('id_prop_date').' '.$req->get('DaterendezvousTel'));
         if($req->get('id_prop_date') && $req->get('DaterendezvousTel') )
         {

           $proprendezvous=PropositionDatesServicesAbn::where('id',$req->get('id_prop_date'))->first();
           $proprendezvous->update(['rendezvoustel'=> trim($req->get('DaterendezvousTel'))]);
           $proprendezvous->save();

           $prestataire=User::where('id',$proprendezvous->prestataire)->first();
           $client=User::where('id',$proprendezvous->client)->first();
           $service =Service::where('id',$proprendezvous->service_rec)->first();
           $mail_prest="mail inexistant";
           $nom_client="client inexistant";
           $nom_service="service inexistant";
           if($prestataire)
           {
            if($prestataire->email)
            {
               $mail_prest= $prestataire->email;
            }
           }
            if($client)
           {
             if($client->name && $client->lastname)
            {
             $nom_client= $client->name." ".$client->lastname;
            }
           }
            if($service)
           {
             if($service->nom)
             { 
                $nom_service=$service->nom;
              }
            
           }
           //return 'ok';
           $dateres="--";
           if($proprendezvous->rendezvoustel)
           {
           $dateres = new DateTime($proprendezvous->rendezvoustel);  $dateres->format('d/m/Y H:i') ;
           }

           $message='';
           $message.='<br><br>Ce client vous propose la date suivante '.$dateres->format('d/m/Y H:i').' pour faire une communication téléphonique pour se mettre d\'accord sur les dates de séances de service récurrent '.$nom_service;
           // envoi mail au prestataire 
           $this->sendMail(trim($mail_prest),'Rendez-vous téléphonique pour confirmer les dates de séances avec le client : ('.$nom_client.')',$message) ; 

           return 'ok';

           //return back();

         }
       
     }

     //exécuté par prestataire
      public function insererDatesfinales (Request $req)
      {


         //$req->get('id_prop_date')
         $nbr=intval(trim( $req->get('nbr_dates')));
         $ch='';

         for($i=0; $i< $nbr ; $i++)
         {
           $date=str_replace("T"," ",$req->Datesfinales[$i]);
           $dateres = new DateTime($date);  
           $ch.=' ; Séance '.($i+1).' à '.$dateres->format('d/m/Y H:i') ;

         }

         //  ici à la place de sauvgarder directement les dates confirmés dans la base , on remplace la pré-réservation par une préservation directe 
         $proprendezvous=PropositionDatesServicesAbn::where('id',$req->get('id_prop_date'))->first();
         $id_recc=$proprendezvous->id_reservation;

      $seances = explode(";", $ch);

      unset($seances[0]);

      $res=array();

      for($i=1; $i<=count($seances); $i++)
      {
          $res[]=explode("à" ,$seances[$i]);         
      }
      for($j=0 ; $j<count($res); $j++)
      {
        if($j!=0)
        {
         $reservation=Reservation::whereNotNull('id_recc')->where('id_recc',$id_recc)->where('ordre_recc', $j+1)->first();
          $date=DateTime::createFromFormat("d/m/Y H:i", trim($res[$j][1]));
          $reservation->update(['date_reservation'=>$date,'visible'=>1,'statut'=>1]);
          $reservation->save(); 
        }
        else
        {
          $reservation=Reservation::where('id',$id_recc)->first();  
          $date=DateTime::createFromFormat("d/m/Y H:i", trim($res[0][1])); 
          $reservation->update(['date_reservation'=>$date,'visible'=>1,'statut'=>1]);
          $reservation->save();
         //  return($date->format('Y-m-d H:i'));
        }

      }
      $proprendezvous->delete();
      $proprendezvous->save();


         //return $ch; 
  
         /*for($i=0; $i< $nbr ; $i++)
         {
           $date=str_replace("T"," ",$req->get('Datesfinales'.$i));
           $dateres = new DateTime($date);  
           $ch.=' ; Séance '.($i+1).' à '.$dateres->format('d/m/Y H:i') ;

         }*/

           
           /*$proprendezvous->update(['datesConfirmees'=> $ch]);
           $proprendezvous->save();*/

           // envoi mail au client pour confirmer les dates finales de seances 

           $prestataire=User::where('id',$proprendezvous->prestataire)->first();
           $client=User::where('id',$proprendezvous->client)->first();
           $service =Service::where('id',$proprendezvous->service_rec)->first();
           $mail_client="mail inexistant";
           $nom_prestataire="client inexistant";
           $nom_service="service inexistant";
           if($client)
           {
            if($client->email)
            {
               $mail_client= $client->email;
            }
           }
            if($prestataire)
           {
             if($prestataire->name && $prestataire->lastname)
             {
             $nom_prestataire= $prestataire->name." ".$prestataire->lastname;
             } 
           }
            if($service)
           {
             if($service->nom)
             { 
                $nom_service=$service->nom;
              }
            
           }
           $dateres="--";
           if($proprendezvous->datesConfirmees)
           {
           $dateres = $proprendezvous->datesConfirmees ;
           }

         
            $message=''; 
           
           $message.='<br><br>Les dates de séances confirmées avec le prestataire '.$nom_prestataire.' pour le service récurrent: '.$nom_service.' sont les suivantes : '.$dateres.' SVP soyez à l\'heure';
           // envoi mail au prestataire 
           $this->sendMail(trim($mail_client),'Rendez-vous confirmées pour les dates de séances avec le prestataire : ('.$nom_prestataire.')',$message) ; 

             return "ok" ; 

           // inseration dans les calendriers 

          // déplacer la préservation à la table de réservation en supprimant aaisn la préservation 




         //$ch= str_replace("T"," ",$ch);
         //dd($ch); 
          

      }

     //exécuté par prestataire
       public function proposerDates (Request $req)
      {
        //dd($req->all());
         //$req->get('id_prop_date')
         $nbr=intval(trim( $req->get('nbr_dates')));
         $ch='';
         

          for($i=0; $i< $nbr ; $i++)
         {
           $date=str_replace("T"," ",$req->datesProposees[$i]);
           $dateres = new DateTime($date);  
           $ch.=' ; Séance '.($i+1).' à '.$dateres->format('d/m/Y H:i') ;

         }
         //return $ch; 

         /*for($i=0; $i< $nbr ; $i++)
         {
           $date=str_replace("T"," ",$req->get('proposerDates'.$i));
           $dateres = new DateTime($date);  
           $ch.=' ; Séance '.($i+1).' à '.$dateres->format('d/m/Y H:i') ;

         }*/

           $proprendezvous=PropositionDatesServicesAbn::where('id',$req->get('id_prop_date'))->first();
           $proprendezvous->update(['datesProposees'=> $ch]);
           $proprendezvous->save();

           // envoi mail au client pour confirmer les dates finales de seances 

           $prestataire=User::where('id',$proprendezvous->prestataire)->first();
           $client=User::where('id',$proprendezvous->client)->first();
           $service =Service::where('id',$proprendezvous->service_rec)->first();
           $mail_client="mail inexistant";
           $nom_prestataire="client inexistant";
           $nom_service="service inexistant";
           if($client)
           {
            if($client->email)
            {
               $mail_client= $client->email;
            }
           }
            if($prestataire)
           {
             if($prestataire->name && $prestataire->lastname)
             {
             $nom_prestataire= $prestataire->name." ".$prestataire->lastname;
             } 
           }
            if($service)
           {
             if($service->nom)
             { 
                $nom_service=$service->nom;
              }
            
           }
           $dateres="--";
           if($proprendezvous->datesProposees)
           {
           $dateres = $proprendezvous->datesProposees ;
           }

           $message='';
           $message.='<br><br>Les dates de séances proposées par le prestataire '.$nom_prestataire.' pour le service récurrent: '.$nom_service.' sont les suivantes : '.$dateres.' SVP soyez à l\'heure et n\'oubliez pas d\'accepter ces dates dans votre panneau admin (Cliquez le bouton accepter dans la ligne de pré-réservation dans la table "Dates de réservation de services à abonnement proposées par le prestataire" ), si ces dates ne vous conviennent pas, alors, dans ce cas, vous pouvez proposer un rendez-vous pour une communication téléphonique afin de confirmer les dates de séances que vous conviennent (appuyez sur le bouton "Rendez-vous avec le prestataire")';
           // envoi mail au prestataire 
           $this->sendMail(trim($mail_client),'Les dates de séances proposées par le prestataire : '.$nom_prestataire.'',$message) ; 

           return "ok";

           // inseration dans les calendriers 

         //$ch= str_replace("T"," ",$ch);
         //dd($ch); 
        

      }

      public function sendMail($to,$sujet,$contenu){

    $swiftTransport =  new \Swift_SmtpTransport( 'smtp.gmail.com', '587', 'tls');
    //$swiftTransport->setUsername(\Config::get('mail.username')); //adresse email
    //$swiftTransport->setPassword(\Config::get('mail.password')); // mot de passe email

    $swiftTransport->setUsername('prestataire222@gmail.com'); //adresse email
    $swiftTransport->setPassword('123prestataire'); // mot de passe email eSolutions2020*

        $swiftMailer = new Swift_Mailer($swiftTransport);
    Mail::setSwiftMailer($swiftMailer);
    $from=\Config::get('mail.from.address') ;
    $fromname=\Config::get('mail.from.name') ;
    
    Mail::send([], [], function ($message) use ($to,$sujet, $contenu,$from,$fromname   ) {
         $message
                 ->to($to)
                    ->subject($sujet)
                       ->setBody($contenu, 'text/html')
                    ->setFrom([$from => $fromname]);         

      });
    
  }


	

 }

