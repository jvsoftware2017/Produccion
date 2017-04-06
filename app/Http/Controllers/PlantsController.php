<?php

namespace App\Http\Controllers;

use App\Plant;
use App\City;
use App\Client;
use App\Equipment;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlantsController extends Controller
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
    		$dataPlant = Plant::where('id_client', Auth::user()->id_client)->get();
    		$dataClient = Client::where('id', Auth::user()->id_client)->get();
    	}else{
    		$dataClient = Client::all();
    		$dataPlant = Plant::All();
    	}
        $dataCity = City::All();
        return view('plants.plants', compact('dataPlant','dataCity','dataClient'));
    }
    
    public function nav_index($id)
    {
    	$dataPlant = Plant::where('id_client', $id)->get();
    	$dataClient = Client::where('id', $id)->get();
    	$dataCity = City::All();
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
    			'name' => 'required|max:255',
    			'id_city' => 'required',
    			'id_client' => 'required',
    			'status' => 'required',
    	]);
    	if (isset($request->phone) && $request->phone != null) {
    		$this->validate($request, [
    				'phone' => 'digits_between:5,20',
    		]);
    	}
        $plant = $request->all();
        Plant::create($plant);
        session()->flash('message', 'Se ha creado la sede correctamente.');
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
    			'name' => 'required|max:255',
    			'id_city' => 'required',
    			'id_client' => 'required',
    			'status' => 'required',
    			'name' => 'max:255',
    	]);
    	$plant->updated_at = Carbon::now();
    	$plant->name = $request->name;
    	$plant->id_city = $request->id_city;
    	$plant->id_client = $request->id_client;
    	$plant->status = $request->status;
    	$plant->adress = $request->adress;
    	if (isset($request->phone) && $request->phone != null) {
    		$this->validate($request, [
    			'phone' => 'digits_between:5,20',
    		]);
    		$plant->phone = $request->phone;
    	}
    	$plant->update();
        session()->flash('message', 'Se ha actualizado la información de la sede');
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

    public function getEquipments(Request $request, $id){
            $equipments = Equipment::equipmentsByIdPlant($id);
            return response()->json($equipments);
    }
}
