<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Session;
use \App\User;
use \App\Faq;
use \App\PageFaq;

class FaqsController extends Controller
{


 
	    public function __construct()
    {
        $this->middleware('auth');
    }

  

		
	public function add(Request $request)
	{
		$user=$request->get('user');
		 $faq  = new Faq([
              'user' => $request->get('user'),
              'question' => $request->get('question'),
              'reponse' => $request->get('reponse'),
            ]);
 
        $faq->save();
        Session::put('ttmessage', 'Ajouté avec succès');
    return back();
		 

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
	return back();

	}

  public function remove_question_response($id)
  {

    DB::table('page_faqs')->where('id', $id)->delete();
    return redirect (url('/parametre/QuestionsReponses'));


  }

  public function store_question_reponse (Request $request)
  {

     //dd($request->all());
     $faq  = new PageFaq([
              
              'question' => $request->get('question'),
              'reponse' => $request->get('reponse'),
              'type' => $request->get('type'),
            ]);

        $faq->save();

         return redirect (url('/parametre/QuestionsReponses'));
 
  

  }

  public function update_question_reponse(Request $request)
  {

        $id= $request->get('id');
        $champ= strval($request->get('champ'));
        $val= strval($request->get('val'));
        $type= strval($request->get('type'));
       
    
         PageFaq::where('id', $id)->update(array($champ => $val));
    

  }
	
	
  
 }
