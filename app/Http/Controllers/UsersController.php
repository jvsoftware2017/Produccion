<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Client;
use App\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataUser = User::all();
        $dataClient = Client::all();
        $dataRole = Role::all();
    	return view('users.users', compact('dataClient', 'dataUser', 'dataRole'));
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
    			'name' => 'required|max:255|',
    			'email' => 'required|email|max:255',
    			'id_client' => 'required|numeric',
    			'id_role' => 'required|numeric',
    			'status' => 'required',
    			'password' => 'required',
    	]);
    	
    	$request->merge(['password' => bcrypt($request->password)]);
    	
    	$user = $request->all();
    	User::create($user);
    	session()->flash('message', 'Se ha creado el usuario correctamente.');
    	return redirect('/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
    	$this->validate($request, [
    			'name' => 'required|max:255|',
    			'email' => 'required|email|max:255',
    			'id_client' => 'required|numeric',
    			'id_role' => 'required|numeric',
    			'status' => 'required',
    	]);
    	 
    	if (isset($request->password)){
    		$request->merge(['password' => bcrypt($request->password)]);
    	}
    	 
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->id_client = $request->id_client;
    	$user->id_role = $request->id_role;
    	$user->status = $request->status;
    	$user->update();
    	session()->flash('message', 'Se ha editado el usuario correctamente.');
    	return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
