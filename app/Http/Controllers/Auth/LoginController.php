<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
     protected $redirectTo = '/dashboard';
     protected $username  ;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->findUsername();
    }
	
    protected function authenticated(Request $request )
    {
		$user = auth()->user();
        $iduser = $user->id;
        $type = $user->user_type;

         $format = "Y-m-d H:i:s";
        $date_15j = (new \DateTime())->format('Y-m-d H:i:s');
        $date_15j=\DateTime::createFromFormat($format, $date_15j);
        $date_inscription= $user->date_inscription;
        $date_inscription=\DateTime::createFromFormat($format, $date_inscription);
       
        $nbjours = $date_inscription->diff($date_15j);
        $nbjours =intval($nbjours->format('%R%a'));
        $date_exp='';
        if($user->expire)
        {
          $date_exp=\DateTime::createFromFormat($format,$user->expire);
        }

        if ($type == 'prestataire' ) {

            if(!$user->nature_abonn && $date_exp=='' ) // non abonné
            {
              // vers la page d'abonnemnt
              // calcul nombre de prestataire 
                $nbprest=User::where('user_type','prestataire')->whereNotNull('expire')->count();

                    if( $nbprest < 100)
                    {
                     return redirect ('/pricing');
                    }
                    else
                    {
                      return redirect ('/offrelancement');
                    }

            }
            else // abonné  offre_lance_ann1 ; offre_lance_ann2 ; normal    
            {
              if ($user->invoiceStripe == 0 ) {
                //dd("okfffffff");
                return redirect ('/Facture_Impayee');
                
              }else{
               
              if($user->expire &&  $date_exp >= $date_15j )
              {
                
                return redirect ('/dashboard');

              }
              

                if($user->nature_abonn=='offre_lance_ann1' && ($user->expire &&  $date_exp < $date_15j ) )
                {
                   //calcul si la periode a dépassé un an ou non

                    $format = "Y-m-d H:i:s";
                    $date_courante = (new \DateTime())->format('Y-m-d H:i:s');
                    $date_courante =\DateTime::createFromFormat($format, $date_courante);
                    $date_inscription= $user->date_inscription;
                    $date_inscription=\DateTime::createFromFormat($format, $date_inscription);
                    
                    $nbjours = $date_inscription->diff($date_courante);
                    $nbjours =intval($nbjours->format('%R%a'));

                    return redirect ('/choixpayement');

                     /*if($nbjours>365)
                      { 
                       
                        return redirect ('/offrelancement');
                      }*/

                    
                    //si oui on passe vers la payement de deuxième tranche 

                   //redirect vers offre de lancement
                }

                 return redirect ('/pricing');

            }}

             
        
        } else {// admin ou client
          //dd("client");
            return redirect('/dashboard');
        }
		
         /*$date_inscription=$date_inscription->format('Y-m-d');
        $date_15j=$date_15j->format('Y-m-d');*/
		/*if ($type == 'prestataire') {

        $format = "Y-m-d H:i:s";
        $date_15j = (new \DateTime())->format('Y-m-d H:i:s');
        $date_15j=\DateTime::createFromFormat($format, $date_15j);
        $date_inscription= $user->date_inscription;
        $date_inscription=\DateTime::createFromFormat($format, $date_inscription);
       
        $nbjours = $date_inscription->diff($date_15j);
        $nbjours =intval($nbjours->format('%R%a'));
        $date_exp='';
        if($user->expire)
        {
          $date_exp=\DateTime::createFromFormat($format,$user->expire);
        }
        
        if($nbjours<=15 && $user->expire=='')
        { // periode essai
              return view('users.periode_essai', compact('nbjours')); 
        }
        else
        {
      		if($user->expire=='' || ($user->expire &&  $date_exp < $date_15j  )){
				//return redirect('/pricing');
                User::where('id',$user)->update(array('type_abonn_essai' => null));
                if($user->expire &&  $date_exp < $date_15j)
                {
                   User::where('id',$user)->update(array('type_abonn' => null)); 
                }
                return view('users.payement_non_regle', compact('user'));
				}else{
				 return redirect('/dashboard');
				}
			 
		}	 
        } else {// admin ou client
            return redirect('/dashboard');
        }*/
		
	}
	 
	
    public function findUsername()
    {
        $login = request()->input('login');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        request()->merge([$fieldType => $login]);

        return $fieldType;
    }
	
	
	public function username()
    {
        $field = (filter_var(request()->email, FILTER_VALIDATE_EMAIL) || !request()->email) ? 'email' : 'username';
        request()->merge([$field => request()->email]);
        return $field;
    }
	
	 
	
}
