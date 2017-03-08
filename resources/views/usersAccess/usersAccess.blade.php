@extends('layouts.app') @section('title', 'Usuarios')

@section('content')
<!-- page content -->
<div class="right_col" role="main">
	<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Administrador de Usuarios</h2>
						<div class="clearfix"></div>
					</div>
					
					<div class="x_content">
						<p class="text-muted font-13 m-b-30">Por medio de este módulo, puedes crear y editar Usuarios.</p>
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
									<th>E-mail</th>
									<th>Cliente</th>
									<th>Role</th>
									<th>Creado</th>
									<th>Último Acceso</th>
									<th>Estado</th>
									@if(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user()))
										<th>Acción</th>
									@endif
								</tr>
							</thead>
							<tbody>
								@foreach($dataUser as $rowuser)
								@if($rowuser->status == 'inactive')
									<tr style="background-color: #953b39;color: white">
								@else
									<tr>
								@endif
										<td>{{ $rowuser->id }}</td>
										<td>{{ $rowuser->name }}</td>
										<td>{{ $rowuser->email }}</td>
										<td>{{ $rowuser->client->name }}</td>
										<td>{{ $rowuser->role->description }}</td>
										<td>{{ $rowuser->created_at }}</td>
										<td>{{ $rowuser->updated_at }}</td>
										<td>{{ $rowuser->status }}</td>
										@if(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user()))
											<td>
												<!-- Large modal -->
												@if($rowuser->status == 'active')
													<div type="button" id="access-user" class="btn btn-round btn-dark" data-toggle="modal" data-target="#access-item{{ $rowuser->id }}" >Acceso</div>
												@endif
											</td>

										@endif
									</tr>
									@if(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user()))
										<!-- Access Item Modal -->
										<div class="modal fade" id="access-item{{ $rowuser->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														<h4 class="modal-title" id="myModalLabel">Asignar permisos a <strong>{{ $rowuser->name }}</strong></h4>
													</div>
													<div class="modal-body">

														<form data-toggle="validator" action="/users_access/{{ $rowuser->id }}" method="POST">
															{{ csrf_field() }}
															{{ method_field('PUT') }}

															<div class="form-group">
																<label class="control-label" for="plant">Planta</label>
																<select class="form-control" name="us_plant" id="us_plant">
																	<@foreach($dataPlant as $rowplant)
																		@if($rowuser->client->id == $rowplant->id_client && $rowplant->status == 'active')
																			<option value="{{$rowplant->id}}">{{$rowplant->name}}</option>
																		@endif
																	@endforeach
																</select>
																<div class="help-block with-errors"></div>
															</div>
															<div class="form-group">
																<label class="control-label" for="equipment">Equipo</label>
																<!--<select class="select2_multiple form-control" multiple="multiple">
																	<option>Choose option</option>
																	<option>Option one</option>
																	<option>Option two</option>
																	<option>Option three</option>
																	<option>Option four</option>
																	<option>Option five</option>
																	<option>Option six</option>
																</select>-->
																<select class="form-control" name="us_equipment" id="us_equipment">
																	<option>Seleccione</option>
																</select>
																<div class="help-block with-errors"></div>
															</div>
															<div class="form-group">
																<button type="submit" class="btn btn-round crud-submit btn-success">Asignar</button>
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
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /page content -->

@endsection 
