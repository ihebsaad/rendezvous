<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


use DB;
use QrCode;
use URL;
use Session;
use redirect;
use Auth;


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

    //use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';
    protected function redirectTo()
    {
       
        if(auth()->user()->user_type=='prestataire')
         {
          
            $nbprest=User::where('user_type','prestataire')->whereNotNull('expire')->count();

            if( $nbprest > 100)
            {
             
             return '/pricing';
            }
            else
            {
             
             return '/offrelancement';

            }
        
        }
    }

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
        //dd($data);
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
    protected function create(Request $req)
    {
        //dd($req->all());

        //\QrCode::size(200)->format('png')->generate('webnersolutions.com', public_path('qrcode1.png'));
        
       /* $typeabonn="type1";
        if(isset($data['typeabonn']))
        {
         if( $data['typeabonn'])
         {
         $typeabonn=$data['typeabonn'];
         }
         
       } */

       // username creation

       if($req->get('user_type')=='prestataire')
       {
     
         if( $req->get('username'))
         {
            $username=$req->get('username');
         } else
           {
            $username = $req->get('name');
           }
         
     

       // nom entreprise creation
       
         if( $req->get('titre'))
         {
            $titre=$req->get('titre');
         } else
           {
            $titre = "titre de prestataire";
           }
         
      

       // siren/siret entreprise creation
     
         if( $req->get('siren'))
         {
            $siren=$req->get('siren');
         } else
           {
            $siren = "";
           }
         
      
       // adresse entreprise creation
       
         if( $req->get('adresse'))
         {
            $adresse=$req->get('adresse');
         } else
           {
            $adresse = "";
           }
         
       
     // codepostal entreprise creation
      
         if( $req->get('codep'))
         {
            $codep=$req->get('codep');
         } else
           {
            $codep = "";
           }
         
      
       // ville entreprise creation
      
         if($req->get('ville'))
         {
            $ville=$req->get('ville');
         } else
           {
            $ville = "";
           }
         
       // fhoraire entreprise creation
      
         if( $req->get('fhoraire'))
         {
            $fhoraire=$req->get('fhoraire');
         } else
           {
            $fhoraire = "America/Martinique";
           }
         
      
       //gestion qr code 
       //get last id 
       $urlqrcode="";
       $chaine='';
       $baseurl='';
       if($req->get('user_type')=='prestataire')
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
           $format = "Y-m-d H:i:s";
        $date_inscription = (new \DateTime())->format('Y-m-d H:i:s');

        Session::put('username', $username);
        Session::put('name' , $req->get('name'));
        Session::put('lastname', $req->get('lastname'));
        Session::put('phone', $req->get('phone'));
        Session::put('email',$req->get('email'));
        Session::put('titre', $titre);
        Session::put('siren', $siren);
        Session::put( 'adresse' , $adresse);
        Session::put('ville' , $ville);
        Session::put('codep', $codep);
        Session::put('fhoraire', $fhoraire);
        Session::put('date_inscription', $date_inscription);
        Session::put('qr_code', $urlqrcode);
        Session::put('user_type', $req->get('user_type'));
        Session::put('password' , Hash::make($req->get('password')));

         if($req->get('user_type')=='prestataire')
         {
          
            $nbprest=User::where('user_type','prestataire')->whereNotNull('expire')->count();

            if( $nbprest > 100)
            {
             return redirect ('/pricing');
            }
            else
            {
             return redirect ('/offrelancement');
            }
        
        }

         } 
           else // inscripion client
           {

            $format = "Y-m-d H:i:s";
             $date_inscription = (new \DateTime())->format('Y-m-d H:i:s');


            $client= User::create([
            'username' => $req->get('username'),
            'name' => $req->get('name'),
            'lastname' => $req->get('lastname'),
            'phone' => $req->get('phone'),
            'email' => $req->get('email'),
            
            'date_inscription' => $date_inscription,
           
            'user_type' => $req->get('user_type'),
            'password' => Hash::make($req->get('password')),
           ]);
            Auth::login($client);


             return redirect ('/dashboard');

           }
      
      // dd($typeabonn);
       /* $format = "Y-m-d H:i:s";
        $date_inscription = (new \DateTime())->format('Y-m-d H:i:s');
        return User::create([
            'username' => $username,
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'titre' => $titre,
            'siren' => $siren,
            'adresse' => $adresse,
            'ville' => $ville,
            'codep' => $codep,
            'fhoraire' => $fhoraire,
            'date_inscription' => $date_inscription,
           
            'qr_code'=> $urlqrcode,
            'user_type' => $data['user_type'],
            'password' => Hash::make($data['password']),
        ]);*/
        
        

         //'type_abonn_essai' =>  $typeabonn,
        
       

        



    }
}
