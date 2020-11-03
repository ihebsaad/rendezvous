<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Session;

class UsersController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

	
    public function index()
    {
      
	  return view('users.index',[ ] );       

	}
 

     public function profile()
    {
      
	  return view('users.profile',[ ] );       

	}
	
	public function listing()
    {
      
	  return view('users.listing',[ ] );       

	}
  
 }
