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
use \App\Reservation;
use DateTime;

class CalendrierController extends Controller
{

  // composant pour desactivation datetimepicker
  public static $tab_jours_fermeture_semaine=array();
  public static $tab_heures_fermeture_semaine=array();
  public static $tab_heures_indisp_rendezvous=array();
  public static $tab_jours_indisp_rendezvous=array();
  public static $tab_minutes_indisp_rendezvous=array();

  //


   /*  public function __construct()
    {
        $this->middleware('auth');
    }
*/
  public static function get_tab_jours_fermeture_semaine($id)
  {
      self::calcul_jours_heures_fermeture_datetimepicker($id);
      return json_encode(self::$tab_jours_fermeture_semaine);
  }

  public static function get_tab_heures_fermeture_semaine($id)
  {
    self::calcul_jours_heures_fermeture_datetimepicker($id);
    return json_encode(self::$tab_heures_fermeture_semaine);
  }

   public static function get_tab_heures_indisp_rendezvous($id)
  {
    self::indisponibilte_rendezvous_horaire($id);
    return json_encode(self::$tab_heures_indisp_rendezvous);
  }
   public static function get_tab_jours_indisp_rendezvous($id)
  {
  
   self::indisponibilte_rendezvous_horaire($id);
   return json_encode(self::$tab_jours_indisp_rendezvous);
  }

  public static function get_tab_minutes_indisp_rendezvous($id)
  {  
   self::indisponibilte_rendezvous_horaire($id);
   return json_encode(self::$tab_minutes_fermeture_semaine);
  }


   public static function test()
  {
    $id=5;
     $idservicessimples=Service::where('recurrent','like','off')->pluck('id')->toArray();

     for($i=0;$i<count($idservicessimples);$i++)
     {
       $idservicessimples[$i]=strval($idservicessimples[$i]);

     }
  /* $servicessimples=Reservation::where('prestataire',$id)->whereIn('services_reserves',$idservicessimples)
   ->where('statut',1)->get();*/
   $servicessimples=Reservation::where('prestataire',$id)->when($idservicessimples , function($query) use ($idservicessimples) {
    $query->where(function ($query) use ($idservicessimples) {
        foreach($idservicessimples as $position) {
            $query->orWhereJsonContains('services_reserves',$position);
        }
    });
     })->get();

   foreach ( $servicessimples as $ss ) {
    $debut=$ss->date_reservation;
     foreach ($ss->services_reserves as $sr) {
       $ser=Service::where('id',$sr)->first(["duree"]);
       $pos1 = stripos($ser->duree,":");
       $pos2 = strripos($ser->duree,":");
        // bcd
       $hour=substr($ser->duree, 0, 2);
       $minutes=substr($ser->duree,3,2);
      //date('Y-m-d H:i',strtotime('+1 hour +20 minutes',strtotime($start)));
       dd($hour.' '.$minutes);
     }
     }

   //dd( $servicessimples);
  
  }


  public static function indisponibilte_rendezvous_horaire($id)
  {
  
    $user_indisp=Indisponibilite::where('prest_id',$id)->get(['titre', 'date_debut','date_fin' ]);
    $res=array();
   foreach ($user_indisp as $ui) {
    $debut=$ui->date_debut;
    $fin=$ui->date_fin;
    if( $debut &&  $fin )
    {
   str_replace(" ","T",$debut); 
   str_replace(" ","T",$fin);     
   $res[]=array('title'=>$ui->titre,'start'=>$debut, 'end'=> $fin, 'color' => 'red');

   // calcul  heures et/ou jours indisponiblité pour datetimepicker
   
   $de=$ui->date_debut;
   $fe=$ui->date_fin;

   $datetime1 = new DateTime($debut); // Date dans le passé
   $datetime2 = new DateTime($fin); 
   //calcul de differnece en jours
   $val1=intval($datetime1->format('d'));
   $val2=intval($datetime2->format('d'));
   $month1=intval($datetime1->format('n'));
   $month2=intval($datetime2->format('n'));
  
   $jma1=$datetime1->format('Y-m-d');
   $jma2=$datetime2->format('Y-m-d');
   $intervaldays = $datetime1->diff($datetime2);
   $intervaldays = intval($intervaldays->format('%R%a days'));

   $minutestab=['5','10','15','20','25','30','35','40','45','50','55'];
   // dd($intervaldays);
   if($datetime2>$datetime1)
   {
    // dans le meme mois 
  if($month1==$month2)
   {
    //dd($month1.' '.$month2);
   if($val1 != $val2)
   {
      if(abs($val2-$val1)==1)
      {
         if($val2>$val1)
         {
          $hdeb=intval($datetime1->format('G'));
          $hfin=intval($datetime2->format('G'));
          $mhdeb=intval($datetime1->format('i'));
          $mhfin=intval($datetime2->format('i'));
          //dd($hdeb.' '.$hfin);
          $count1=$hdeb;
          while($count1<24)
          {
             if(!in_array($jma1.":".$count1, self::$tab_heures_indisp_rendezvous))
                {
                 array_push(self::$tab_heures_indisp_rendezvous, $jma1.":".$count1);
                }
            
            $count1++;
           /* if($count1==$hdeb && (($mhdeb >5 && $mhfin < 55)|| ($mhdeb <5 && $mhfin < 50)||($mhdeb >10 && $mhfin > 50)))
            {
              $min=100;
              $posmin=0;
              for($k=0;$k < count($minutestab); $k++)
              {

                if()
              


              }
                  
            }
            else
            {

               if(!in_array($jma1.":".$count1, self::$tab_heures_indisp_rendezvous))
                {
                 array_push(self::$tab_heures_indisp_rendezvous, $jma1.":".$count1);
                }
            }*/

          }
          $count2=0;
          while($count2<=$hfin)
          {
            if(!in_array($jma2.":".$count2, self::$tab_heures_indisp_rendezvous))
            {
            array_push(self::$tab_heures_indisp_rendezvous, $jma2.":".$count2);
            }
            $count2++;
          }

         }

      }
      else
      {
         if(abs($val2-$val1)>1)
         {

            if($val2>$val1)
             {
              //$countday=date('Y-m-d',strtotime('+1 day ',strtotime($jma1)));
              $hdeb=intval($datetime1->format('G'));
              $hfin=intval($datetime2->format('G'));
              //dd($hdeb.' '.$hfin);
              $count1=$hdeb;
              while($count1<24)
              {
               if(!in_array($jma1.":".$count1, self::$tab_heures_indisp_rendezvous))
                {
                array_push(self::$tab_heures_indisp_rendezvous, $jma1.":".$count1);
                }
                $count1++;
              }
              //les jours
              $k=0;
             $countday=$jma1;
             while($k<($intervaldays-1) )
             {
              // dd("ok");
               $countday=date('Y-m-d',strtotime('+1 day ',strtotime($countday)));  
               if(!in_array($countday, self::$tab_jours_indisp_rendezvous))
               {
                array_push(self::$tab_jours_indisp_rendezvous,$countday);
               }          
                  
               $k++;
             }

              // fin les jours
               $count2=0;
              while($count2<=$hfin)
              {
                if(!in_array($jma2.":".$count2, self::$tab_heures_indisp_rendezvous))
                 {
                array_push(self::$tab_heures_indisp_rendezvous, $jma2.":".$count2);
                 }
                $count2++;
              }

             }


         }

      }

   }
   else// lorsque le meme jour same month
   {
      $hdeb=intval($datetime1->format('G'));
      $hfin=intval($datetime2->format('G'));
      $count1=$hdeb;
              while($count1<= $hfin)
              {
               if(!in_array($jma1.":".$count1, self::$tab_heures_indisp_rendezvous))
                {
                array_push(self::$tab_heures_indisp_rendezvous, $jma1.":".$count1);
                }
                $count1++;
              }

   }
  }
  else // month1 <> month2
  {
    //dd($jma2);
    //$countday=date('Y-m-d',strtotime('+1 day ',strtotime($jma1)));
             //$countday=date('Y-m-d',strtotime('+1 day ',strtotime($jma1)));
              $hdeb=intval($datetime1->format('G'));
              $hfin=intval($datetime2->format('G'));
              //dd($hdeb.' '.$hfin);
              $count1=$hdeb;
              while($count1<24)
              {
               if(!in_array($jma1.":".$count1, self::$tab_heures_indisp_rendezvous))
                {
                array_push(self::$tab_heures_indisp_rendezvous, $jma1.":".$count1);
                }
                $count1++;
              }
              //les jours
              $k=0;
             $countday=$jma1;
             while($k<($intervaldays-1) )
             {
              // dd("ok");
               $countday=date('Y-m-d',strtotime('+1 day ',strtotime($countday)));  
               if(!in_array($countday, self::$tab_jours_indisp_rendezvous))
               {
                array_push(self::$tab_jours_indisp_rendezvous,$countday);
               }          
                  
               $k++;
             }

              // fin les jours
               $count2=0;
              while($count2<=$hfin)
              {
                if(!in_array($jma2.":".$count2, self::$tab_heures_indisp_rendezvous))
                 {
                array_push(self::$tab_heures_indisp_rendezvous, $jma2.":".$count2);
                 }
                $count2++;
              }

  }
  }// if($datetime2>$datetime1)
   //calcul 
     }// if( $debut &&  $fin )
   }//foreach ($user_indisp as $ui)

   // calculate the start and the end of simple service réservation

   $idservicessimples=Service::where('recurrent','like','off')->where("NbrService",1)->pluck('id')->toArray();
   for($i=0;$i<count($idservicessimples);$i++)
     {
       $idservicessimples[$i]=strval($idservicessimples[$i]);

     }
   /*$servicessimples=Reservation::where('prestataire',$id)->whereIn('services_reserves',$idservicessimples)
   ->where('statut',1)->get();*/
    $servicessimples=Reservation::where('prestataire',$id)->whereNotNull('services_reserves')->where('statut',1)->when($idservicessimples , function($query) use ($idservicessimples) {
    $query->where(function ($query) use ($idservicessimples) {
        foreach($idservicessimples as $position) {
            $query->orWhereJsonContains('services_reserves',$position);
        }
    });
     })->get();
   //dd(array_values($idservicessimples));
    //$debut=$ss->date_reservation;
    $datecourante=new DateTime();
   foreach ( $servicessimples as $ss ) {
    $debut=$ss->date_reservation;
     foreach ($ss->services_reserves as $sr) {
       $ser=Service::where('id',$sr)->first(["nom","duree","NbrService"]);
       //$pos1 = stripos($ser->duree,":");
      // $pos2 = strripos($ser->duree,":");
      $nbResvalide=Reservation::where('prestataire',$id)->whereNotNull('services_reserves')->whereNotNull('date_reservation')->where('date_reservation','>',$datecourante)->where('statut',1)->WhereJsonContains('services_reserves',$sr)->where('recurrent',1)->whereNull('id_recc')->count();

      $nbResvalide=intval($nbResvalide);
      $NbrService=intval($ser->NbrService);
      $hour=substr($ser->duree, 0, 2);
      $minutes=substr($ser->duree,3,2);
      $fin=date('Y-m-d H:i',strtotime('+'.$hour.' hours +'.$minutes.' minutes',strtotime($debut)));

      if($nbResvalide<$NbrService)
      {
      $res[]=array('title'=>$ser->nom.' (vous pouvez réserver le même service à cette date )','start'=>$debut, 'end'=> $fin, 'color' => 'grey');
      }
      else
      {
       $res[]=array('title'=>$ser->nom,'start'=>$debut, 'end'=> $fin, 'color' => 'black');

      }


       $datetimek=new DateTime($debut);
       $jma=$datetimek->format('Y-m-d');
       $debh=intval($datetimek->format('G'));
       $hour=intval($hour);
       $i=0;
      if($nbResvalide>=$NbrService)
      {
       while($i<$hour)
       {
         if(!in_array($jma.":".$debh, self::$tab_heures_indisp_rendezvous))
          {
          array_push(self::$tab_heures_indisp_rendezvous, $jma.":".$debh);
          }
          $debh++;
          $i++;
       }
      }
     //dd($debut.' '.$fin);
     }
     }
  // $idservicesreccurent=Service::where('recurrent','like','on')->pluck('id')->toArray();*/
    
       //dd($datecourante);
     $servicesreccurents=Reservation::where('prestataire',$id)->whereNotNull('services_reserves')->where('statut',0)->where('recurrent',1)->get();
    // dd($servicesreccurents);
     foreach ($servicesreccurents as $srec) {
         $u= $srec->services_reserves;
         $ser=Service::where('id',$u)->first(["nom","duree","NbrService"]);

         //$ser->$u;

      // dd($ser->NbrService);
      $nbResvalide=Reservation::where('prestataire',$id)->whereNotNull('services_reserves')->whereNotNull('date_reservation')->where('date_reservation','>',$datecourante)->where('statut',1)->WhereJsonContains('services_reserves',$u)->where('recurrent',1)->whereNull('id_recc')->count();

      $nbResvalide=intval($nbResvalide);
      $NbrService=intval($ser->NbrService);


      //dd($nbResvalide);

      $hour=substr($ser->duree, 0, 2);
      $minutes=substr($ser->duree,3,2);
      $fin=date('Y-m-d H:i',strtotime('+'.$hour.' hours +'.$minutes.' minutes',strtotime($debut)));
      
      if($nbResvalide<$NbrService)
      {
      $res[]=array('title'=>$ser->nom.' (vous pouvez réserver le même service à cette date )','start'=>$debut, 'end'=> $fin, 'color' => 'grey');
      }
      else
      {
       $res[]=array('title'=>$ser->nom,'start'=>$debut, 'end'=> $fin, 'color' => 'black');

      }

       $datetimek=new DateTime($debut);
       $jma=$datetimek->format('Y-m-d');
       $debh=intval($datetimek->format('G'));
       $hour=intval($hour);
       $i=0;
      if($nbResvalide>=$NbrService)
      {
       while($i<$hour)
       {
         if(!in_array($jma.":".$debh, self::$tab_heures_indisp_rendezvous))
          {
          array_push(self::$tab_heures_indisp_rendezvous, $jma.":".$debh);
          }
          $debh++;
          $i++;
       }
     }
     
     }


   //dd(array_values($idservicesreccurent));
  // dd($res);
   

   return json_encode($res);
    
  }

   public function calcul_nb_exploitation_service($idservice,$idreservation)
   {

        
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
     else
     {

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

  public static function calcul_jours_heures_fermeture_datetimepicker($id)
  {
     //public $tab_jours_fermeture_semaine=array();
  //public $tab_heures_indisp=array();
  //public $tab_jours_indisp=array();
    self::$tab_heures_fermeture_semaine=array();

    $usr_fer_ouv=User::where('id',$id)->first(['lundi_o',  'lundi_f',  'mardi_o',  'mardi_f',  'mercredi_o', 'mercredi_f', 'jeudi_o' , 'jeudi_f' , 'vendredi_o' ,  'vendredi_f' ,  'samedi_o' ,  'samedi_f' ,'dimanche_o' ,  'dimanche_f']);
    // $i=0;
       
     //$res=array();
     if($usr_fer_ouv->lundi_o && $usr_fer_ouv->lundi_f )
     {

      $datedeb = DateTime::createFromFormat('H:i', $usr_fer_ouv->lundi_o);
      $datefin = DateTime::createFromFormat('H:i', $usr_fer_ouv->lundi_f);

     //echo $date->format('Y-m-d');
      $hours1 = intval($datedeb->format('H')); 
      $hours2 = intval($datefin->format('H'));
      $minutes1 = intval($datedeb->format('i'));
      $minutes2 = intval($datefin->format('i'));
     
     // dd($minutes1);

     if($hours1>=23 && $hours1<1 && $hours2>11 && $hours2<12 ) 
      {
        if(!in_array(1, self::$tab_jours_fermeture_semaine))
          array_push(self::$tab_jours_fermeture_semaine, 1);
      }
      else
      {

        if( $hours1>=1 && $hours2<=23 )
        {
          $i=0;
           while($i<=$hours1)
           {
            array_push(self::$tab_heures_fermeture_semaine, "1:".$i."");
             $i++;
           }
           $i=$hours2;
           while($i<23)
           {
             array_push(self::$tab_heures_fermeture_semaine, "1:".$i."");
             $i++;
           }
        }

      }

      //dd(self::$tab_heures_fermeture_semaine);
      //dd($hours1);
       
     }
     else
     {
      if(!in_array(1, self::$tab_jours_fermeture_semaine))
      array_push(self::$tab_jours_fermeture_semaine, 1);
     }


    if($usr_fer_ouv->mardi_o && $usr_fer_ouv->mardi_f )
     {
          $datedeb = DateTime::createFromFormat('H:i', $usr_fer_ouv->mardi_o);
      $datefin = DateTime::createFromFormat('H:i', $usr_fer_ouv->mardi_f);

     //echo $date->format('Y-m-d');
      $hours1 = intval($datedeb->format('H')); 
      $hours2 = intval($datefin->format('H'));
      $minutes1 = intval($datedeb->format('i'));
      $minutes2 = intval($datefin->format('i'));
     
     // dd($minutes1);

     if($hours1>=23 && $hours1<1 && $hours2>11 && $hours2<12 ) 
      {
        if(!in_array(2, self::$tab_jours_fermeture_semaine))
          array_push(self::$tab_jours_fermeture_semaine, 2);
      }
      else
      {

        if( $hours1>=1 && $hours2<=23 )
        {
          $i=0;
           while($i<=$hours1)
           {
            array_push(self::$tab_heures_fermeture_semaine, "2:".$i."");
             $i++;
           }
           $i=$hours2;
           while($i<23)
           {
             array_push(self::$tab_heures_fermeture_semaine, "2:".$i."");
             $i++;
           }
        }

      }

      //dd(self::$tab_heures_fermeture_semaine);
      //dd($hours1);
     }
     else
     {
      if(!in_array(2, self::$tab_jours_fermeture_semaine))
      array_push(self::$tab_jours_fermeture_semaine, 2);
     }


     if($usr_fer_ouv->mercredi_o && $usr_fer_ouv->mercredi_f )
     {
      $datedeb = DateTime::createFromFormat('H:i', $usr_fer_ouv->mercredi_o);
      $datefin = DateTime::createFromFormat('H:i', $usr_fer_ouv->mercredi_f);

     //echo $date->format('Y-m-d');
      $hours1 = intval($datedeb->format('H')); 
      $hours2 = intval($datefin->format('H'));
      $minutes1 = intval($datedeb->format('i'));
      $minutes2 = intval($datefin->format('i'));
     
     // dd($minutes1);

     if($hours1>=23 && $hours1<1 && $hours2>11 && $hours2<12 ) 
      {
        if(!in_array(3, self::$tab_jours_fermeture_semaine))
          array_push(self::$tab_jours_fermeture_semaine, 3);
      }
      else
      {

        if( $hours1>=1 && $hours2<=23 )
        {
          $i=0;
           while($i<=$hours1)
           {
            array_push(self::$tab_heures_fermeture_semaine, "3:".$i."");
             $i++;
           }
           $i=$hours2;
           while($i<23)
           {
             array_push(self::$tab_heures_fermeture_semaine, "3:".$i."");
             $i++;
           }
        }

      }

      //dd(self::$tab_heures_fermeture_semaine);
      //dd($hours1);
      }
      else
     {
      if(!in_array(3, self::$tab_jours_fermeture_semaine))
      array_push(self::$tab_jours_fermeture_semaine, 3);
     }

    if($usr_fer_ouv->jeudi_o && $usr_fer_ouv->jeudi_f )
     {
        $datedeb = DateTime::createFromFormat('H:i', $usr_fer_ouv->jeudi_o);
      $datefin = DateTime::createFromFormat('H:i', $usr_fer_ouv->jeudi_f);

     //echo $date->format('Y-m-d');
      $hours1 = intval($datedeb->format('H')); 
      $hours2 = intval($datefin->format('H'));
      $minutes1 = intval($datedeb->format('i'));
      $minutes2 = intval($datefin->format('i'));
     
     // dd($minutes1);

     if($hours1>=23 && $hours1<1 && $hours2>11 && $hours2<12 ) 
      {
        if(!in_array(4, self::$tab_jours_fermeture_semaine))
          array_push(self::$tab_jours_fermeture_semaine, 4);
      }
      else
      {

        if( $hours1>=1 && $hours2<=23 )
        {
          $i=0;
           while($i<=$hours1)
           {
            array_push(self::$tab_heures_fermeture_semaine, "4:".$i."");
             $i++;
           }
           $i=$hours2;
           while($i<23)
           {
             array_push(self::$tab_heures_fermeture_semaine, "4:".$i."");
             $i++;
           }
        }

      }

      //dd(self::$tab_heures_fermeture_semaine);
      //dd($hours1);
     }
     else
     {
      if(!in_array(4, self::$tab_jours_fermeture_semaine))
      array_push(self::$tab_jours_fermeture_semaine, 4);
     }

     if($usr_fer_ouv->vendredi_o && $usr_fer_ouv->vendredi_f )
     {
        $datedeb = DateTime::createFromFormat('H:i', $usr_fer_ouv->vendredi_o);
      $datefin = DateTime::createFromFormat('H:i', $usr_fer_ouv->vendredi_f);

     //echo $date->format('Y-m-d');
      $hours1 = intval($datedeb->format('H')); 
      $hours2 = intval($datefin->format('H'));
      $minutes1 = intval($datedeb->format('i'));
      $minutes2 = intval($datefin->format('i'));
     
     // dd($minutes1);

     if($hours1>=23 && $hours1<1 && $hours2>11 && $hours2<12 ) 
      {
        if(!in_array(5, self::$tab_jours_fermeture_semaine))
          array_push(self::$tab_jours_fermeture_semaine, 5);
      }
      else
      {

        if( $hours1>=1 && $hours2<=23 )
        {
          $i=0;
           while($i<=$hours1)
           {
            array_push(self::$tab_heures_fermeture_semaine, "5:".$i."");
             $i++;
           }
           $i=$hours2;
           while($i<23)
           {
             array_push(self::$tab_heures_fermeture_semaine, "5:".$i."");
             $i++;
           }
        }

      }

      //dd(self::$tab_heures_fermeture_semaine);
      //dd($hours1);
     }
     else
     {
      if(!in_array(5, self::$tab_jours_fermeture_semaine))
      array_push(self::$tab_jours_fermeture_semaine, 5);
     }

     if($usr_fer_ouv->samedi_o && $usr_fer_ouv->samedi_f )
     {
     $datedeb = DateTime::createFromFormat('H:i', $usr_fer_ouv->samedi_o);
      $datefin = DateTime::createFromFormat('H:i', $usr_fer_ouv->samedi_f);

     //echo $date->format('Y-m-d');
      $hours1 = intval($datedeb->format('H')); 
      $hours2 = intval($datefin->format('H'));
      $minutes1 = intval($datedeb->format('i'));
      $minutes2 = intval($datefin->format('i'));
     
     // dd($minutes1);

     if($hours1>=23 && $hours1<1 && $hours2>11 && $hours2<12 ) 
      {
        if(!in_array(6, self::$tab_jours_fermeture_semaine))
          array_push(self::$tab_jours_fermeture_semaine, 6);
      }
      else
      {

        if( $hours1>=1 && $hours2<=23 )
        {
          $i=0;
           while($i<=$hours1)
           {
            array_push(self::$tab_heures_fermeture_semaine, "6:".$i."");
             $i++;
           }
           $i=$hours2;
           while($i<23)
           {
             array_push(self::$tab_heures_fermeture_semaine, "6:".$i."");
             $i++;
           }
        }

      }

      //dd(self::$tab_heures_fermeture_semaine);
      //dd($hours1);   
      }
     else
     {
      if(!in_array(6, self::$tab_jours_fermeture_semaine))
      array_push(self::$tab_jours_fermeture_semaine, 6);
     }

     if($usr_fer_ouv->dimanche_o && $usr_fer_ouv->dimanche_f )
     {
       $datedeb = DateTime::createFromFormat('H:i', $usr_fer_ouv->dimanche_o);
      $datefin = DateTime::createFromFormat('H:i', $usr_fer_ouv->dimanche_f);

     //echo $date->format('Y-m-d');
      $hours1 = intval($datedeb->format('H')); 
      $hours2 = intval($datefin->format('H'));
      $minutes1 = intval($datedeb->format('i'));
      $minutes2 = intval($datefin->format('i'));
     
     // dd($minutes1);

     if($hours1>=23 && $hours1<1 && $hours2>11 && $hours2<12 ) 
      {
        if(!in_array(0, self::$tab_jours_fermeture_semaine))
          array_push(self::$tab_jours_fermeture_semaine, 0);
      }
      else
      {

        if( $hours1>=1 && $hours2<=23 )
        {
          $i=0;
           while($i<=$hours1)
           {
            array_push(self::$tab_heures_fermeture_semaine, "0:".$i."");
             $i++;
           }
           $i=$hours2;
           while($i<23)
           {
             array_push(self::$tab_heures_fermeture_semaine, "0:".$i."");
             $i++;
           }
        }

      }

      //dd(self::$tab_heures_fermeture_semaine);
      //dd($hours1);
      }
     else
     {
      if(!in_array(0, self::$tab_jours_fermeture_semaine))
      array_push(self::$tab_jours_fermeture_semaine, 0);
     }

     // return json_encode(self::$tab_jours_fermeture_semaine);

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
