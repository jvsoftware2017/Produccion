<?php

namespace App\Http\Controllers;

use App\UserAccess;
use App\User;
use App\Plant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	if(Auth::user()->role->description == 'client'){
    		$dataUser = User::where('id_client', Auth::user()->id_client)->get();
    		$dataPlant = User::where('id_client', Auth::user()->id_client)->get();
    	}else{
    		$dataUser = User::all();
    		$dataPlant = Plant::all();
    	}
    	return view('usersAccess.usersAccess', compact('dataUser', 'dataPlant'));
    	
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\user_access  $user_access
     * @return \Illuminate\Http\Response
     */
    public function show(user_access $user_access)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\user_access  $user_access
     * @return \Illuminate\Http\Response
     */
    public function edit(user_access $user_access)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\user_access  $user_access
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user_access $user_access)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user_access  $user_access
     * @return \Illuminate\Http\Response
     */
    public function destroy(user_access $user_access)
    {
        //
    }
}
