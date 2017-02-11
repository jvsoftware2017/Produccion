@extends('layouts.app') @section('title', 'Clientes')

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
					<div class="x_content">
						<p class="text-muted font-13 m-b-30">Por medio de este módulo, puedes crear y editar clientes.</p>
						<button type="button" id="create-client" class="btn btn-round btn-success" data-toggle="modal" data-target="#create-item">Crear</button>
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
										action="/clients" method="POST">
										{{ csrf_field() }}
										<div class="form-group">
											<label class="control-label" for="name">Nombre:</label> <input
												type="text" name="name" id="name" class="form-control"
												value=""
												data-error="Por favor escribir un nombre válido"
												oninvalid="this.setCustomValidity('Campo requerido')"
												oninput="setCustomValidity('')" placeholder="Nombre" required />
											<div class="help-block with-errors"></div>
										</div>
										<div class="form-group">
											<label class="control-label" for="email">Email:</label> <input
												type="email" name="email" id="email" class="form-control"
												value=""
												data-error="Por favor escribir un email válido"
												oninvalid="this.setCustomValidity('Campo requerido')"
												oninput="setCustomValidity('')" placeholder="Email" required />
											<div class="help-block with-errors"></div>
										</div>
										<div class="form-group">
											<label class="control-label" for="phone">Teléfono:</label> <input
												type="tel" name="phone" id="phone" class="form-control"
												value=""
												data-error="Por favor escribir un Teléfono válido"
												oninvalid="this.setCustomValidity('Campo requerido')"
												oninput="setCustomValidity('')" placeholder="Teléfono" required />
											<div class="help-block with-errors"></div>
										</div>
										<div class="form-group">
											<label class="control-label" for="adress">Dirección:</label>
											<input type="text" name="adress" id="adress"
												class="form-control" value=""
												data-error="Por favor escribir una Dirección válida"
												oninvalid="this.setCustomValidity('Campo requerido')"
												oninput="setCustomValidity('')" placeholder="Teléfono" required />
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
											<button type="submit" class="btn crud-submit btn-success">Crear</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Id</th>
									<th>Nombre</th>
									<th>E-mail</th>
									<th>Teléfono</th>
									<th>Dirección</th>
									<th>Ciudad</th>
									<th>Fecha de registro</th>
									<th>Fecha de modificación</th>
									<th>Estado</th>
									<th>Acción</th>
								</tr>
							</thead>
							<tbody>
								@foreach($dataClient as $rowclient)
								<tr>
									<td>{{ $rowclient->id }}</td>
									<td>{{ $rowclient->name }}</td>
									<td>{{ $rowclient->email }}</td>
									<td>{{ $rowclient->phone }}</td>
									<td>{{ $rowclient->adress }}</td>
									<td>{{ $rowclient->city->name }}</td>
									<td>{{ $rowclient->created_at }}</td>
									<td>{{ $rowclient->updated_at }}</td>
									<td>{{ $rowclient->status }}</td>
									<td>
										<!-- Large modal -->
										<div type="button" id="edit-client" class="btn btn-round btn-warning" data-toggle="modal" data-target="#edit-item{{ $rowclient->id }}" >Editar</div>
									</td>
								</tr>
								<!-- Create Item Modal -->
                                    <div class="modal fade" id="edit-item{{ $rowclient->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">Editar Cliente <strong>{{ $rowclient->name }}</strong></h4>
                                                </div>
                                                <div class="modal-body">

                                                    <form data-toggle="validator" action="/clients/{{ $rowclient->id }}" method="POST">
                                                        {{ csrf_field() }}
														{{ method_field('PUT') }}
														
                                                        <div class="form-group">
                                                            <label class="control-label" for="name">Nombre:</label>
                                                            <input type="text" name="name" id="name" class="form-control" value="{{ $rowclient->name }}" data-error="Por favor escribir un nombre válido" oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
                                                            <!--<input type="text" name="clientId" class="form-control" data-error="Please enter title." required />-->
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="email">Email:</label>
                                                            <input type="email" name="email" id="email" class="form-control" value="{{ $rowclient->email }}" data-error="Por favor escribir un email válido" oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="phone">Teléfono:</label>
                                                            <input type="tel" name="phone" id="phone" class="form-control" value="{{ $rowclient->phone }}" data-error="Por favor escribir un Teléfono válido" oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="adress">Dirección:</label>
                                                            <input type="text" name="adress" id="adress" class="form-control" value="{{ $rowclient->adress }}" data-error="Por favor escribir una Dirección válida" oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="title">Estado:</label>
                                                            <select class="form-control" name="status" id="status">
                                                                <option selected value="{{$rowclient->status}}">{{$rowclient->status}}</option>
                                                                <option value="active">Active</option>
                                                                <option value="inactive">Inactive</option>
                                                            </select>
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" class="btn crud-submit btn-success">Editar</button>
                                                        </div>

                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
