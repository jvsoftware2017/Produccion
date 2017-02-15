<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	if (Auth::user()->status == 'inactive'){
    		Auth::logout();
    		$errors = ['email' => 'La cuenta del usuario está inactiva, por favor contacte al administrador.'];
    		return view('auth.login')->withErrors($errors);
    	}
    	
    	return view('home');
    }
}
