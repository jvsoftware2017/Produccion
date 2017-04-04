<?php

namespace App\Http\Controllers;

use App\UserAccess;
use App\User;
use App\Plant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Equipment;

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
    		$dataUser = User::where('id_client', Auth::user()->id_client)->where('id_role', '>', '3')->get();
    		//$dataPlant = Plant::where('id', Auth::user()->id_plant)->get();
    		//$dataEquipment = Equipment::where('id_plant', Auth::user()->id_plant)->get();
    		$dataUserAccess = UserAccess::all();
    	}else{
    		$dataUser = User::where('id_role', '>', '3')->get();
    		//$dataPlant = Plant::all();
    		//$dataEquipment = Equipment::all();
    		$dataUserAccess = UserAccess::all();
    	}
    	return view('usersAccess.usersAccess', compact('dataUserAccess', 'dataUser'));
    	
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
    	$this->validate($request, [
    			'id_user' => 'required|numeric',
    			'id_equipment' => 'required|numeric',
    	]);    	 
    	$userAccess = $request->all();
    	UserAccess::create($userAccess);
    	session()->flash('message', 'Se ha creado el acceso correctamente.');
    	return redirect('/user-access');
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
    public function destroy($id)
    {
    	$userAccess = UserAccess::find($id);
    	$userAccess->delete();
    	
    	session()->flash('message', 'Se ha eliminado el acceso correctamente.');
    	return redirect('/user-access');
    }
}
