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
						@if(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user()))
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
						@if(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user()))
							<!-- Create Item Modal -->
							<div class="modal fade" id="create-item"
								tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal"
												aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel">Crear Usuario</h4>
										</div>
										<div class="modal-body">
		
											<form data-toggle="validator"
												action="/users" method="POST">
												{{ csrf_field() }}
												<div class="form-group">
													<label class="control-label" for="name">Nombre:</label> <input
														type="text" name="name" id="name" class="form-control"
														value=""
														data-error="Por favor escribir un nombre válido"
														oninvalid="this.setCustomValidity('Por favor escribir un nombre válido')"
														oninput="setCustomValidity('')" placeholder="Nombre" required />
													<div class="help-block with-errors"></div>
												</div>
												<div class="form-group">
													<label class="control-label" for="email">Email:</label> <input
														type="email" name="email" id="email" class="form-control"
														value=""
														data-error="Por favor escribir un email válido"
														oninvalid="this.setCustomValidity('Por favor escribir un email válido')"
														oninput="setCustomValidity('')" placeholder="Email" required />
													<div class="help-block with-errors"></div>
												</div>
												<div class="form-group">
													<label class="control-label" for="client">Cliente:</label> <select
														class="form-control" name="id_client" id="client">
														@foreach($dataClient as $rowclient)
														<option value="{{$rowclient->id}}">{{$rowclient->name}}</option>
														@endforeach
													</select>
													<div class="help-block with-errors"></div>
												</div>
												<div class="form-group">
													<label class="control-label" for="role">Role:</label> <select
														class="form-control" name="id_role" id="role">
														@foreach($dataRole as $rowrole)
															@if($rowrole->description != 'developer')
																<option value="{{$rowrole->id}}">{{$rowrole->description}}</option>
															@else
																@if(Gate::allows('developer', Auth::user()))
																	<option value="{{$rowrole->id}}">{{$rowrole->description}}</option>
																@endif
															@endif
														@endforeach
													</select>
													<div class="help-block with-errors"></div>
												</div>
												<div class="form-group">
													<label class="control-label" for="title">Estado:</label> <select
														class="form-control" name="status" id="status">
														<option value="active">Activo</option>
														<option value="inactive">Inactivo</option>
													</select>
													<div class="help-block with-errors"></div>
												</div>
												<div class="form-group">
							                        <label for="password" class="control-label">Password:</label>
							                        <input id="password" type="password" name="password" data-validate-length="6,8" class="form-control" placeholder="Mínimo 6 caracteres" required="required">
						                     		<div class="help-block with-errors"></div>
						                     	</div>
												<div class="form-group">
													<button type="submit" class="btn btn-round crud-submit btn-success">Crear</button>
													
												</div>
											</form>
										</div>
									</div>
								</div>
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
									<th>Modificado</th>
									<th>Último Acceso</th>
									<th>Estado</th>
									@if(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user()))
										<th>Acción</th>
									@endif
								</tr>
							</thead>
							<tbody>
								@foreach($dataUser as $rowuser)
									@if(($rowuser->id_role == 1 && Auth::user()->id_role == 1) || ($rowuser->id_role != 1 && Auth::user()->id_role == 1) || !($rowuser->id_role == 1 && Auth::user()->id_role != 1) || ($rowuser->id_role != 1 && Auth::user()->id_role != 1))
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
									<td>{{ $rowuser->last_login }}</td>
									<td>{{ $rowuser->status }}</td>
									@if(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user()))
										<td>
											<!-- Large modal -->
											<div type="button" id="edit-client" class="btn btn-round btn-warning" data-toggle="modal" data-target="#edit-item{{ $rowuser->id }}" >Editar</div>
											@if($rowuser->status == 'active')
											<div type="button" id="access-user" class="btn btn-round btn-dark" data-toggle="modal" data-target="#access-item{{ $rowuser->id }}" >Acceso</div>
											@endif
										</td>											
									@endif
									</tr>
									@if(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user()))
										<!-- Edit Item Modal -->
	                                    <div class="modal fade" id="edit-item{{ $rowuser->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	                                        <div class="modal-dialog" role="document">
	                                            <div class="modal-content">
	                                                <div class="modal-header">
	                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                                                    <h4 class="modal-title" id="myModalLabel">Editar Cliente <strong>{{ $rowuser->name }}</strong></h4>
	                                                </div>
	                                                <div class="modal-body">
	
	                                                    <form data-toggle="validator" action="/users/{{ $rowuser->id }}" method="POST">
	                                                        {{ csrf_field() }}
															{{ method_field('PUT') }}
															
	                                                        <div class="form-group">
	                                                            <label class="control-label" for="name">Nombre:</label>
	                                                            <input type="text" name="name" id="name" class="form-control" value="{{ $rowuser->name }}" data-error="Por favor escribir un nombre válido" oninvalid="this.setCustomValidity('Por favor escribir un nombre válido')" oninput="setCustomValidity('')" required />
	                                                            <!--<input type="text" name="clientId" class="form-control" data-error="Please enter title." required />-->
	                                                            <div class="help-block with-errors"></div>
	                                                        </div>
	                                                        <div class="form-group">
	                                                            <label class="control-label" for="email">Email:</label>
	                                                            <input type="email" name="email" id="email" class="form-control" value="{{ $rowuser->email }}" data-error="Por favor escribir un email válido" oninvalid="this.setCustomValidity('Por favor escribir un email válido')" oninput="setCustomValidity('')" required />
	                                                            <div class="help-block with-errors"></div>
	                                                        </div>
	                                                        <div class="form-group">
	                                                            <label class="control-label" for="client">Cliente:</label>
	                                                            <select class="form-control" name="id_client" id="client">
	                                                                    <option selected value="{{$rowuser->client->id}}">{{$rowuser->client->name}}</option>
	                                                                @foreach($dataClient as $rowclient)
	                                                                 <option value="{{$rowclient->id}}">{{$rowclient->name}}</option>  
	                                                                @endforeach 
	                                                            </select>
	                                                            <div class="help-block with-errors"></div>
	                                                        </div>
	                                                        <div class="form-group">
	                                                            <label class="control-label" for="role">Role:</label>
	                                                            <select class="form-control" name="id_role" id="role">
	                                                                    <option selected value="{{$rowuser->role->id}}">{{$rowuser->role->description}}</option>
	                                                                @foreach($dataRole as $rowrole)
	                                                                	@if($rowrole->description != 'developer')
																			<option value="{{$rowrole->id}}">{{$rowrole->description}}</option>
																		@else
																			@if(Gate::allows('developer', Auth::user()))
																				<option value="{{$rowrole->id}}">{{$rowrole->description}}</option>
																			@endif
																		@endif  
	                                                                @endforeach 
	                                                            </select>
	                                                            <div class="help-block with-errors"></div>
	                                                        </div>
	                                                        <div class="form-group">
	                                                            <label class="control-label" for="title">Estado:</label>
	                                                            <select class="form-control" name="status" id="status">
	                                                                <option selected value="{{$rowuser->status}}">{{$rowuser->status}}</option>
	                                                                <option value="active">Activo</option>
	                                                                <option value="inactive">Inactivo</option>
	                                                            </select>
	                                                            <div class="help-block with-errors"></div>
	                                                        </div>
	                                                        <div class="form-group">
										                        <label for="password" class="control-label">Password:</label>
										                        <input id="password" type="password" name="password" data-validate-length="6,8" class="form-control" placeholder="Mínimo 6 caracteres">
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
																<label class="control-label" for="name">Planta</label>
																<select class="form-control" name="id_plant" id="plant">
																	<@foreach($dataPlant as $rowplant)
																		@if($rowuser->client->id == $rowplant->id_client && $rowplant->status == 'active')
																			<option value="{{$rowplant->id}}">{{$rowplant->name}}</option>
																		@endif
																	@endforeach
																</select>
																<div class="help-block with-errors"></div>
															</div>
															<div class="form-group">
																<label class="control-label" for="equipment">Seleciones Equipos</label>
																<select class="select2_multiple form-control" multiple="multiple">
																	<option>Choose option</option>
																	<option>Option one</option>
																	<option>Option two</option>
																	<option>Option three</option>
																	<option>Option four</option>
																	<option>Option five</option>
																	<option>Option six</option>
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
