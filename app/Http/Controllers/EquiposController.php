<?php

namespace App\Http\Controllers;

use App\Equipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use App\UserAccess;
use App\Equipment;

class EquiposController extends Controller
{
	private $nameVariablesG = array(	'DP_5' => 'GStat_bit5',
			'DP_6' => 'GStat_bit6',
			'DP_7' => 'GStat_bit7',
			'DP_8' => 'GStat_bit8',
			'DP_9' => 'GStat_bit9',
			'DP_10' => 'GStat_bit10',
			'DP_11' => 'GStat_bit11',
			'DP_12' => 'GStat_bit12',
			'DP_13' => 'GStat_bit13',
			'DP_14' => 'GStat_bit14',
			'DP_15' => 'GStat_bit15',
			'DP_16' => 'Motor_speed',
			'DP_17' => 'Motor_voltage',
			'DP_18' => 'Total_current',
			'DP_19' => 'Output_Power',
			'DP_20' => 'Speed_demand',
			'DP_21' => 'Speed_reference',
			'DP_22' => 'Heartbeat',
			'DP_23' => 'Input_RMS_Current',
			'DP_24' => 'Input_Frequency',
			'DP_25' => 'Input_power_avg',
			'DP_26' => 'Torque_Current',
			'DP_27' => 'Magnetizing_current',
			'DP_28' => 'Motor_Flux',
			'DP_29' => 'Motor_torque',
			'DP_30' => 'Input_voltage',
			'DP_31' => 'Input_power_fact',
			'DP_32' => 'Input_KVARS',
			'DP_33' => 'Max_available_out_voltage',
			'DP_34' => 'Hottest cell temp',
			'DP_35' => 'spare21',
			'DP_36' => 'spare22',
			'DP_37' => 'spare23',
			'DP_38' => 'spare24',
			'DP_39' => 'spare25',
			'DP_40' => 'Horas_act',
			'DP_41' => 'Horas_HH',
			'DP_42' => 'Horas_H',
			'DP_43' => 'Horas_DELT',
			'DP_44' => 'Temp_room',
			'DP_45' => 'Temp_room_HH',
			'DP_46' => 'Temp_room_H',
			'DP_47' => 'Temp_room_L',
			'DP_48' => 'Temp_room_LL',
			'DP_49' => 'HumR_room',
			'DP_50' => 'HumR_room_HH',
			'DP_51' => 'HumR_room_H',
			'DP_52' => 'HumR_room_L',
			'DP_53' => 'HumR_room_LL',
			'DP_54' => 'spare001',
			'DP_55' => 'spare002',
			'DP_56' => 'spare003',
			'DP_57' => 'spare004',
			'DP_58' => 'GStat1_bit0',
			'DP_59' => 'GStat1_bit1',
			'DP_60' => 'GStat1_bit2',
			'DP_61' => 'GStat1_bit3',
			'DP_62' => 'GStat1_bit4',
			'DP_63' => 'GStat1_bit5',
			'DP_64' => 'GStat1_bit6',
			'DP_65' => 'GStat1_bit7',
			'DP_66' => 'GStat1_bit8',
			'DP_67' => 'GStat1_bit9',
			'DP_68' => 'GStat1_bit10',
			'DP_69' => 'GStat1_bit11',
			'DP_70' => 'GStat1_bit12',
			'DP_71' => 'GStat1_bit13',
			'DP_72' => 'GStat1_bit14',
			'DP_73' => 'GStat1_bit15',
			'DP_74' => 'GStat2_bit0',
			'DP_75' => 'GStat2_bit1',
			'DP_76' => 'GStat2_bit2',
			'DP_77' => 'GStat2_bit3',
			'DP_78' => 'GStat2_bit4',
			'DP_79' => 'GStat2_bit5',
			'DP_80' => 'GStat2_bit6',
			'DP_81' => 'GStat2_bit7',
			'DP_82' => 'GStat2_bit8',
			'DP_83' => 'GStat2_bit9',
			'DP_84' => 'GStat2_bit10',
			'DP_85' => 'GStat2_bit11',
			'DP_86' => 'GStat2_bit12',
			'DP_87' => 'GStat2_bit13',
			'DP_88' => 'GStat2_bit14',
			'DP_89' => 'GStat2_bit15',
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
    	$dataEquipo = array();
    	array_push($dataEquipo, Equipment::where('id', $id)->get());
    	return view('monitor.monitorDetail', compact('dataEquipo'));
    }
    
    public function refreshDetail($id)
    {
    	$dataEquipo = array();
    	array_push($dataEquipo, Equipment::where('id', $id)->get());
    	return view('monitor.monitorDetailRefresh', compact('dataEquipo'));
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
