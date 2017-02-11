<?php

namespace App\Http\Controllers;

use App\Client;
use App\City;
use Illuminate\Http\Request;

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
    	$client = $request->all();
    	Client::create($client);
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
    public function update(Request $request, Client $client)
    {
        $client->update($request->all());
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
