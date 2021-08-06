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
    protected function redirectTo()
    {
       
        if(auth()->user()->user_type=='prestataire')
         {
          
            $nbprest=User::where('user_type','prestataire')->count();

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
    protected function create(array $data)
    {
        //dd($data);

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
       if(isset($data['username']))
        {
         if( $data['username'])
         {
            $username=$data['username'];
         } else
           {
            $username = $data['name'];
           }
         
       } else
       {
        $username = $data['name'];
       }

       // nom entreprise creation
       if(isset($data['titre']))
        {
         if( $data['titre'])
         {
            $titre=$data['titre'];
         } else
           {
            $titre = "titre de prestataire";
           }
         
       } else
       {
        $titre = "titre de prestataire";
       }

       // siren/siret entreprise creation
       if(isset($data['siren']))
        {
         if( $data['siren'])
         {
            $siren=$data['siren'];
         } else
           {
            $siren = "";
           }
         
       } else
       {
        $siren = "";
       }

       // adresse entreprise creation
       if(isset($data['adresse']))
        {
         if( $data['adresse'])
         {
            $adresse=$data['adresse'];
         } else
           {
            $adresse = "";
           }
         
       } else
       {
        $adresse = "";
       }
     // codepostal entreprise creation
       if(isset($data['codep']))
        {
         if( $data['codep'])
         {
            $codep=$data['codep'];
         } else
           {
            $codep = "";
           }
         
       } else
       {
        $codep = "";
       }

       // ville entreprise creation
       if(isset($data['ville']))
        {
         if( $data['ville'])
         {
            $ville=$data['ville'];
         } else
           {
            $ville = "";
           }
         
       } else
       {
        $ville = "";
       }
       // fhoraire entreprise creation
       if(isset($data['fhoraire']))
        {
         if( $data['fhoraire'])
         {
            $fhoraire=$data['fhoraire'];
         } else
           {
            $fhoraire = "America/Martinique";
           }
         
       } else
       {
        $fhoraire = "America/Martinique";
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

          /*if($data['user_type']=='prestataire')
         {

          
            $nbprest=User::where('user_type','prestataire')->count();

            if( $nbprest > 100)
            {
              dd("ok1");
              $redirectTo='/abonnements';
            }
            else
            {
              dd("ok2");
              $redirectTo='/offrelancement';

            }

        
        }*/

      
      // dd($typeabonn);
        $format = "Y-m-d H:i:s";
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
        ]);
        
        

         //'type_abonn_essai' =>  $typeabonn,
        
       

        



    }
}
