<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use DB;
use File;
use Illuminate\Support\Facades\Auth;
use Session;
use \App\User;
use \App\Categorie;

class parametreController extends Controller
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
    public function abonnements()
    {

        $categories = Categorie::orderBy('nom', 'asc')->get();

        return view('parametre.abonnement', compact('categories'));


    }
    public function TemoinagesClient()
    {

        $categories = Categorie::orderBy('nom', 'asc')->get();

        return view('parametre.TemoinagesClient', compact('categories'));


    }
    public function TemoinagesPrestataire()
    {

        $categories = Categorie::orderBy('nom', 'asc')->get();

        return view('parametre.TemoinagesPrestataire', compact('categories'));


    }
    public function Apropos()
    {

        $categories = Categorie::orderBy('nom', 'asc')->get();

        return view('parametre.Apropos', compact('categories'));


    }
    public function Fonctionnalites()
    {

        $categories = Categorie::orderBy('nom', 'asc')->get();

        return view('parametre.BoxesDesFonctionnalites', compact('categories'));


    }

    public function LogoBanniere()
    {

        $categories = Categorie::orderBy('nom', 'asc')->get();

        return view('parametre.LogoBanniere', compact('categories'));


    }
    public function QuestionsReponses()
    {

        $categories = Categorie::orderBy('nom', 'asc')->get();

        return view('parametre.QuestionsReponses', compact('categories'));


    }
    public function Temoinages()
    {

        $categories = Categorie::orderBy('nom', 'asc')->get();

        return view('parametre.Temoinages', compact('categories'));


    }

  
 
	
	
  
 }
