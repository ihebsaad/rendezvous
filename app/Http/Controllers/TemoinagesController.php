<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Session;
use \App\Temoinage;

class TemoinagesController extends Controller
{


 
	    public function __construct()
    {
        $this->middleware('auth');
    }


  public function store_temoinage (Request $request)
  {

     //dd($request->all());
     $tem  = new Temoinage([
              
              'nom' => $request->get('nom'),
              'poste' => $request->get('poste'),
              'texte' => $request->get('texte'),
            ]);

        $tem->save();

         return redirect (url('/parametres'));
 
  

  }

    public function remove_temoinage($id)
  {

    DB::table('temoinages')->where('id', $id)->delete();
    return redirect (url('/parametres'));


  }
	  public function update_temoinage(Request $request)
  {

        $id= $request->get('id');
        $champ= strval($request->get('champ'));
        $val= strval($request->get('val'));
       
    
         Temoinage::where('id', $id)->update(array($champ => $val));
    

  }
  
 }
