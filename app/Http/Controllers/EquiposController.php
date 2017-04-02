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
'DP_11' => 'GStat bit11',
'DP_12' => 'GStat bit12',
'DP_13' => 'GStat bit13',
'DP_14' => 'GStat bit14',
'DP_15' => 'GStat bit15',
'DP_16' => 'Motor speed',
'DP_17' => 'Motor voltage',
'DP_18' => 'Total current',
'DP_19' => 'Output Power',
'DP_20' => 'Speed demand',
'DP_21' => 'Speed reference',
'DP_22' => 'Heartbeat',
'DP_23' => 'Input RMS Current',
'DP_24' => 'Input Frequency',
'DP_25' => 'Input power avg',
'DP_26' => 'Torque Current',
'DP_27' => 'Magnetizing current',
'DP_28' => 'Motor Flux',
'DP_29' => 'Motor torque',
'DP_30' => 'Input voltage',
'DP_31' => 'Input power fact',
'DP_32' => 'Input KVARS',
'DP_33' => 'Max available out voltage',
'DP_34' => 'Hottest cell temp',
'DP_35' => 'Spare21 VFD',
'DP_36' => 'Spare22 VFD',
'DP_37' => 'Spare23 VFD',
'DP_38' => 'Spare24 VFD',
'DP_39' => 'Next Mant. Hours',
'DP_40' => 'Hours act',
'DP_41' => 'Hours HH',
'DP_42' => 'Hours H',
'DP_43' => 'Hours DELT',
'DP_44' => 'Temp room',
'DP_45' => 'Temp room HH',
'DP_46' => 'Temp room H',
'DP_47' => 'Temp room L',
'DP_48' => 'Temp room LL',
'DP_49' => 'HumR room',
'DP_50' => 'HumR room HH',
'DP_51' => 'HumR room H',
'DP_52' => 'HumR room L',
'DP_53' => 'HumR room LL',
'DP_54' => 'Spare001 PLC',
'DP_55' => 'Spare002 PLC',
'DP_56' => 'Spare003 PLC',
'DP_57' => 'Spare004 PLC',
'DP_58' => 'Fault PLC',
'DP_59' => 'Mant PLC',
'DP_60' => 'Run/Stop',
'DP_61' => 'GStat1 bit3',
'DP_62' => 'GStat1 bit4',
'DP_63' => 'Charge PLC by UPS',
'DP_64' => 'GStat1 bit6',
'DP_65' => 'Fail SENAL Temp. room',
'DP_66' => 'Fail SENAL Hum. Relative',
'DP_67' => 'Comunication Fail MB PLC VFD',
'DP_68' => 'Comunication Fail Pulse TCB',
'DP_69' => 'GStat1 bit11',
'DP_70' => 'GStat1 bit12',
'DP_71' => 'GStat1 bit13',
'DP_72' => 'GStat1 bit14',
'DP_73' => 'GStat1 bit15',
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
'DP_85' => 'GStat2 bit11',
'DP_86' => 'GStat2 bit12',
'DP_87' => 'GStat2 bit13',
'DP_88' => 'GStat2 bit14',
'DP_89' => 'GStat2 bit15',
'DP_90' => 'SPARE006',
'DP_91' => 'SPARE007',
'DP_92' => 'SPARE008',
'DP_93' => 'SPARE009'
	);
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$dataEquipo = array();
    	$equipos = UserAccess::where('id_user' , Auth::user()->id)->get();
    	foreach ($equipos as $equipo){
    		array_push($dataEquipo, Equipment::where('id', $equipo->id_equipment)->get());
    	}
   		$nameVariables = $this->nameVariablesG;
    	return view('monitor.monitor', compact('dataEquipo','nameVariables'));
    }
    
    public function refresh()
    {
    	$dataEquipo = array();
    	$equipos = UserAccess::where('id_user' , Auth::user()->id)->get();
    	foreach ($equipos as $equipo){
    		array_push($dataEquipo, Equipment::where('id', $equipo->id_equipment)->get());
    	}
    	$nameVariables = $this->nameVariablesG;
    	return view('monitor.monitorRefresh', compact('dataEquipo','nameVariables'));
    }
    
    public function detail($id)
    {
    	$dataEquipo = Equipment::where('id_equipo', $id)->get();
    	$dataEvent = Event::where('id_equipo', $id)->get();
    	return view('monitor.monitorDetail', compact('dataEquipo', 'dataEvent'));
    }
    
    public function refreshDetail($id)
    {
    	$dataEquipo = Equipment::where('id_equipo', $id)->get();
    	$dataEvent = Event::where('id_equipo', $id)->get();
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
