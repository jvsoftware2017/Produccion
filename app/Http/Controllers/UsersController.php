<?php

namespace App\Http\Controllers;

use App\Plant;
use Illuminate\Http\Request;
use App\User;
use App\Client;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\Welcome;

class UsersController extends Controller
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
    	if(Auth::user()->role->description == 'client'){
    		$dataClient = Client::where('id', Auth::user()->id_client)->get();
    		$dataUser = User::where('id_client', Auth::user()->id_client)->get();
    		$dataPlant = Plant::where('id_client', Auth::user()->id_client)->get();
    	}else{
    		$dataClient = Client::all();
    		$dataUser = User::all();
    		$dataPlant = Plant::all();
    	}
    	$dataRole = Role::where('id', '>' , Auth::user()->id_role)->get();
    	return view('users.users', compact('dataClient', 'dataUser', 'dataRole', 'dataPlant'));
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
    			'id_plant' => 'required|numeric',
    			'id_role' => 'required|numeric',
    			'status' => 'required',
    			'password' => 'required|min:6',
    	]);
    	
    	if ($request->id_role == 1 && Auth::user()->id_role != 1) {
    	    		$request->merge(['id_role' => 2]);
    	}
    	
    	$password = $request->password;
    	$request->merge(['password' => bcrypt($request->password)]);
    	$user = $request->all();
    	User::create($user);
    	Mail::to($request->email)->send(new Welcome($password));
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
    public function update(Request $request, $id)
    {
    	$user = User::find($id);
    	$passwordValidation = '';
    	
    	if (isset($request->password)){
    		$user->password = bcrypt($request->password);
    		$passwordValidation = 'required|min:6';
    	}
    	
    	
    	$this->validate($request, [
    			'name' => 'required|max:255|',
    			'email' => 'required|email|max:255',
    			'id_client' => 'required|numeric',
    			'id_plant' => 'required|numeric',
    			'id_role' => 'required|numeric',
    			'status' => 'required',
    			'password' => $passwordValidation
    			
    	]);
    	
    	if (($request->id_role == 1) && Auth::user()->id_role != 1) {
    	    $request->merge(['id_role' => 2]);
    	}elseif (($request->id_role == 2) && (Auth::user()->id_role != 1 || Auth::user()->id_role != 2)){
    		$request->merge(['id_role' => 3]);
    	}
    	
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->id_client = $request->id_client;
    	$user->id_role = $request->id_role;
    	$user->status = $request->status;
    	$user->id_plant= $request->id_plant;
    	$user->updated_at = Carbon::now();
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
    
    public function showProfile(){
    	
    	$user = User::find(Auth::user()->id);
    	return view('users.profile', compact('user'));
    }
    
    public function updateProfile(Request $request){
    	 
    	$user = User::find(Auth::user()->id);
    	$passwordValidation = '';
    	 
    	if (isset($request->password)){
    		$user->password = bcrypt($request->password);
    		$passwordValidation = 'required|min:6';
    	}
    	
    	$this->validate($request, [
    			'name' => 'required|max:255|',
    			'password' => $passwordValidation
    	]);
    	
    	$user->name = $request->name;
    	$user->save();
    	session()->flash('message', 'Se ha editado el usuario correctamente.');
    	return redirect('/user_profile');
    }
}
