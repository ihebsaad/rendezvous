<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Session;
use \App\User;
use \App\Categorie;

class CategoriesController extends Controller
{


  public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = Categorie::orderBy('nom', 'asc')->get();

        return view('categories.index', compact('categories'));


    }

		
	public function insert(Request $request)
	{
 		
	$categorie = $request->get('categorie');
	$user = $request->get('user');
 
  	    DB::table('categories_user')->insert(
            ['categorie' => $categorie,
                'user' => $user ]);

 	}
 
  	public function add(Request $request)
	{
    $categorie  = new Categorie([
               'nom' => $request->get('nom'),
              'description' => $request->get('description'),
              'parent' => $request->get('parent'),
           ]);
 
        $categorie->save();
        $id_categorie = $categorie ->id ;
    if($request->file('image')!=null)
    {$image=$request->file('image');
     $filenamewithextension =  $image->getClientOriginalName();
    //get filename without extension
    $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
    //get file extension
    $extension = $request->file('image')->getClientOriginalExtension();
    //filename to store
    $filenametostore = $filename.'_'.time().'.'.$extension;
      $path = storage_path()."/categories/";
    
         $image->move($path,  $filenametostore );
         Categorie::where('id', $id_categorie)->update(array('image' => $filenametostore));
    }
   
 		 
    return back();
		//	return back();
    //  return redirect('/listing/'.$user)->with('success', ' ajouté  ');


 	}

    public function updating(Request $request)
    {
        $id= $request->get('user');
        $champ= strval($request->get('champ'));
        $val= strval($request->get('val'));
    
          Categorie::where('id', $id)->update(array($champ => $val));

    }


	
     public function remove($id)
    {
  
	 
	DB::table('categories')->where('id', $id)->delete();
	return back();

	}
	
		
     public function removecatuser(Request $request)
    {
	 $categorie = $request->get('categorie');
	 $user = $request->get('user');
	DB::table('categories_user')->where('categorie', $categorie)->where('user', $user)->delete();
	//return back();

	}
	
    public static function ChampById($champ,$id)
    {
        $cat = Categorie::find($id);
        if (isset($cat[$champ])) {
            return $cat[$champ] ;
        }else{return '';}

    }
	
  
 }
