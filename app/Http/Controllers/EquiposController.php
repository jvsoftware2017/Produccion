<?php

namespace App\Http\Controllers;

use App\Equipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use App\UserAccess;
use App\Equipment;
use App\Event;
use App\Plant;

class EquiposController extends Controller
{
	private $nameVariablesG = array(	'DP_0' => 'Fault',
'DP_1' => 'Alarm',
'DP_2' => 'Running Forward',
'DP_3' => 'Running Reverse',
'DP_4' => 'Drive Ready',
'DP_5' => 'Start/Stop Control Network',
'DP_6' => 'Spped Reference Network',
'DP_7' => 'At Speed Reference',
'DP_8' => 'Speed in Percent',
'DP_9' => 'Speed in RPM',
'DP_10' => 'Speed in Hz',
'DP_11' => 'Spare Bit',
'DP_12' => 'Spare Bit',
'DP_13' => 'Spare Bit',
'DP_14' => 'Spare Bit',
'DP_15' => 'Spare Bit',
'DP_16' => 'Motor speed',
'DP_17' => 'Motor voltage (Volts)',
'DP_18' => 'Total current (Amps)',
'DP_19' => 'Output Power (kW)',
'DP_20' => 'Speed demand (%)',
'DP_21' => 'Speed reference (%)',
'DP_22' => 'Heartbeat',
'DP_23' => 'Input RMS Current (Amps)',
'DP_24' => 'Input Frequency (Hz)',
'DP_25' => 'Input power avg (kW)',
'DP_26' => 'Torque Current (Amps)',
'DP_27' => 'Magnetizing current (Amps)',
'DP_28' => 'Motor Flux (%)',
'DP_29' => 'Motor torque (%)',
'DP_30' => 'Input voltage (Volts)',
'DP_31' => 'Input power fact (%)',
'DP_32' => 'Input KVARS (kVAR)',
'DP_33' => 'Max available out voltage (Volts)',
'DP_34' => 'Hottest cell temp (%)',
'DP_35' => 'Spare21 VFD',
'DP_36' => 'Spare22 VFD',
'DP_37' => 'Spare23 VFD',
'DP_38' => 'Spare24 VFD',
'DP_39' => 'Next Mant. Hours (Hrs)',
'DP_40' => 'Hours act (Hrs)',
'DP_41' => 'Hours HH (Hrs)',
'DP_42' => 'Hours H (Hrs)',
'DP_43' => 'Hours DELT (Hrs)',
'DP_44' => 'Temp room (°C)',
'DP_45' => 'Temp room HH (°C)',
'DP_46' => 'Temp room H (°C)',
'DP_47' => 'Temp room L (°C)',
'DP_48' => 'Temp room LL (°C)',
'DP_49' => 'HumR room (%)',
'DP_50' => 'HumR room HH (%)',
'DP_51' => 'HumR room H (%)',
'DP_52' => 'HumR room L (%)',
'DP_53' => 'HumR room LL (%)',
'DP_54' => 'Spare001 PLC',
'DP_55' => 'Spare002 PLC',
'DP_56' => 'Spare003 PLC',
'DP_57' => 'Spare004 PLC',
'DP_58' => 'Fault Unid. Monitoreo',
'DP_59' => 'Mant Unid. Monitoreo',
'DP_60' => 'Run/Stop',
'DP_61' => 'Spare Bit',
'DP_62' => 'Spare Bit',
'DP_63' => 'Charge Uni. Mon. by UPS',
'DP_64' => 'GStat1 bit6',
'DP_65' => 'Fail SENAL Temp. room',
'DP_66' => 'Fail SENAL Hum. Relative',
'DP_67' => 'Comunication Fail MB Uni. Mon. VFD',
'DP_68' => 'Comunication Fail Pulse TCB',
'DP_69' => 'Spare Bit',
'DP_70' => 'Spare Bit',
'DP_71' => 'Spare Bit',
'DP_72' => 'Spare Bit',
'DP_73' => 'Spare Bit',
'DP_74' => 'HH Hours Oper. Alarm',
'DP_75' => 'HH Hours Oper. Warning',
'DP_76' => 'Delt Hours Oper. Warning',
'DP_77' => 'HH Temp. Alarm',
'DP_78' => 'H Temp. Warning',
'DP_79' => 'L Temp. Warning',
'DP_80' => 'LL Temp. Warning',
'DP_81' => 'HH Hum. Rel. Alarm',
'DP_82' => 'H Hum. Rel. Warning',
'DP_83' => 'L Hum. Rel. Warning',
'DP_84' => 'LL Hum. Rel. Alarm',
'DP_85' => 'Spare Bit',
'DP_86' => 'Spare Bit',
'DP_87' => 'Spare Bit',
'DP_88' => 'Spare Bit',
'DP_89' => 'Spare Bit',
'DP_90' => 'Spare Real',
'DP_91' => 'Spare Real',
'DP_92' => 'Spare Real',
'DP_93' => 'Spare Real'
	);
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
    	$filtro = 0;
   		$nameVariables = $this->nameVariablesG;
    	return view('monitor.monitor', compact('dataEquipo','nameVariables','filtro'));
    }
    
    public function nav_index($id)
    {
    	$dataEquipo = array();
    	array_push($dataEquipo, Equipment::where('id_equipo', $id)->get());
    	$nameVariables = $this->nameVariablesG;
    	$filtro = 1;
    	return view('monitor.monitor', compact('dataEquipo','nameVariables','filtro'));
    }
    
    public function refresh()
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
    	$nameVariables = $this->nameVariablesG;
    	return view('monitor.monitorRefresh', compact('dataEquipo','nameVariables'));
    }
    
    public function nav_refresh($id)
    {
    	$dataEquipo = array();
    	array_push($dataEquipo, Equipment::where('id_equipo', $id)->get());
    	$nameVariables = $this->nameVariablesG;
    	$filtro = 1;
    	return view('monitor.monitorRefresh', compact('dataEquipo','nameVariables','filtro'));
    }
    
    public function detail($id)
    {
    	$dataEquipo = Equipment::where('id_equipo', $id)->get();
    	$dataEvent = Event::where('id_equipo', $id)->orderby('id', 'desc')->limit('10')->get();
    	return view('monitor.monitorDetail', compact('dataEquipo', 'dataEvent'));
    }
    
    public function refreshDetail($id)
    {
    	$dataEquipo = Equipment::where('id_equipo', $id)->get();
    	$dataEvent = Event::where('id_equipo', $id)->orderby('id', 'desc')->limit('10')->get();
    	return view('monitor.monitorDetailRefresh', compact('dataEquipo', 'dataEvent'));
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
     * @param  \App\equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function show(equipo $equipo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function edit(equipo $equipo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, equipo $equipo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function destroy(equipo $equipo)
    {
        //
    }
}
