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
        
        $dataCity = City::All();
        $dataClient = Client::all();
        $dataCityHtml = '';
        $dataClientHtml = '';
        foreach($dataCity as $rowcity){
            $dataCityHtml .= '<option value="' . $rowcity->id . '">' . $rowcity->name . '</option>';
        }
        foreach($dataClient as $rowclient){
            $dataClientHtml .= '<option value="' . $rowclient->id . '">' . $rowclient->name . '</option>';
        }

        $html = '<div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Editar sede <strong>' . $plant->name . '</strong></h4>
                        </div>
                        <div class="modal-body">

                            <form data-toggle="validator" action="/plants/' . $plant->id . '" method="POST">
                                ' . csrf_field() . '
                                ' . method_field('PUT') . '
                                <div class="form-group">
                                    <label class="control-label" for="title">Ciudad:</label>
                                    <select class="form-control" name="id_city" id="id_city">
                                        <option selected value="' . $plant->city->id . '">' . $plant->city->name . '</option>
                                        ' . $dataCityHtml . '
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label" for="title">Cliente:</label>
                                    <select class="form-control" name="id_client" id="id_client">
                                        <option selected value="' . $plant->client->id . '">' . $plant->client->name . '</option>
                                        ' . $dataClientHtml . '
                                    </select>
                                    <!--<input type="text" name="clientId" class="form-control" data-error="Please enter title." required />-->
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="title">Nombre:</label>
                                    <input type="text" name="name" id="name" class="form-control" value="' . $plant->name . '" data-error="Please enter title." oninvalid="this.setCustomValidity("Campo requerido")" oninput="setCustomValidity("")" required />
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="title">Dirección:</label>
                                    <input type="text" name="adress" value="' . $plant->adress . '" class="form-control" data-error="Please enter title." />
                                    <div class="help-block with-errors"></div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label" for="phone">Teléfono:</label>
                                    <input type="text" name="phone" value="' . $plant->phone . '" class="form-control" data-error="Escriba solo números" />
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="title">Estado:</label>
                                    <select class="form-control" name="status" id="status">
                                        <option selected value="' . $plant->status . '">' . $plant->status . '</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>


                                <div class="form-group">
                                    <button type="submit" class="btn btn-round crud-submit btn-success">Guardar</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>';
        header('Content-Type: application/json');
        echo  json_encode($html, JSON_PRETTY_PRINT);
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
    			'phone' => 'string',
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
