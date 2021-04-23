<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Route;
use App\Invoice;
use App\IPNStatus;
use App\Item;
use App\User;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Srmklive\PayPal\Services\AdaptivePayments;
use Srmklive\PayPal\Services\ExpressCheckout;

class MyPaypalController extends Controller
{
	protected $provider;
    //-------------------------------------------payAcompteReservation---------------------------------------------
    public function payAcompteReservation(Request $request)
    {
        $montant=$request->get('montant');
        $desc=$request->get('description');
        $reservation=$request->get('reservation');
        $prestId=$request->get('prest');
        $email=User::where('id',$prestId)->value('emailPaypal');
        $abonnement=User::where('id',$prestId)->value('abonnement');
        if ($abonnement==3) {
            $k=60 ;
        }elseif ($abonnement==2) {
            $k=50 ;
        }elseif ($abonnement==1) {
            $k=30 ;
        }
        $acompte=($montant*$k)/100 ;
        $this->provider = new AdaptivePayments('AdaptivePay');

        $data = [
            'receivers'  => [
                [
                    'email'   => $email,
                    'amount'  => $acompte,
                    
                ],
              
            ],
            'payer'      => 'EACHRECEIVER', // (Optional) Describes who pays PayPal fees. Allowed values are: 'SENDER', 'PRIMARYRECEIVER', 'EACHRECEIVER' (Default), 'SECONDARYONLY'
            'return_url' => url('/successPayAcompteReservation'),
            'cancel_url' => url('payment/cancel'),
        ];

        $response = $this->provider->createPayRequest($data);
        dd($response);
$redirect_url = $this->provider->getRedirectUrl('approved', $response['payKey']);

return redirect($redirect_url);
    }

//----------------------------------------------end---------------------------------------------
}
