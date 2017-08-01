<?php

namespace App\Http\Controllers;

use App\Report;
use App\UserAccess;
use App\Equipment;
use App\Event;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Goutte\Client;

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
    	$dataEquipo = Equipment::where('id_equipo', $id)->get();
    	$url = $dataEquipo[0]->plant->client->urlLogo;
    	return view('reports.reports',compact('equipo','url'));
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

	public function returnValuesEvent(Request $request, $var, $id_equipo, $month){
    	$response = Event::getCountEventByReports($var, $id_equipo, $month);
    	return response()->json($response);
    }
    
    public function reportScraping(){
    	$client = new Client();
    	$view = $client->request("Get","https://deitydev.com/home");
    	// Select Login form
    	$form = $view->selectButton("Iniciar Sesión")->form();
    	
    	// Submit form
    	$view = $client->submit($form, array(
    			'email' => 'victor.18090@gmail.com',
    			'password' => 'developer',
    	));
    	$view = $client->request("GET","https://deitydev.com/report/1101");
    	//dd($view);
    	echo $view->html();
    	// PHP Configuration page
    	
    	//dd($view);
    	//return redirect("/report/1102");
    }
	
}
