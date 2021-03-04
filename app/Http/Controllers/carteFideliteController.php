<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use \App\Reservation;

use \App\Cartefidelite;
use DB;

class carteFideliteController extends Controller
{
    public function index()
    {

       $cuser = auth()->user();
 
        $carteF = DB::select( DB::raw("SELECT c.* ,u.titre,u.couverture ,u.reduction FROM cartefidelites c INNER JOIN users u on c.id_prest=u.id WHERE c.id_client='+$cuser->id+'" ) );
        //dd($carteF);
        return view('carteFidelite.index', compact('carteF'));


    }

}
