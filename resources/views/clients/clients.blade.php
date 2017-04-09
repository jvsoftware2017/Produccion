@extends('layouts.app') @section('title', 'Clientes | DriveSysMonitor')

@section('content')
<!-- page content -->
<div class="right_col" role="main">
	<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Administrador de clientes</h2>
						<div class="clearfix"></div>
					</div>
					
					<div class="x_content">
						<p class="text-muted font-13 m-b-30">Por medio de este módulo, puedes ver la información de los clientes.</p>
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
											<h4 class="modal-title" id="myModalLabel">Crear Cliente</h4>
										</div>
										<div class="modal-body">
											<form data-toggle="validator"
												action="/clients" method="POST" enctype="multipart/form-data">
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
													<label class="control-label" for="title">Estado:</label> <select
														class="form-control" name="status" id="status">
														<option value="active">Active</option>
														<option value="inactive">Inactive</option>
													</select>
													<div class="help-block with-errors"></div>
												</div>
												<div class="form-group">
                                                    <label class="control-label" for="maxUsers">Usuarios Máximos:</label>
                                                    <input type="number" id="maxUsers" name="maxUsers" min="1" class="form-control" value="" pattern="[0-9]" data-error="Por favor escribir un número válido" oninvalid="this.setCustomValidity('Por favor escribir un número válido')" oninput="setCustomValidity('')" required>
                                                    <div class="help-block with-errors"></div>
	                                            </div>
	                                            <div class="form-group">
                                                    <label class="control-label" for="validity">Vigencia, en meses:</label>
                                                    <input type="number" id="validity" name="validity" min="1" class="form-control" value="" pattern="[0-9]" data-error="Por favor escribir un número válido" oninvalid="this.setCustomValidity('Por favor escribir un número válido')" oninput="setCustomValidity('')" required>
                                                    <div class="help-block with-errors"></div>
	                                            </div>                                                     
												<div class="form-group">
													<label for="logo">Logo:</label>
													<input type="file" id="logo" name="urlLogo">
													<p class="help-block">Seleccionar el logo del cliente, no debe pesar más de 2MB.</p>
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
									<th>Logo</th>
									<th>Nombre</th>
									<th>Fecha de registro</th>
									<th>Fecha de caducidad</th>
									<th>Estado</th>
									@if(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user()))
										<th>Acción</th>
										<th>Sedes</th>
									@endif
								</tr>
							</thead>
							<tbody>
								@foreach($dataClient as $rowclient)
								@if($rowclient->status == 'inactive')
									<tr class="danger"">
								@else
									<tr>
								@endif
										<td><img src="clientLogo/{{ $rowclient->urlLogo }}" class="img-responsive" alt="Logo del Cliente" style="max-width: 50px;"></td>
										<td>{{ $rowclient->name }}</td>
										<td>{{ $rowclient->created_at }}</td>
										<td>{{ $rowclient->dateValidity }}</td>
										<td>{{ $rowclient->status }}</td>
										@if(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user()))
											<td>
												<!-- Large modal -->
												<div type="button" id="edit-client" class="btn btn-round btn-warning" data-toggle="modal" data-target="#edit-item{{ $rowclient->id }}" >Editar</div>
											</td>
											<td>
											<a href="/nav_plants/{{ $rowclient->id }} "><div type="button" class="btn btn-round btn-success">Sedes</div></a>
											</td>
										@endif
									</tr>
									@if(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user()))
										<!-- Edit Item Modal -->
	                                    <div class="modal fade" id="edit-item{{ $rowclient->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	                                        <div class="modal-dialog" role="document">
	                                            <div class="modal-content">
	                                                <div class="modal-header">
	                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                                                    <h4 class="modal-title" id="myModalLabel">Editar Cliente <strong>{{ $rowclient->name }}</strong></h4>
	                                                </div>
	                                                <div class="modal-body">
	
	                                                    <form data-toggle="validator" action="/clients/{{ $rowclient->id }}" method="POST" enctype="multipart/form-data">
	                                                        {{ csrf_field() }}
															{{ method_field('PUT') }}
															
	                                                        <div class="form-group">
	                                                            <label class="control-label" for="name">Nombre:</label>
	                                                            <input type="text" name="name" id="name" class="form-control" value="{{ $rowclient->name }}" data-error="Por favor escribir un nombre válido" oninvalid="this.setCustomValidity('Por favor escribir un nombre válido')" oninput="setCustomValidity('')" required />
	                                                            <!--<input type="text" name="clientId" class="form-control" data-error="Please enter title." required />-->
	                                                            <div class="help-block with-errors"></div>
	                                                        </div>
	                                                        @if(Gate::allows('developer', Auth::user()))
	                                                        <div class="form-group">
	                                                            <label class="control-label" for="status">Estado:</label>
	                                                            <select class="form-control" name="status" id="status">
	                                                                <option selected value="{{$rowclient->status}}">{{$rowclient->status}}</option>
	                                                                <option value="active">Active</option>
	                                                                <option value="inactive">Inactive</option>
	                                                            </select>
	                                                            <div class="help-block with-errors"></div>
	                                                        </div>
	                                                        <div class="form-group">
	                                                            <label class="control-label" for="maxUsers">Usuarios Máximos:</label>
	                                                            <input type="number" id="maxUsers" name="maxUsers" min="1" class="form-control" value="{{ $rowclient->maxUsers }}" pattern="[0-9]" data-error="Por favor escribir un número válido" oninvalid="this.setCustomValidity('Por favor escribir un número válido')" oninput="setCustomValidity('')" required>
	                                                            <div class="help-block with-errors"></div>
	                                                        </div>
															<div class="form-group">
																<label class="control-label" for="maxUsers">Reset Vigencia:</label>
																	<div class="checkbox">
																		<label>
																			<input type="checkbox" name="resetDateValidity" value="reset"> {{ $rowclient->dateValidity }}
																		</label>
																	</div>
															</div>                                              
															<div class="form-group">
			                                                    <label class="control-label" for="validity">Vigencia, en meses:</label>
			                                                    <input type="number" id="validity" name="validity" min="1" class="form-control" value="{{ $rowclient->validity }}" pattern="[0-9]" data-error="Por favor escribir un número válido" oninvalid="this.setCustomValidity('Por favor escribir un número válido')" oninput="setCustomValidity('')" required>
			                                                    <div class="help-block with-errors"></div>
			                                            	</div>
			                                            	@endif
	                                                        <div class="form-group">
																<label for="logo">Logo:</label>
																<input type="file" id="logo" name="urlLogo">
																<p class="help-block">Seleccionar el logo del cliente, no debe pesar más de 2MB.</p>
															</div>
															<input class="hide" type="text" name="prevLogo" value="{{ $rowclient->urlLogo }}" >
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
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /page content -->

@endsection 
