<?php

namespace App\Http\Controllers;

use App\Client;
use App\City;
use Illuminate\Http\Request;
use Storage;


class ClientsController extends Controller
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
        $dataClient = Client::all();
        $dataCity = City::All();
    	return view('clients.clients', compact('dataCity','dataClient'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	return view('clients.create');
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
    			'phone' => 'required|numeric',
    			'status' => 'required',
    			'id_city' => 'required',
    	]);
    	
    	$client = new Client();
    	$client->name = $request->name;
    	$client->email = $request->email;
    	$client->phone = $request->phone;
    	$client->adress = $request->adress;
    	$client->status = $request->status;
    	$client->id_city = $request->id_city;
    	if (isset($request->urlLogo) && $request->urlLogo != null){
    		$this->validate($request, [
    				'urlLogo' => 'image|max:2000',
    		]);
	    	$clientLogo = $request->file('urlLogo');
	    	$route_file = time(). "_" .$clientLogo->getClientOriginalName();
	    	Storage::disk('clientLogo')->put($route_file, file_get_contents( $clientLogo->getRealPath() ));
	    	$client->urlLogo = $route_file;
    	}
    	$client->save();
    	session()->flash('message', 'Se ha creado el cliente correctamente.');
    	return redirect('/clients');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client

     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Clients  $clients

     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
    	return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Clients  $clients

     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	$this->validate($request, [
    			'name' => 'required|max:255|',
    			'email' => 'required|email|max:255',
    			'phone' => 'required|numeric',
    			'status' => 'required',
    			'id_city' => 'required',
    	]);
    	 
    	$client = Client::find($id);
    	$client->name = $request->name;
    	$client->email = $request->email;
    	$client->phone = $request->phone;
    	$client->adress = $request->adress;
    	$client->status = $request->status;
    	$client->id_city = $request->id_city;
    	if (isset($request->urlLogo) && $request->urlLogo != null){
    		$this->validate($request, [
    				'urlLogo' => 'image|max:2000',
    		]);
	    	$clientLogo = $request->file('urlLogo');
	    	$route_file = time(). "_" .$clientLogo->getClientOriginalName();
	    	Storage::disk('clientLogo')->put($route_file, file_get_contents( $clientLogo->getRealPath() ));
	    	Storage::disk('clientLogo')->delete($request->prevLogo);
	    	$client->urlLogo = $route_file;
    	}
    	$client->save();
        session()->flash('message', 'Se ha actualizado el cliente');
        return redirect('/clients');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Clients  $clients

     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
