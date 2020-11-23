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
   

		
	public function add(Request $request)
	{
		
     if(  $request->get('client') !=   $request->get('prestataire')){
 		 $review  = new Review([
              'note' => $request->get('note'),
              'client' => $request->get('client'),
              'prestataire' => $request->get('prestataire'),
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
		
    return back();
		 

 	}
	
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
	return redirect (url('/listing/'.$user.'#reviews'));

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
