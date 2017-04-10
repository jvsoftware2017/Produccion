<?php

namespace App\Http\Controllers;

use App\Report;
use App\UserAccess;
use App\Equipment;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$dataEquipo = array();
    	if(Auth::user()->role->description == 'admin' || Auth::user()->role->description == 'developer'){
    		array_push($dataEquipo,Equipment::all());
    	}elseif(Auth::user()->role->description == 'client'){
    		$plants = Plant::where('id_client' , Auth::user()->id_client)->get();
    		foreach ($plants as $plant){
    			array_push($dataEquipo, Equipment::where('id_plant', $plant->id)->get());
    		}
    	
    	}else{
	    	$equipos = UserAccess::where('id_user' , Auth::user()->id)->get();
	    	foreach ($equipos as $equipo){
	    		array_push($dataEquipo, Equipment::where('id', $equipo->id_equipment)->get());
	    	}
    	}
    	return view('reports.reports',compact('dataEquipo'));
    }
    
    public function report($id)
    {
    	$equipo = $id;
    	return view('reports.reports',compact('equipo'));
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
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
    
    public function returnValues(Request $request, $var, $id_equipo, $month){
    	$response = Report::getValuesToGraphic($var, $id_equipo, $month);
    	return response()->json($response);
    }
}
