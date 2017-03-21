@extends('layouts.app') @section('title', 'Equipos | DriveSysMonitor')

@section('content')
	<!-- page content -->
	<div class="right_col" role="main">
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Administrador de Equipos</h2>
						<div class="clearfix"></div>
					</div>

					<div class="x_content">
						<p class="text-muted font-13 m-b-30">Por medio de este módulo, puedes crear y editar equipos.</p>
						@if(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user()) || Gate::allows('client', Auth::user()))
							<p align="right">
								<button type="button" class="btn btn-round btn-success" data-toggle="modal" data-target="#create-item">Crear</button>
							</p>
						@endif
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
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
							<tr>
								<th>Preview</th>
								<th>TAG ID</th>
								<th>Tipo</th>
								<th>Sede</th>
								<th>Referencia</th>
								<th>Identificacion</th>
								<th>Fecha registro</th>
								<th>Fecha modificación</th>
								<th>Estado</th>
								@if(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user()) || Gate::allows('client', Auth::user()))
									<th>Acción</th>
								@endif
							</tr>
							</thead>
							<tbody>
								@foreach($dataEquipment as $rowEquipment)
									@if($rowEquipment->status == 'inactive')
										<tr class="danger"">
									@else
										<tr>
									@endif
											<td><img src="equipmentImg/{{ $rowEquipment->urlImg }}" class="img-responsive" alt="Logo del Cliente" style="max-width: 50px;"></td>
											<td>{{ $rowEquipment->name }}</td>
											<td>{{ $rowEquipment->type->name }}</td>
											<td>{{ $rowEquipment->plant->name }}</td>
											<td>{{ $rowEquipment->model }}</td>
											<td>{{ $rowEquipment->id_equipo }}</td>
											<td>{{ $rowEquipment->created_at }}</td>
											<td>{{ $rowEquipment->updated_at }}</td>
											<td>{{ $rowEquipment->status }}</td>
											@if(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user()) || Gate::allows('client', Auth::user()))
												<td>
													<!-- Large modal -->
													<div type="button" id="edit-client" class="btn btn-round btn-warning" data-toggle="modal" data-target="#edit-item{{ $rowEquipment->id }}" >Editar</div>
												</td>
											@endif
										</tr>
									@if(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user()) || Gate::allows('client', Auth::user()))
										<!-- Edit Item Modal -->
										<div class="modal fade" id="edit-item{{$rowEquipment->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														<h4 class="modal-title" id="myModalLabel">Editar Equipo <strong>{{ $rowEquipment->name }}</strong></h4>
													</div>
													<div class="modal-body">
	
														<form data-toggle="validator" action="/equipments/{{$rowEquipment->id}}" method="POST" enctype="multipart/form-data">
															{{ csrf_field() }}
															{{ method_field('PUT') }}
															<div class="form-group">
																<label class="control-label" for="title">TAG_ID:</label>
																<input type="text" name="name" id="name" class="form-control" value="{{$rowEquipment->name}}" data-error="Please enter title." oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
																<div class="help-block with-errors"></div>
															</div>
															
															<div class="form-group">
																<label class="control-label" for="title">Referencia:</label>
																<input type="text" name="model" id="model" class="form-control" value="{{$rowEquipment->model}}" data-error="Please enter title." oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
																<div class="help-block with-errors"></div>
															</div>
															
															<div class="form-group">
																<label class="control-label" for="title">Número de Serie:</label>
																<input type="text" name="serialNumber" id="serialNumber" class="form-control" value="{{$rowEquipment->serialNumber}}" data-error="Please enter title." oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
																<div class="help-block with-errors"></div>
															</div>
															
															<div class="form-group">
																<label class="control-label" for="title">Potencia:</label>
																<input type="text" name="power" id="power" class="form-control" value="{{$rowEquipment->power}}" data-error="Please enter title." oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
																<p>
																	W:
																	<input type="radio" name="unit" value="W" /> 
																	kW:
																	<input type="radio" name="unit" value="kW" />
																	HP:
																	<input type="radio" name="unit" value="HP" />
																</p>
																<div class="help-block with-errors"></div>
															</div>
															
															<div class="form-group">
																<label class="control-label" for="title">Voltaje:</label>
																<input type="text" name="voltage" id="voltage" class="form-control" value="{{$rowEquipment->voltage}}" data-error="Please enter title." oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
																<p>
																	V:
																	<input type="radio" name="unitvol" value="V" /> 
																	kV:
																	<input type="radio" name="unitvol" value="kV" />
																</p>
																<div class="help-block with-errors"></div>
															</div>
															
															<div class="form-group">
																<label class="control-label" for="title">Área:</label>
																<input type="text" name="area" id="area" class="form-control" value="{{$rowEquipment->area}}" data-error="Please enter title." oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
																<div class="help-block with-errors"></div>
															</div>
															
															<div class="form-group">
																<label class="control-label" for="title">Sub-Área:</label>
																<input type="text" name="subarea" id="subarea" class="form-control" value="{{$rowEquipment->subarea}}" data-error="Please enter title." oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
																<div class="help-block with-errors"></div>
															</div>
															
															<div class="form-group">
																<label class="control-label" for="title">Función:</label>
																<input type="text" name="function" id="function" class="form-control" value="{{$rowEquipment->function}}" data-error="Please enter title." oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
																<div class="help-block with-errors"></div>
															</div>
															
															<div class="form-group">
																<label class="control-label" for="title">Ciclo de vida:</label>
																<select class="form-control" name="lifecycle" id="lifecycle">
																	<option selected value="{{$rowEquipment->lifecycle}}">{{$rowEquipment->lifecycle}}</option>
																	<option value="PM 300 Active">PM 300 Active</option>
																	<option value="PM 400 Phase out">PM 400 Phase out</option>
																	<option value="PM 410 Cancelation">PM 410 Cancelation</option>
																	<option value="PM 490 Discontinuation">PM 490 Discontinuation</option>
																	<option value="PM 500 End of Production">PM 500 End of Production</option>
																</select>
																<div class="help-block with-errors"></div>
															</div>
															
															<div class="form-group">
																<label class="control-label" for="title">Identificación (Id Equipo):</label>
																<input type="text" name="id_equipo" id="id_equipo" class="form-control" value="{{$rowEquipment->id_equipo}}"" data-error="Please enter title." oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
																<div class="help-block with-errors"></div>
															</div>
	
															<div class="form-group">
																<label class="control-label" for="title">Tipo Equipo:</label>
																<select class="form-control" name="id_type" id="id_type">
																	<option selected value="{{$rowEquipment->type->id}}">{{$rowEquipment->type->name}}</option>
																	@foreach($dataType as $rowtype)
																		<option value="{{$rowtype->id}}">{{$rowtype->name}}</option>
																	@endforeach
																</select>
																<div class="help-block with-errors"></div>
															</div>	
																
															<div class="form-group">
																<label class="control-label" for="title">Sede:</label>
																<select class="form-control" name="id_plant" id="id_plant">
																	<option selected value="{{$rowEquipment->plant->id}}">{{$rowEquipment->plant->name}}</option>
																	@foreach($dataPlant as $rowplant)
																		<option value="{{$rowplant->id}}">{{$rowplant->name}}</option>
																	@endforeach
																</select>
																<div class="help-block with-errors"></div>
															</div>
	
															<div class="form-group">
																<label class="control-label" for="title">Estado:</label>
																<select class="form-control" name="status" id="status">
																	<option selected value="{{$rowEquipment->status}}">{{$rowEquipment->status}}</option>
																	<option value="active">Active</option>
																	<option value="inactive">Inactive</option>
																</select>
																<div class="help-block with-errors"></div>
															</div>
															<div class="form-group">
																<label for="img">Imagen:</label>
																<input type="file" id="img" name="urlImg">
																<p class="help-block">Seleccionar imagen para el equipo, no debe pesar más de 2MB.</p>
															</div>
															<input class="hide" type="text" name="prevImg" value="{{ $rowEquipment->urlImg }}" >
															<div class="form-group">
																<button type="submit" class="btn btn-round crud-submit btn-success">Editar</button>
															</div>
	
														</form>
	
													</div>
												</div>
											</div>
										</div>
									@endif
								@endforeach
							</tbody>
						</table>
						@if(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user()) || Gate::allows('client', Auth::user()))
							<!-- Create Item Modal -->
							<div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Crear Equipo</h4>
										</div>
										<div class="modal-body">
	
											<form data-toggle="validator" action="/equipments" method="POST" enctype="multipart/form-data">
												{{ csrf_field() }}
	
												<div class="form-group">
													<label class="control-label" for="title">TAG ID:</label>
													<input type="text" name="name" id="name" class="form-control" data-error="Please enter title." oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
													<div class="help-block with-errors"></div>
												</div>
												
												<div class="form-group">
													<label class="control-label" for="title">Referencia:</label>
													<input type="text" name="model" id="model" class="form-control" data-error="Please enter title." oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
													<div class="help-block with-errors"></div>
												</div>
												
												<div class="form-group">
													<label class="control-label" for="title">Número de Serie:</label>
													<input type="text" name="serialNumber" id="serialNumber" class="form-control" data-error="Please enter title." oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
													<div class="help-block with-errors"></div>
												</div>
															
												<div class="form-group">
													<label class="control-label" for="title">Potencia:</label>
													<input type="text" name="power" id="power" class="form-control" data-error="Please enter title." oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
													<p>
														W:
														<input type="radio" name="unit" value="W" checked required /> 
														kW:
														<input type="radio" name="unit" value="kW" />
														HP:
														<input type="radio" name="unit" value="HP" />
													</p>
													<div class="help-block with-errors"></div>
												</div>
															
												<div class="form-group">
													<label class="control-label" for="title">Voltaje:</label>
													<input type="text" name="voltage" id="voltage" class="form-control" data-error="Please enter title." oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
													<p>
														V:
														<input type="radio" name="unitvol" value="V" /> 
														kV:
														<input type="radio" name="unitvol" value="kV" />
													</p>
													<div class="help-block with-errors"></div>
												</div>
															
												<div class="form-group">
													<label class="control-label" for="title">Área:</label>
													<input type="text" name="area" id="area" class="form-control" data-error="Please enter title." oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
													<div class="help-block with-errors"></div>
												</div>
															
												<div class="form-group">
													<label class="control-label" for="title">Sub-Área:</label>
													<input type="text" name="subarea" id="subarea" class="form-control" data-error="Please enter title." oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
													<div class="help-block with-errors"></div>
												</div>
														
												<div class="form-group">
													<label class="control-label" for="title">Función:</label>
													<input type="text" name="function" id="function" class="form-control" data-error="Please enter title." oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
													<div class="help-block with-errors"></div>
												</div>
													
												<div class="form-group">
													<label class="control-label" for="title">Ciclo de vida:</label>
													<select class="form-control" name="lifecycle" id="lifecycle">														
														<option value="PM 300 Active">PM 300 Active</option>
														<option value="PM 400 Phase out">PM 400 Phase out</option>
														<option value="PM 410 Cancelation">PM 410 Cancelation</option>
														<option value="PM 490 Discontinuation">PM 490 Discontinuation</option>
														<option value="PM 500 End of Production">PM 500 End of Production</option>
													</select>
													<div class="help-block with-errors"></div>
												</div>
												
												<div class="form-group">
													<label class="control-label" for="title">Identificación (Id Equipo):</label>
													<input type="text" name="id_equipo" id="id_equipo" class="form-control" oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
													<div class="help-block with-errors"></div>
												</div>
	
												<div class="form-group">
													<label class="control-label" for="title">Tipo Equipo:</label>
													<select class="form-control" name="id_type" id="id_type">
														@foreach($dataType as $rowtype)
															<option value="{{$rowtype->id}}">{{$rowtype->name}}</option>
														@endforeach
													</select>
													<div class="help-block with-errors"></div>
												</div>	
													
												<div class="form-group">
													<label class="control-label" for="title">Sede:</label>
													<select class="form-control" name="id_plant" id="id_plant">
														@foreach($dataPlant as $rowplant)
															<option value="{{$rowplant->id}}">{{$rowplant->name}}</option>
														@endforeach
													</select>
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
													<label for="img">Imagen:</label>
													<input type="file" id="img" name="urlImg" required>
													<p class="help-block">Seleccionar imagen para el equipo, no debe pesar más de 2MB. <span class="label label-danger">Campo Obligatorio!</span></p>
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
	</div>
	<!-- /page content -->

@endsection