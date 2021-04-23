<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyPaypalController extends Controller
{
    //-------------------------------------------payAcompteReservation---------------------------------------------
    public function payAcompteReservation(Request $request)
    {
        $montant=$request->get('montant');
        $desc=$request->get('description');
        $reservation=$request->get('reservation');
        $prestId=$request->get('prest');
        dd($prestId);
    }

//----------------------------------------------end---------------------------------------------
}
