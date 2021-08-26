<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Session;
use \App\TemoinagePrest;

class TemoinagesPrestController extends Controller
{


 
	    public function __construct()
    {
        $this->middleware('auth');
    }


  public function store_temoinage (Request $request)
  {

     //dd($request->all());
     $tem  = new TemoinagePrest([
              
              'nom' => $request->get('nom'),
              'poste' => $request->get('poste'),
              'texte' => $request->get('texte'),
            ]);

        $tem->save();

         return redirect (url('/parametre/Temoinages'));
 
  

  }

    public function remove_temoinage($id)
  {

    DB::table('temoinages_prest')->where('id', $id)->delete();
    return redirect (url('/parametre/Temoinages'));


  }
	  public function update_temoinage(Request $request)
  {

        $id= $request->get('id');
        $champ= strval($request->get('champ'));
        $val= strval($request->get('val'));
       
    
         TemoinagePrest::where('id', $id)->update(array($champ => $val));
    

  }
  
 }
