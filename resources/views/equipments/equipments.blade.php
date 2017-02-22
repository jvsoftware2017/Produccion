@extends('layouts.app') @section('title', 'Equipos')

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
						@if(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user()))
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
								<th>Id</th>
								<th>Nombre</th>
								<th>Tipo</th>
								<th>Planta</th>
								<th>Modelo</th>
								<th>Ultimo Evento</th>
								<th>Fecha registro</th>
								<th>Fecha modificación</th>
								<th>Estado</th>
								@if(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user()))
									<th>Acción</th>
								@endif
							</tr>
							</thead>
							<tbody>
								@foreach($dataEquipment as $rowEquipment)
									@if($rowEquipment->status == 'inactive')
										<tr style="background-color: #953b39;color: white">
									@else
										<tr>
									@endif
											<td>{{ $rowEquipment->id }}</td>
											<td>{{ $rowEquipment->name }}</td>
											<td>{{ $rowEquipment->type->name }}</td>
											<td>{{ $rowEquipment->plant->name }}</td>
											<td>{{ $rowEquipment->model }}</td>
											<td>{{ $rowEquipment->last_event }}</td>
											<td>{{ $rowEquipment->created_at }}</td>
											<td>{{ $rowEquipment->updated_at }}</td>
											<td>{{ $rowEquipment->status }}</td>
											@if(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user()))
												<td>
													<!-- Large modal -->
													<div type="button" id="edit-client" class="btn btn-round btn-warning" data-toggle="modal" data-target="#edit-item{{ $rowEquipment->id }}" >Editar</div>
												</td>
											@endif
										</tr>
									@if(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user()))
										<!-- Edit Item Modal -->
										<div class="modal fade" id="edit-item{{$rowEquipment->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														<h4 class="modal-title" id="myModalLabel">Editar Equipo <strong>{{ $rowEquipment->name }}</strong></h4>
													</div>
													<div class="modal-body">
	
														<form data-toggle="validator" action="/equipments/{{$rowEquipment->id}}" method="POST">
															{{ csrf_field() }}
															{{ method_field('PUT') }}
															<div class="form-group">
																<label class="control-label" for="title">Nombre:</label>
																<input type="text" name="name" id="name" class="form-control" value="{{$rowEquipment->name}}" data-error="Please enter title." oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
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
																<label class="control-label" for="title">Modelo:</label>
																<input type="text" name="model" id="model" class="form-control" value="{{$rowEquipment->model}}"" data-error="Please enter title." oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
																<div class="help-block with-errors"></div>
															</div>
	
															<div class="form-group">
																<label class="control-label" for="title">Planta:</label>
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
						@if(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user()))
							<!-- Create Item Modal -->
							<div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Crear Equipo</h4>
										</div>
										<div class="modal-body">
	
											<form data-toggle="validator" action="/equipments" method="POST">
												{{ csrf_field() }}
	
												<div class="form-group">
													<label class="control-label" for="title">Nombre:</label>
													<input type="text" name="name" id="name" class="form-control" data-error="Please enter title." oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
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
													<label class="control-label" for="title">Modelo:</label>
													<input type="text" name="model" id="model" class="form-control" data-error="Please enter title." oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
													<div class="help-block with-errors"></div>
												</div>
	
												<div class="form-group">
													<label class="control-label" for="title">Planta:</label>
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