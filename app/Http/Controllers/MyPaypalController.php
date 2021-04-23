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
use URL;
class MyPaypalController extends Controller
{
	protected $provider;
	//-------------------------------------------CheckEmail---------------------------------------------

  public function CheckEmail(Request $request)
    {
        $id=$request->get('id');
        $varEmail=$request->get('email'); 
        $this->provider = new AdaptivePayments('AdaptivePay');

        $data = [
            'receivers'  => [
                [
            'email' => $varEmail,
            'amount' => 1,
            
        ],
        
              
            ],
            'payer'      => 'EACHRECEIVER', // (Optional) Describes who pays PayPal fees. Allowed values are: 'SENDER', 'PRIMARYRECEIVER', 'EACHRECEIVER' (Default), 'SECONDARYONLY'
            'return_url' => url('payment/success'),
            'cancel_url' => url('payment/cancel'),
        ];

        $response = $this->provider->createPayRequest($data);
        
        //$response =0;
        //dd($response);
        if ($response['responseEnvelope']['ack'] == "Failure") {
            Session::put('msg', 'off');
            return  back();
         } 
         //dd($id);
        //dd($response);
        User::where('id', $id)->update(array('emailPaypal' => $varEmail ));
        Session::put('msg', 'on');

        return back();
      

        
    }   
//-----------------------------------------------end------------------------------------------------
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
          //  'return_url' => url('/successPayAcompteReservation'),
            'return_url' =>URL::route('successpay',['reservation'=>$reservation,$type=>'acompte']),
          //  'cancel_url' => url('payment/cancel'),
            'cancel_url' => URL::route('cancelpay',['reservation'=>$reservation]),
        ];

        $response = $this->provider->createPayRequest($data);
        //dd($response);
$redirect_url = $this->provider->getRedirectUrl('approved', $response['payKey']);

return redirect($redirect_url);
    }

//----------------------------------------------end---------------------------------------------



//-------------------------------------------successPay------------------------------------------
    public function successpay(Request $request)
    {
        dd($request);

return redirect('/');
    }
	
	
//-------------------------------------------	
  public function cancelpay(Request $request)
    {
        dd($request);

return redirect('/');
    }


//----------------------------------------------end---------------------------------------------

//-------------------------------------------AdaptivePay---------------------------------------------
    public function getAdaptivePay()
    {
        $this->provider = new AdaptivePayments('AdaptivePay');

        $data = [
            'receivers'  => [
                [
                    'email'   => 'saadiheb@gmail.com',
                    'amount'  => 150,
                    
                ],
              
            ],
            'payer'      => 'EACHRECEIVER', // (Optional) Describes who pays PayPal fees. Allowed values are: 'SENDER', 'PRIMARYRECEIVER', 'EACHRECEIVER' (Default), 'SECONDARYONLY'
            'return_url' => url('payment/success'),
            'cancel_url' => url('payment/cancel'),
        ];

        $response = $this->provider->createPayRequest($data);
        //dd($response);
$redirect_url = $this->provider->getRedirectUrl('approved', $response['payKey']);

return redirect($redirect_url);
    }

//----------------------------------------------end---------------------------------------------



//-------------------------------------------Preapproved---------------------------------------------
    public function getPreapproved()
    {
        $this->provider = new AdaptivePayments('preapproved');
        

        $data = [
            "maxAmountPerPayment"=> 45.00, 
            "maxNumberOfPayments"=> 20, 
            'maxTotalAmountOfAllPayments'=> 800.00,
            "endingDate" => "2022-02-02T20:40:52Z",
            "startingDate" => "2021-04-27T10:45:52Z",
            'return_url' => url('payment/success'),
            'cancel_url' => url('payment/cancel'),
        ];

        $response = $this->provider->createPayRequest($data);
        //dd($response);
$redirect_url = $this->provider->getRedirectUrl('pre-approved', $response['preapprovalKey']);

return redirect($redirect_url);
    }

//----------------------------------------------end----------------------------------------------------




//-------------------------------------------PreapprovedPay---------------------------------------------
    public function getPreapprovedPay()
    {
        $this->provider = new AdaptivePayments('preapproved-pay');

        $data = [
            'preapprovalKey'=>'PA-1BA57335FD044912K',
            'receivers'  => [
                [
                    'email'   => 'saadiheb@gmail.com',
                    'amount'  => 20,
                    
                ],
              
            ],
            'senderEmail'=>"mohamed.achraf.besbes@gmail.com",
            'payer'      => 'EACHRECEIVER', // (Optional) Describes who pays PayPal fees. Allowed values are: 'SENDER', 'PRIMARYRECEIVER', 'EACHRECEIVER' (Default), 'SECONDARYONLY'
            'return_url' => url('payment/success'),
            'cancel_url' => url('payment/cancel'),
        ];

        $response = $this->provider->createPayRequest($data);
        //dd($response);


    return $response;
       
    }
//-------------------------------------------end---------------------------------------------


}
