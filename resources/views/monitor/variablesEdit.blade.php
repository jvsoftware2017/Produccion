@extends('layouts.app') 
@section('title', 'Variables | DriveSysMonitor')

@section('content')
	<!-- page content -->
	<div class="right_col" role="main">
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Editar Variables</h2>
						<div class="clearfix"></div>
					</div>

					<div class="x_content">
						<p class="text-muted font-13 m-b-30">Por medio de este módulo, puedes editar las variables que permiten escritura</p>
						<p align="right">
							<a href="/monitor" class="btn btn-default">Volver</a>
						</p>
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
						
								@foreach($variablesWrite as $rowEquipo)
										<!-- Edit table -->
										<div id="edit-item" tabindex="-1">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h4 class="modal-title" id="myModalLabel">Editar Variables del Equipo <strong>{{ $rowEquipo->NOMBRE_EQUIPO }}</strong></h4>
													</div>
													<div class="modal-body">
	
														<form data-toggle="validator" action="/equipos/{{$rowEquipo->ID_EQUIPO}}" method="POST" enctype="multipart/form-data">
															{{ csrf_field() }}
															{{ method_field('PUT') }}
															<div class="form-group">
																<label class="control-label" for="title">TAG_ID:</label>
																<input type="text" name="idequipo" id="idequipo" readonly="readonly" class="form-control" value="{{$rowEquipo->ID_EQUIPO}}" data-error="Please enter title." oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
																<div class="help-block with-errors"></div>
															</div>
															
															<div class="form-group">
																<label class="control-label" for="title">Horas Operación limite HH (Hrs)</label>
																<input type="text" name="dp41" id="dp41" class="form-control" value="{{$rowEquipo->DP_41}}" data-error="Please enter title." oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
																<div class="help-block with-errors"></div>
															</div>
															
															<div class="form-group">
																<label class="control-label" for="title">Horas Operación limite H (Hrs)</label>
																<input type="text" name="dp42" id="dp42" class="form-control" value="{{$rowEquipo->DP_42}}" data-error="Please enter title." oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
																<div class="help-block with-errors"></div>
															</div>
															
															<div class="form-group">
																<label class="control-label" for="title">Horas Operación delta de aviso (Hrs)</label>
																<input type="text" name="dp43" id="dp43" class="form-control" value="{{$rowEquipo->DP_43}}" data-error="Please enter title." oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
																<div class="help-block with-errors"></div>
															</div>	
															
															<div class="form-group">
																<label class="control-label" for="title">Temperatura cuarto limite HH (°C)</label>
																<input type="text" name="dp45" id="dp45" class="form-control" value="{{$rowEquipo->DP_45}}" data-error="Please enter title." oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
																<div class="help-block with-errors"></div>
															</div>
															
															<div class="form-group">
																<label class="control-label" for="title">Temperatura cuarto limite H (°C)</label>
																<input type="text" name="dp46" id="dp46" class="form-control" value="{{$rowEquipo->DP_46}}" data-error="Please enter title." oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
																<div class="help-block with-errors"></div>
															</div>
															
															<div class="form-group">
																<label class="control-label" for="title">Temperatura cuarto limite LL (°C)</label>
																<input type="text" name="dp47" id="dp47" class="form-control" value="{{$rowEquipo->DP_47}}" data-error="Please enter title." oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
																<div class="help-block with-errors"></div>
															</div>
															
															<div class="form-group">
																<label class="control-label" for="title">Temperatura cuarto limite L (°C)</label>
																<input type="text" name="dp48" id="dp48" class="form-control" value="{{$rowEquipo->DP_48}}" data-error="Please enter title." oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
																<div class="help-block with-errors"></div>
															</div>
															
															<div class="form-group">
																<label class="control-label" for="title">Humedad Relativa limite HH (%)</label>
																<input type="text" name="dp50" id="dp50" class="form-control" value="{{$rowEquipo->DP_50}}" data-error="Please enter title." oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
																<div class="help-block with-errors"></div>
															</div>
															
															<div class="form-group">
																<label class="control-label" for="title">Humedad Relativa limite H (%)</label>
																<input type="text" name="dp51" id="dp51" class="form-control" value="{{$rowEquipo->DP_51}}" data-error="Please enter title." oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
																<div class="help-block with-errors"></div>
															</div>	
															
															<div class="form-group">
																<label class="control-label" for="title">Humedad Relativa limite LL (%)</label>
																<input type="text" name="dp52" id="dp52" class="form-control" value="{{$rowEquipo->DP_52}}" data-error="Please enter title." oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
																<div class="help-block with-errors"></div>
															</div>
															
															<div class="form-group">
																<label class="control-label" for="title">Humedad Relativa limite L (%)</label>
																<input type="text" name="dp53" id="dp53" class="form-control" value="{{$rowEquipo->DP_53}}" data-error="Please enter title." oninvalid="this.setCustomValidity('Campo requerido')" oninput="setCustomValidity('')" required />
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
								@endforeach					
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	<!-- /page content -->

@endsection