<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;

use DB;
use QrCode;
use URL;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'phone' => ['required', 'numeric'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {


        //\QrCode::size(200)->format('png')->generate('webnersolutions.com', public_path('qrcode1.png'));
        
        $typeabonn="type1";
        if(isset($data['typeabonn']))
        {
         if( $data['typeabonn'])
         {
         $typeabonn=$data['typeabonn'];
         }
         
       }
       //gestion qr code 
       //get last id 
       $urlqrcode="";
       $chaine='';
       $baseurl='';
       if($data['user_type']=='prestataire')
       {
        $lastid=User::orderBy('id','desc')->first(['id']);
        $lastid=intval($lastid->id);
        $lastid++; 

        $baseurl=URL::to('/');
        //dd($baseurl);
        $chaine='titre-de-prestataire-'.$lastid;
        //dd($chaine);
        $urlqrcode= $chaine.'.png';
        //dd($urlqrcode);
        QrCode::size(200)->format('png')->generate($baseurl.'/titre-de-prestataire/'.$lastid, storage_path().'/qrcodes/'.$urlqrcode);
        //dd(public_path());

       }
      
      // dd($typeabonn);
        $format = "Y-m-d H:i:s";
        $date_inscription = (new \DateTime())->format('Y-m-d H:i:s');
        return User::create([
            'username' => $data['username'],
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'date_inscription' => $date_inscription,
            'type_abonn_essai' =>  $typeabonn,
            'qr_code'=> $urlqrcode,
            'user_type' => $data['user_type'],
            'password' => Hash::make($data['password']),
        ]);


        



    }
}
