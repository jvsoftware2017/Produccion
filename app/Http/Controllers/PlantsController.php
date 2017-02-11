<?php

namespace App\Http\Controllers;

use App\Plant;
use App\City;
use App\Client;

use Illuminate\Http\Request;

class PlantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataPlant = Plant::All();
        $dataCity = City::All();
        $dataClient = Client::All();
        return view('plants.plants', compact('dataPlant','dataCity','dataClient'));
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
    			'id_city' => 'required',
    			'id_client' => 'required',
    			'status' => 'required',
    	]);
        $plant = $request->all();
        Plant::create($plant);
        session()->flash('message', 'Se ha creado la planta correctamente.');
        return redirect('/plants');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plant  $plant
     * @return \Illuminate\Http\Response
     */
    public function show(Plant $plant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plant  $plant
     * @return \Illuminate\Http\Response
     */
    public function edit(Plant $plant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plant  $plant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plant $plant)
    {
    	$this->validate($request, [
    			'name' => 'required|max:255|',
    			'id_city' => 'required',
    			'id_client' => 'required',
    			'status' => 'required',
    	]);
    	$plant->update($request->all());
        session()->flash('message', 'Se ha actualizado la información de la planta');
        return redirect('/plants');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plant  $plant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plant $plant)
    {
        //
    }
}
