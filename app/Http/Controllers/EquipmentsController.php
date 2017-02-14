<?php

namespace App\Http\Controllers;

use App\Equipment;
use App\Plant;
use App\Type;
use Illuminate\Http\Request;

class EquipmentsController extends Controller
{
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
        $equipment = $request->all();
        Equipment::create($equipment);
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
    public function update(Request $request, Equipment $equipment)
    {
        $this->validate($request, [
            'name' => 'required',
            'model' => 'required',
            'id_type' => 'required',
            'id_plant' => 'required',
            'status' => 'required',
        ]);
        $equipment->update($request->all());
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