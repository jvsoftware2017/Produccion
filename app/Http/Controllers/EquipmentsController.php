<?php

namespace App\Http\Controllers;

use App\Equipment;
use App\Plant;
use App\Type;
use Illuminate\Http\Request;
use Storage;
use Carbon\Carbon;

class EquipmentsController extends Controller
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
        $dataEquipment = Equipment::all();
        $dataPlant = Plant::All();
        $dataType = Type::All();
        return view('equipments.equipments', compact('dataEquipment','dataPlant','dataType'));
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
            'name' => 'required',
            'model' => 'required',
            'id_type' => 'required',
            'id_plant' => 'required',
            'status' => 'required',
        ]);
        $equipment = new Equipment();
        $equipment->name = $request->name;
        $equipment->model = $request->model;
        $equipment->id_type = $request->id_type;
        $equipment->id_plant = $request->id_plant;
        $equipment->status = $request->status;
        
        if (isset($request->urlImg) && $request->urlImg != null){
        	$this->validate($request, [
        			'urlImg' => 'required|image|max:2000',
        	]);
        	$equipmentImg = $request->file('urlImg');
        	$route_file = time(). "_" .$equipmentImg->getClientOriginalName();
        	Storage::disk('equipmentImg')->put($route_file, file_get_contents( $equipmentImg->getRealPath() ));
        	$equipment->urlImg = $route_file;
        }
        $equipment->save();
        /*$equipment = $request->all();
        Equipment::create($equipment);*/
        session()->flash('message', 'Se ha creado el Equipo correctamente.');
        return redirect('/equipments');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function show(Equipment $equipment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipment $equipment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'model' => 'required',
            'id_type' => 'required',
            'id_plant' => 'required',
            'status' => 'required',
        ]);
        $equipment = Equipment::find($id);
        $equipment->name = $request->name;
        $equipment->model = $request->model;
        $equipment->id_type = $request->id_type;
        $equipment->id_plant = $request->id_plant;
        $equipment->status = $request->status;
        
        if (isset($request->urlImg) && $request->urlImg != null){
        	$this->validate($request, [
        			'urlImg' => 'image|max:2000',
        	]);
        	$equipmentImg = $request->file('urlImg');
        	$route_file = time(). "_" .$equipmentImg->getClientOriginalName();
        	Storage::disk('equipmentImg')->put($route_file, file_get_contents( $equipmentImg->getRealPath() ));
        	Storage::disk('equipmentImg')->delete($request->prevImg);
        	$equipment->urlImg = $route_file;
        }
        $equipment->updated_at = Carbon::now();
        $equipment->save();
        session()->flash('message', 'Se ha actualizado la información del Equipo');
        return redirect('/equipments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipment $equipment)
    {
        //
    }
}