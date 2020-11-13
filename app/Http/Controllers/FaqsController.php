<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Session;
use \App\User;
use \App\Faq;

class FaqsController extends Controller
{


 
	
  

		
	public function add(Request $request)
	{
		$user=$request->get('user');
		 $faq  = new Faq([
              'user' => $request->get('user'),
              'question' => $request->get('question'),
              'reponse' => $request->get('reponse'),
            ]);
 
        $faq->save();
    return $faq->id;
		 

 	}
	
	public function store(Request $request)
	{
		 $faq  = new Faq([
              'user' => $request->get('user'),
              'question' => $request->get('question'),
              'reponse' => $request->get('reponse'),
            ]);

        $faq->save();
 
 	}
  

    public function updating(Request $request)
    {
        $id= $request->get('user');
        $champ= strval($request->get('champ'));
        $val= strval($request->get('val'));
    
          Faq::where('id', $id)->update(array($champ => $val));

    }


	
     public function remove($id,$user)
    {
  
	 
	DB::table('faqs')->where('id', $id)->delete();
	return redirect (url('/listing/'.$user.'#faqs'));

	}
	
	
  
 }
