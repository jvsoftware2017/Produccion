
@extends('layouts.app')
@section('title', 'Sedes | DriveSysMonitor')
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        {{ csrf_field() }}
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Administrador de Sedes</h2>                     
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="text-muted font-13 m-b-30">
                            Por medio de este módulo, puedes ver la información de las sedes
                            @if(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user()))
	                            <p align="right">
	                                <button type="button" class="btn btn-round btn-success" data-toggle="modal" data-target="#create-item">Crear</button>
	                            </p>
                            @endif
                        </div>
                        @if($flash = session('message'))
                            <div class="alert alert-success alert-dismissible fade in"
                                 role="alert">
                                <button type="button" class="close" data-dismiss="alert"
                                        aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>{{ $flash }}</strong>
                            </div>
                        @endif
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li> @endforeach
                                </ul>
                            </div>
                        @endif
						<div class="table-responsive">
	                        <table id="datatable" class="table table-striped table-bordered">
	                            <thead>
	                            <tr>
	                                <th>Ciudad</th>
	                                <th>Cliente</th>
	                                <th>Sede</th>
	                                <th>Dirección</th>
	                                <th>Teléfono</th>
	                                <th>Fecha Registro</th>
	                                <th>Fecha Modificación</th>
	                                <th>Estado</th>
	                                @if(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user()))
	                                	<th>Acción</th>
	                                @endif
	                               	<th>Equipos</th>
	                            </tr>
	                            </thead>
	
	                            <tbody>
	                            @foreach($dataPlant as $rowplant)
									@if($rowplant->status == 'inactive')
										<tr class="danger"">
									@else
										<tr>
									@endif
	                                        <td>{{$rowplant->city->name}}</td>
	                                        <td>{{$rowplant->client->name}}</td>
	                                        <td>{{$rowplant->name}}</td>
	                                        <td>{{$rowplant->adress}}</td>
	                                        <td>{{$rowplant->phone}}</td>
	                                        <td>{{$rowplant->created_at}}</td>
	                                        <td>{{$rowplant->updated_at}}</td>
	                                        <td>{{$rowplant->status}}</td>
	                                        @if(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user()))
		                                        <td>
		                                            <button data-toggle="modal" data-target="#edit-item" class="btn btn-round btn-warning edit-item" onclick="getPlant({{$rowplant->id}})">Editar</button>
		                                        </td>
	                                        @endif
	                                        <td>
												<a href="/nav_equipments/{{ $rowplant->id }} "><div type="button" class="btn btn-round btn-success">Equipos</div></a>
											</td>
	                                    </tr>
	                            @endforeach
	                            
	                            </tbody>
	                        </table>
	                    </div>
	                    @if(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user()))
                                    <!-- Edit Item Modal -->
                                    <div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <!--edit modal goes here -->
                                    </div>
								@endif
						@if(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user()))
	                        <!-- Create Item Modal -->
	                        <div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	                            <div class="modal-dialog" role="document">
	                                <div class="modal-content">
	                                    <div class="modal-header">
	                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                                        <h4 class="modal-title" id="myModalLabel">Crear sede</h4>
	                                    </div>
	                                    <div class="modal-body">
	
	                                        <form data-toggle="validator" action="/plants" method="POST">
	                                            {{ csrf_field() }}
	
	                                            <div class="form-group">
	                                                <label class="control-label" for="title">Ciudad:</label>
	                                                <select class="form-control" name="id_city" id="id_city">
	                                                    @foreach($dataCity as $rowcity)
	                                                        <option value="{{$rowcity->id}}">{{$rowcity->name}}</option>
	                                                    @endforeach
	                                                </select>
	                                                <div class="help-block with-errors"></div>
	                                            </div>
	
	                                            <div class="form-group">
	                                                <label class="control-label" for="title">Cliente:</label>
	                                                <select class="form-control" name="id_client" id="id_client">
	                                                    @foreach($dataClient as $rowclient)
	                                                        <option value="{{$rowclient->id}}">{{$rowclient->name}}</option>
	                                                    @endforeach
	                                                </select>
	                                                <!--<input type="text" name="clientId" class="form-control" data-error="Please enter title." required />-->
	                                                <div class="help-block with-errors"></div>
	                                            </div>
	
	                                            <div class="form-group">
	                                                <label class="control-label" for="title">Nombre:</label>
	                                                <input type="text" name="name" id="name" class="form-control" data-error="Please enter title." oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
	                                                <div class="help-block with-errors"></div>
	                                            </div>
	
	                                            <div class="form-group">
	                                                <label class="control-label" for="title">Dirección:</label>
	                                                <input type="text" name="adress"  class="form-control" data-error="Please enter title." />
	                                                <div class="help-block with-errors"></div>
	                                            </div>
	                                            
	                                            <div class="form-group">
                                                    <label class="control-label" for="phone">Teléfono:</label>
                                                    <input type="number" name="phone" class="form-control" data-error="Escriba solo números" />
                                                    <div class="help-block with-errors"></div>
                                                </div>
	
	                                            <div class="form-group">
	                                                <label class="control-label" for="title">Estado:</label>
	                                                <select class="form-control" name="status" id="status">
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
	                            </div>
	                        </div>
						@endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection