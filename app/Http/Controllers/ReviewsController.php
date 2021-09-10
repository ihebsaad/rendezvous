<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Session;
use \App\User;
use \App\Review;

class ReviewsController extends Controller
{

 
  public function __construct()
    {
        $this->middleware('auth');
    }

	
	
    public function index()
    {
		
		  $cuser = auth()->user();
 
        $reviews = Review::where('prestataire',$cuser->id)->get();

        return view('reviews.index', compact('reviews'));


    }
    public function bindex()
    {
		
		  $cuser = auth()->user();
 
        $reviews = Review::where('prestataire',$cuser->id)->get();

        return view('reviews.bindex', compact('reviews'));


    }
   

		
	public function add(Request $request)
	{
		//dd($request);
    $avis = Review::where('client',$request->get('client'))->where('prestataire',$request->get('prestataire'))->count();
    if ($avis) {
      \Session::put('ErrorMessage', 'oops!... vous avez déjà ajouté un avis');
      return back();
    } else {
    //dd($avis);
     if(  $request->get('client') !=   $request->get('prestataire')){
      //dd($request);
      $nbrenote = 0;
     	$lesnotes = 0;
     	if (!empty($request->get('note_qualite')))
     	{
     		$lesnotes = $lesnotes + $request->get('note_qualite');
     		$nbrenote = $nbrenote + 1;
     	}
     	if (!empty($request->get('note_service')))
     	{
     		$lesnotes = $lesnotes + $request->get('note_service');
     		$nbrenote = $nbrenote + 1;
     	}
     	if (!empty($request->get('note_prix')))
     	{
     		$lesnotes = $lesnotes + $request->get('note_prix');
     		$nbrenote = $nbrenote + 1;
     	}

     	if (!empty($request->get('note_emplacement')))
     	{
     		$lesnotes = $lesnotes + $request->get('note_emplacement');
     		$nbrenote = $nbrenote + 1;
     	}

     	if ($nbrenote > 0)
     	{ $note = $lesnotes / $nbrenote;  
     		$note = round($note, 1); }
     	else {$note = 0;} 

 		 $nreview  = new Review([
              'client' => $request->get('client'),
              'prestataire' => $request->get('prestataire'),
              'commentaire' => $request->get('commentaire'),
              'note' => $note, 
              'note_qualite' => $request->get('note_qualite'),
              'note_service' => $request->get('note_service'),
              'note_prix' => $request->get('note_prix'),
              'note_emplacement' => $request->get('note_emplacement')
              /*'note_espace' => $request->get('note_espace'),*/
            ]);
 
        $nreview->save();
		}
		
     return back();
		 
		//dd ($request);
 	}}
	
	public function store(Request $request)
	{
		 $review  = new Review([
              'note' => $request->get('note'),
              'user' => $request->get('user'),
              'commentaire' => $request->get('commentaire'),
              'note' => $request->get('note'),
              'note_qualite' => $request->get('note_qualite'),
              'note_service' => $request->get('note_service'),
              'note_prix' => $request->get('note_prix'),
              'note_emplacement' => $request->get('note_emplacement'),
              'note_espace' => $request->get('note_espace'),
            ]);
 

        $review->save();
 
 	}
  

    public function updating(Request $request)
    {
        $id= $request->get('user');
        $champ= strval($request->get('champ'));
        $val= strval($request->get('val'));
    
          Review::where('id', $id)->update(array($champ => $val));

    }


	
     public function remove($id,$user)
    {
  
	 
	DB::table('reviews')->where('id', $id)->delete();
	return back();

	}
	
	    public function addfavoris(Request $request)
    {
		$prestataire =  intval($request->get('prestataire'));
		$client =  intval($request->get('client'));
		
		$countf= DB::table('favoris')->where('prestataire',$prestataire)->where('client',$client)->count();
		if($countf==0){
	 DB::table('favoris')->insert(
            ['client' => $client,
                'prestataire' => $prestataire ]);
		return 0; }
		else{

		DB::table('favoris')
	 ->where('prestataire', $prestataire)
	 ->where('client', $client)->delete();
		return 1; 	
			
		}
	}
	
	  public function removefavoris(Request $request)
    {
		$prestataire =  $request->get('prestataire');
		$client =  $request->get('client');

	 DB::table('favoris')
	 ->where('prestataire', $prestataire)
	 ->where('client', $client)->delete();
	}
	
	
	
  
 }
