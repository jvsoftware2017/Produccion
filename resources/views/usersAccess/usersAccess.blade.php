@extends('layouts.app') @section('title', 'DriveSysMonitor | Usuarios')

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
						@if(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user()) || Gate::allows('client', Auth::user()))
							<p align="right">
								<button type="button" id="create-client" class="btn btn-round btn-success" data-toggle="modal" data-target="#create-item">Crear</button>
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
									<th>Cliente</th>	
									<th>Usuario</th>
									<th>Email(Username)</th>									
									<th>Equipo</th>
									<th>Fecha Asignación</th>
									@if(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user()) || Gate::allows('client', Auth::user()))
										<th>Acción</th>
									@endif
								</tr>
							</thead>
							<tbody>
								@foreach($dataUserAccess as $rowUserAccess)
									@if($rowUserAccess->status == 'inactive')
										<tr style="background-color: #953b39;color: white">
									@else
										<tr>
									@endif
										<td>{{ $rowUserAccess->id }}</td>
										<td>{{ $rowUserAccess->user->client->name }}</td>
										<td>{{ $rowUserAccess->user->name }}</td>
										<td>{{ $rowUserAccess->user->email }}</td>										
										<td>{{ $rowUserAccess->equipment->name }}</td>
										<td>{{ $rowUserAccess->created_at }}</td>
										@if(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user()) || Gate::allows('client', Auth::user()))
											<td>
												<a href="/user-accessDelete/{{ $rowUserAccess->id }}"><button class="btn btn-round btn-dark" onclick="return confirm('¿Desea eliminar el Acceso?')">Eliminar</button></a>
											</td>

										@endif
									</tr>
								@endforeach
							</tbody>
							@if(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user()) || Gate::allows('client', Auth::user()))
										<!-- Create Access Item Modal -->
										<div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														<h4 class="modal-title" id="myModalLabel">Asignar acceso Usuario-Equipo</h4>
													</div>
													<div class="modal-body">

													<form data-toggle="validator" action="/user-access" method="POST">
													{{ csrf_field() }}
															
															<div class="form-group">
																<label class="control-label" for="plant">Usuario</label>
																<select class="form-control" name="id_user" id="id_user">
																<option value="">Seleccione</option>
																	@foreach($dataUser as $rowuser)
																			<option value="{{$rowuser->id}}">{{$rowuser->name}} ({{$rowuser->email}})</option>
																	@endforeach
																</select>
																@foreach($dataUser as $rowuser)
																	<input type="hidden" id="id_plant{{$rowuser->id}}" value="{{$rowuser->id_plant}}"/>
																@endforeach
																<div class="help-block with-errors"></div>
															</div>
															<div class="form-group">
																<label class="control-label" for="equipment">Equipo</label>
																<select class="form-control" name="id_equipment" id="id_equipment">
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
                                    </table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /page content -->

@endsection 
