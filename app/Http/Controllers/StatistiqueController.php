<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Session;
use \App\User;
use \App\Categorie;
use App\Charts\UserChart;

 use DateTime;
class StatistiqueController extends Controller
{


  public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $today=date('l');
      if ($today=="Monday") {
        $r=1;
      }elseif ($today=="Tuesday") {
        $r=2;
      }elseif ($today=="Wednesday") {
        $r=3;
      }
      elseif ($today=="Thursday") {
        $r=4;
      }elseif ($today=="Friday") {
        $r=5;
      }elseif ($today=="Saturday") {
        $r=6;
      }elseif ($today=="Sunday") {
        $r=7;
      }
      //dd($today);
      if ($request->has('periode')){
        if ($request->get('periode')==7) {
          $today=date('Y-m-d');
          $debut = new DateTime();
          $debut = $debut->format('Y-m-d');
          $debut = date('Y-m-d', strtotime($today. ' - 7 days'));
          $fin=date('Y-m-d');
          //dd($debut);
        }elseif ($request->get('periode')==3) {
          $today=date('Y-m-d');
          $debut = new DateTime();
          $debut = $debut->format('Y-m-d');
          $debut = date('Y-m-d', strtotime($today. ' - 3 month'));
          $fin=date('Y-m-d');
        }elseif ($request->get('periode')==12) {
          $today=date('Y-m-d');
          $debut = new DateTime();
          $debut = $debut->format('Y-m-d');
          $debut = date('Y-m-d', strtotime($today. ' - 12 month'));
          $fin=date('Y-m-d');
        }else{
        
        $today=date('Y-m-d');
        $debut = new DateTime();
        $debut = $debut->format('Y-m-d');
        $debut = date('Y-m-d', strtotime($today. ' - 30 days'));
        $fin=date('Y-m-d');};
      }else {
        
        $today=date('Y-m-d');
        $debut = new DateTime();
        $debut = $debut->format('Y-m-d');
        $debut = date('Y-m-d', strtotime($today. ' - 30 days'));
        $fin=date('Y-m-d');
      };
      //dd($debut);
      $list = array();

        $cuser = auth()->user();
        $services = DB::select( DB::raw("SELECT id FROM services s WHERE s.user='+$cuser->id+'" ) );
        //dd(count($services));  $n=$services[$i]->id;
        $rqt = "";
        for ($i=0; $i < count($services)-1 ; $i++) { 
          $n = $services[$i]->id;
         
          $rqt .= "SELECT *
          FROM services A
          INNER JOIN (SELECT count(*) as total FROM reservations WHERE JSON_SEARCH(services_reserves, 'all', '$n') IS NOT NULL 
          AND created_at >= '$debut 00:00:00' 
          AND created_at <= '$fin 23:59:59') b ON A.id = $n
          UNION ";
          };
          //dd($rqt);
          $t = 0 ;
          if (count($services) != 0) {
            $t = $services[count($services)-1]->id;
          }
          $rqttop = $rqt;
          $rqttop .= "SELECT *
          FROM services A
          INNER JOIN (SELECT count(*) as total FROM reservations WHERE JSON_SEARCH(services_reserves, 'all', $t) IS NOT NULL 
          AND created_at >= '$debut 00:00:00' 
          AND created_at <= '$fin 23:59:59' ) b ON A.id = $t
          ORDER BY total DESC LIMIT 3";

          $topservices = DB::select( DB::raw($rqttop) );
          //dd($rqttop);
          $rqtbas = $rqt ;
          $rqtbas .= "SELECT *
          FROM services A
          INNER JOIN (SELECT count(*) as total FROM reservations WHERE JSON_SEARCH(services_reserves, 'all', $t) IS NOT NULL 
          AND created_at >= '$debut 00:00:00' 
          AND created_at <= '$fin 23:59:59' ) b ON A.id = $t
          ORDER BY total ASC LIMIT 3";
          $basservices = DB::select( DB::raw($rqtbas) );


          //------------------------------------------------------select products-----------------------------------------------------------

        $produits = DB::select( DB::raw("SELECT id FROM produits p WHERE p.user='+$cuser->id+'" ) );
        //dd(count($services));  $n=$services[$i]->id;
        $rqtp = "";
        for ($i=0; $i < count($produits)-1 ; $i++) { 
          $n = $produits[$i]->id;
         
          $rqtp .= "SELECT *
          FROM produits p
          INNER JOIN (SELECT sum(quantity) as total FROM client_products WHERE id_products = $n 
          AND created_at >= '$debut 00:00:00' 
          AND created_at <= '$fin 23:59:59') b ON p.id = $n
          UNION ";
          };
          //dd(count($produits));
          $t = 0 ;
          if (count($produits) != 0) {
            $t = $produits[count($produits)-1]->id;
          }
          
          $rqtptop = $rqtp;
          $rqtptop .= "SELECT *
          FROM produits p
          INNER JOIN (SELECT sum(quantity) as total FROM client_products WHERE id_products = $t 
          AND created_at >= '$debut 00:00:00' 
          AND created_at <= '$fin 23:59:59' ) b ON p.id = $t
          ORDER BY total DESC LIMIT 3";

          $topproduits = DB::select( DB::raw($rqtptop) );
          //dd($topproduit);
          $rqtpbas = $rqtp ;
          $rqtpbas .= "SELECT *
          FROM produits p
          INNER JOIN (SELECT sum(quantity) as total FROM client_products WHERE id_products = $t 
          AND created_at >= '$debut 00:00:00' 
          AND created_at <= '$fin 23:59:59' ) b ON p.id = $t
          ORDER BY total ASC LIMIT 3";
          $basproduits = DB::select( DB::raw($rqtpbas) );
          //dd($basproduits);




          //dd($basservices);
          $x=['January', 'February', 'March','April','may','June','July','August','September','October','November','December'];
          $y=[0, 0, 0,0,0,0,0,0,0,0,0,0];
          if ($request->has('periode')){
            if ($request->get('periode')==7) {
              $x=['j-7','j-6','j-5','j-4','j-3','j-2','j-1','Aujourd`hui'];
              $y=[0,0,0,0,0,0,0,0];
              for ($i=0; $i < 8 ; $i++) { 
                $date = new DateTime();
                $date = $date->format('Y-m-d');
                $rs=8-$i;
                $date = date('Y-m-d', strtotime($date. ' - '.$rs.' day'));
                
                $ca = DB::select( DB::raw("SELECT sum(Net) as ca FROM reservations r WHERE r.created_at >='$date 00:00:00' AND r.created_at <='$date 23:59:59' " ) );
               
                $y[$i]=$ca[0]->ca;
                
              }
             //dd($y);
              
            }elseif ($request->get('periode')==1) {
              $x=['Semaine-4','Semaine-3','Semaine-2','Semaine-1','Cette semaine'];
              $debut = new DateTime();
              $debut = $debut->format('Y-m-d');
              $rs=$r-1;
              $debut = date('Y-m-d', strtotime($today. ' - '.$rs.' days'));
              $fin=date('Y-m-d');
              $cacs = DB::select( DB::raw("SELECT sum(Net) as ca FROM reservations r WHERE r.created_at <='$fin 23:59:59' AND r.created_at  >='$debut 00:00:00'" ) );

              $y=[0,0,0,0,0];
              for ($i=0; $i < 4 ; $i++) { 
                $debut = new DateTime();
                $debut = $debut->format('Y-m-d');
                $rs=$r+4*7-7*$i;
                $debut = date('Y-m-d', strtotime($debut. ' - '.$rs.' day'));
                $fin = new DateTime();
                $fin = $fin->format('Y-m-d');
                $rs=$r+3*7-7*$i;
                $fin = date('Y-m-d', strtotime($fin. ' - '.$rs.' day'));
                //dd($fin);
                $ca = DB::select( DB::raw("SELECT sum(Net) as ca FROM reservations r WHERE r.created_at <='$fin 23:59:59' AND r.created_at  >='$debut 00:00:00'" ) );

                $y[$i]=$ca[0]->ca;
                
              }

              $y[4]=$cacs[0]->ca;
              //dd($y);
              

            }elseif ($request->get('periode')==3) {
              $x=['Semaine-12','Semaine-11','Semaine-10','Semaine-9','Semaine-8','Semaine-7','Semaine-6','Semaine-5','Semaine-4','Semaine-3','Semaine-2','Semaine-1','Cette semaine'];
              $debut = new DateTime();
              $debut = $debut->format('Y-m-d');
              $rs=$r-1;
              $debut = date('Y-m-d', strtotime($today. ' - '.$rs.' days'));
              $fin=date('Y-m-d');
              $cacs = DB::select( DB::raw("SELECT sum(Net) as ca FROM reservations r WHERE r.created_at <='$fin 23:59:59' AND r.created_at  >='$debut 00:00:00'" ) );

              $y=[0,0,0,0,0,0,0,0,0,0,0,0,0];
              for ($i=0; $i < 12 ; $i++) { 
                $debut = new DateTime();
                $debut = $debut->format('Y-m-d');
                $rs=$r+12*7-7*$i;
                $debut = date('Y-m-d', strtotime($debut. ' - '.$rs.' day'));
                $fin = new DateTime();
                $fin = $fin->format('Y-m-d');
                $rs=$r+11*7-7*$i;
                $fin = date('Y-m-d', strtotime($fin. ' - '.$rs.' day'));
                //dd($fin);
                $ca = DB::select( DB::raw("SELECT sum(Net) as ca FROM reservations r WHERE r.created_at <='$fin 23:59:59' AND r.created_at  >='$debut 00:00:00'" ) );

                $y[$i]=$ca[0]->ca;
                
              }

              $y[12]=$cacs[0]->ca;
            }else {
              $month = new DateTime();
              $year = new DateTime();
              $month = $month->format('m');
              $year = $year->format('Y');
              //dd($year);
              $x=['', '', '','','','','','','','','','',''];
              $y=[0,0,0,0,0,0,0,0,0,0,0,0,0];
              $z=['Janvier', 'Février', 'Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'];
              $p= (int)$month ;
              $t=$p-1;
              //dd($z[11]) ;
              for ($i=$t; $i <12 ; $i++) { 
                $x[$i-$t]=$z[$i];
              }
              for ($i=0; $i <$p ; $i++) { 
                $x[13-$p+$i]=$z[$i];
              }
              for ($i=0; $i <12 ; $i++) { 
                
              $date = new DateTime("".$month."/01/".$year."");
              $date = $date->format('Y-m-d');

              $rs= 12 - $i ;
              $debut = date('Y-m-d', strtotime($date. ' - '.$rs.' month'));
              $rs= 11 - $i;
              $fin = date('Y-m-d', strtotime($date. ' - '.$rs.' month'));
              $ca = DB::select( DB::raw("SELECT sum(Net) as ca FROM reservations r WHERE r.created_at <'$fin 23:59:59' AND r.created_at  >='$debut 00:00:00'" ) );
              $y[$i]=(float)($ca[0]->ca);
             
              
              }
              $ca = DB::select( DB::raw("SELECT sum(Net) as ca FROM reservations r WHERE r.created_at  >='$date 00:00:00'" ) );
              $y[12]=(float)($ca[0]->ca);
             // dd($ca[0]->ca);
              
          
            }

          }else {
            $x=['Semaine-4','Semaine-3','Semaine-2','Semaine-1','Cette semaine'];
              $debut = new DateTime();
              $debut = $debut->format('Y-m-d');
              $rs=$r-1;
              $debut = date('Y-m-d', strtotime($today. ' - '.$rs.' days'));
              $fin=date('Y-m-d');
              $cacs = DB::select( DB::raw("SELECT sum(Net) as ca FROM reservations r WHERE r.created_at <='$fin 23:59:59' AND r.created_at  >='$debut 00:00:00'" ) );

              $y=[0,0,0,0,0];
              for ($i=0; $i < 4 ; $i++) { 
                $debut = new DateTime();
                $debut = $debut->format('Y-m-d');
                $rs=$r+4*7-7*$i;
                $debut = date('Y-m-d', strtotime($debut. ' - '.$rs.' day'));
                $fin = new DateTime();
                $fin = $fin->format('Y-m-d');
                $rs=$r+3*7-7*$i;
                $fin = date('Y-m-d', strtotime($fin. ' - '.$rs.' day'));
                //dd($fin);
                $ca = DB::select( DB::raw("SELECT sum(Net) as ca FROM reservations r WHERE r.created_at <='$fin 23:59:59' AND r.created_at  >='$debut 00:00:00'" ) );

                $y[$i]=$ca[0]->ca;
                
              }

              $y[4]=$cacs[0]->ca;
          }





          $usersChart = new UserChart;
         $usersChart->labels($x);
         $usersChart->dataset('CA (€)', 'bar', $y)
            ->color("rgb(255,0,0)")

            ->backgroundcolor("rgb(255,0,0)");
        return view('statistiques', compact('topservices','basservices','basproduits','topproduits'), [ 'usersChart' => $usersChart ]);
          

        
        
      //dd($nbres);

    }

		
	
 
  
	
  
 }
