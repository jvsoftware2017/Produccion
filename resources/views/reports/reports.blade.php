@extends('layouts.app') @section('title', 'DriveSysMonitor | Usuarios')

@section('content')
<!-- page content -->
<div class="right_col" role="main">
	<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Reportes</h2>
						<div class="clearfix"></div>
					</div>
					
					<div class="x_content">
						<p class="text-muted font-13 m-b-30">Por medio de este módulo se mostrarán los Reportes</p>
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
						@if(isset($dataEquipoRep[0]))
						<div align="center" id="logoClient"> 
							<img src="{{ URL::to('/') }}/clientLogo/{{ $dataEquipoRep[1] }}" class="img-responsive" alt="Logo del Cliente" style="max-width: 100px;">
							<input type="hidden" value="{{ URL::to('/') }}/clientLogo/{{ $dataEquipoRep[1] }}" id="urlPath" />
							<input type="hidden" value="{{ $dataEquipoRep[2] }}" id="nameEquipment" />
							<input type="hidden" value="{{ $dataEquipoRep[3] }}" id="serial" />
							<input type="hidden" value="{{ $dataEquipoRep[7] }}" id="power" />
							<input type="hidden" value="{{ $dataEquipoRep[8] }}" id="voltage" />
							<input type="hidden" value="{{ $dataEquipoRep[4] }}" id="area" />
						</div>
						<div align="center"><h4 class="modal-title" id="myModalLabel"> REPORTE EQUIPO <strong>{{$dataEquipoRep[0]}}</strong></h4></div>						
						<input type="hidden" id="id_equipo" value="{{$dataEquipoRep[0]}}"/>
						@else
						<div class="form-group">
							<label class="control-label" for="title">Seleccione Equipo:</label>
							<select class="form-control" name="id_equipoRep" id="id_equipoRep">
								<option>Seleccione</option>
								@foreach($dataEquipo as $rowEquipo)
									@foreach($rowEquipo as $row)
										<option value="{{$row->id_equipo}}">{{$row->name}}</option>
									@endforeach
								@endforeach
							</select>
							<div class="help-block with-errors"></div>
						</div>
						@endif
						<br/>
						<div class="col-md-6 col-sm-6 col-xs-12">
			                <div class="x_panel">
			                	<div class="x_title">
				                    <h2>Current VFD on Fail <small>Cantidad</small></h2>
				                    <ul class="nav navbar-right panel_toolbox">
				                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
				                      <li><a class="close-link"><i class="fa fa-close"></i></a>
				                      </li>
				                    </ul>
				                    <div class="clearfix"></div>
			                  	</div>
			                  	<div class="x_content" id="chartContainerv">
			                    	<canvas id="DP0_current"></canvas>
			                  	</div>
			            	</div>
			            </div>
			            
			            <div class="col-md-6 col-sm-6 col-xs-12">
			                <div class="x_panel">
			                	<div class="x_title">
				                    <h2>Previous VFD on Fail <small>cantidad</small></h2>
				                    <ul class="nav navbar-right panel_toolbox">
				                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
				                      <li><a class="close-link"><i class="fa fa-close"></i></a>
				                      </li>
				                    </ul>
				                    <div class="clearfix"></div>
			                  	</div>
			                  	<div class="x_content">
			                    	<canvas id="DP0_previus"></canvas>
			                  	</div>
			            	</div>
			            </div>
			            

			            <div class="col-md-6 col-sm-6 col-xs-12">
			                <div class="x_panel">
			                  <div class="x_title">
			                    <h2>Current Motor Voltage<small>Volts</small></h2>
			                    <ul class="nav navbar-right panel_toolbox">
			                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			                      </li>
			                      <li><a class="close-link"><i class="fa fa-close"></i></a>
			                      </li>
			                    </ul>
			                    <div class="clearfix"></div>
			                  </div>
			                  <div class="x_content">
			                    <canvas id="DP17_current"></canvas>
			                  </div>
			                </div>
			            </div>
			            <div class="col-md-6 col-sm-6 col-xs-12">
			                <div class="x_panel">
			                  <div class="x_title">
			                    <h2>Previous Motor Voltage<small>Volts</small></h2>
			                    <ul class="nav navbar-right panel_toolbox">
			                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			                      </li>
			                      <li><a class="close-link"><i class="fa fa-close"></i></a>
			                      </li>
			                    </ul>
			                    <div class="clearfix"></div>
			                  </div>
			                  <div class="x_content">
			                    <canvas id="DP17_previus"></canvas>
			                  </div>
			                </div>
			            </div>
			            
			            <div class="col-md-6 col-sm-6 col-xs-12">
			                <div class="x_panel">
			                  <div class="x_title">
			                    <h2>Current Total Current<small>Amps</small></h2>
			                    <ul class="nav navbar-right panel_toolbox">
			                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			                      </li>
			                      <li><a class="close-link"><i class="fa fa-close"></i></a>
			                      </li>
			                    </ul>
			                    <div class="clearfix"></div>
			                  </div>
			                  <div class="x_content">
			                    <canvas id="DP18_current"></canvas>
			                  </div>
			                </div>
			            </div>
			            <div class="col-md-6 col-sm-6 col-xs-12">
			                <div class="x_panel">
			                  <div class="x_title">
			                    <h2>Previous Total Current<small>Amps</small></h2>
			                    <ul class="nav navbar-right panel_toolbox">
			                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			                      </li>
			                      <li><a class="close-link"><i class="fa fa-close"></i></a>
			                      </li>
			                    </ul>
			                    <div class="clearfix"></div>
			                  </div>
			                  <div class="x_content">
			                    <canvas id="DP18_previus"></canvas>
			                  </div>
			                </div>
			            </div>
			            
			            <div class="col-md-6 col-sm-6 col-xs-12">
			                <div class="x_panel">
			                  <div class="x_title">
			                    <h2>Current Output Power<small>kW</small></h2>
			                    <ul class="nav navbar-right panel_toolbox">
			                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			                      </li>
			                      <li><a class="close-link"><i class="fa fa-close"></i></a>
			                      </li>
			                    </ul>
			                    <div class="clearfix"></div>
			                  </div>
			                  <div class="x_content">
			                    <canvas id="DP19_current"></canvas>
			                  </div>
			                </div>
			            </div>
			            <div class="col-md-6 col-sm-6 col-xs-12">
			                <div class="x_panel">
			                  <div class="x_title">
			                    <h2>Previous Output Power<small>kW</small></h2>
			                    <ul class="nav navbar-right panel_toolbox">
			                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			                      </li>
			                      <li><a class="close-link"><i class="fa fa-close"></i></a>
			                      </li>
			                    </ul>
			                    <div class="clearfix"></div>
			                  </div>
			                  <div class="x_content">
			                    <canvas id="DP19_previus"></canvas>
			                  </div>
			                </div>
			            </div>
						
						<div class="col-md-6 col-sm-6 col-xs-12">
			                <div class="x_panel">
			                  <div class="x_title">
			                    <h2>Current Input Voltage<small>Volts</small></h2>
			                    <ul class="nav navbar-right panel_toolbox">
			                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			                      </li>
			                      <li><a class="close-link"><i class="fa fa-close"></i></a>
			                      </li>
			                    </ul>
			                    <div class="clearfix"></div>
			                  </div>
			                  <div class="x_content">
			                    <canvas id="DP30_current"></canvas>
			                  </div>
			                </div>
			            </div>
			            <div class="col-md-6 col-sm-6 col-xs-12">
			                <div class="x_panel">
			                  <div class="x_title">
			                    <h2>Previous Input Voltage<small>Volts</small></h2>
			                    <ul class="nav navbar-right panel_toolbox">
			                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			                      </li>
			                      <li><a class="close-link"><i class="fa fa-close"></i></a>
			                      </li>
			                    </ul>
			                    <div class="clearfix"></div>
			                  </div>
			                  <div class="x_content">
			                    <canvas id="DP30_previus"></canvas>
			                  </div>
			                </div>
			            </div>	     
			            
			            <div class="col-md-6 col-sm-6 col-xs-12">
			                <div class="x_panel">
			                  <div class="x_title">
			                    <h2>Current Input Power Fact.<small>%</small></h2>
			                    <ul class="nav navbar-right panel_toolbox">
			                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			                      </li>
			                      <li><a class="close-link"><i class="fa fa-close"></i></a>
			                      </li>
			                    </ul>
			                    <div class="clearfix"></div>
			                  </div>
			                  <div class="x_content">
			                    <canvas id="DP31_current"></canvas>
			                  </div>
			                </div>
			            </div>
			            <div class="col-md-6 col-sm-6 col-xs-12">
			                <div class="x_panel">
			                  <div class="x_title">
			                    <h2>Previous Input Power Fact.<small>%</small></h2>
			                    <ul class="nav navbar-right panel_toolbox">
			                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			                      </li>
			                      <li><a class="close-link"><i class="fa fa-close"></i></a>
			                      </li>
			                    </ul>
			                    <div class="clearfix"></div>
			                  </div>
			                  <div class="x_content">
			                    <canvas id="DP31_previus"></canvas>
			                  </div>
			                </div>
			            </div>     

						<div class="col-md-6 col-sm-6 col-xs-12">
			                <div class="x_panel">
			                  <div class="x_title">
			                    <h2>Current Input kVARS<small>kVAR</small></h2>
			                    <ul class="nav navbar-right panel_toolbox">
			                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			                      </li>
			                      <li><a class="close-link"><i class="fa fa-close"></i></a>
			                      </li>
			                    </ul>
			                    <div class="clearfix"></div>
			                  </div>
			                  <div class="x_content">
			                    <canvas id="DP32_current"></canvas>
			                  </div>
			                </div>
			            </div>
			            <div class="col-md-6 col-sm-6 col-xs-12">
			                <div class="x_panel">
			                  <div class="x_title">
			                    <h2>Previous Input kVARS<small>kVAR</small></h2>
			                    <ul class="nav navbar-right panel_toolbox">
			                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			                      </li>
			                      <li><a class="close-link"><i class="fa fa-close"></i></a>
			                      </li>
			                    </ul>
			                    <div class="clearfix"></div>
			                  </div>
			                  <div class="x_content">
			                    <canvas id="DP32_previus"></canvas>
			                  </div>
			                </div>
			            </div>
			            
			            <div class="col-md-6 col-sm-6 col-xs-12">
			                <div class="x_panel">
			                  <div class="x_title">
			                    <h2>Current Hottest Cell Temp<small>%</small></h2>
			                    <ul class="nav navbar-right panel_toolbox">
			                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			                      </li>
			                      <li><a class="close-link"><i class="fa fa-close"></i></a>
			                      </li>
			                    </ul>
			                    <div class="clearfix"></div>
			                  </div>
			                  <div class="x_content">
			                    <canvas id="DP34_current"></canvas>
			                  </div>
			                </div>
			            </div>
			            <div class="col-md-6 col-sm-6 col-xs-12">
			                <div class="x_panel">
			                  <div class="x_title">
			                    <h2>Previous Hottest Cell Temp<small>%</small></h2>
			                    <ul class="nav navbar-right panel_toolbox">
			                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			                      </li>
			                      <li><a class="close-link"><i class="fa fa-close"></i></a>
			                      </li>
			                    </ul>
			                    <div class="clearfix"></div>
			                  </div>
			                  <div class="x_content">
			                    <canvas id="DP34_previus"></canvas>
			                  </div>
			                </div>
			            </div>
			            
			            <div class="col-md-6 col-sm-6 col-xs-12">
			                <div class="x_panel">
			                  <div class="x_title">
			                    <h2>Current Temp. Room<small>°C</small></h2>
			                    <ul class="nav navbar-right panel_toolbox">
			                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			                      </li>
			                      <li><a class="close-link"><i class="fa fa-close"></i></a>
			                      </li>
			                    </ul>
			                    <div class="clearfix"></div>
			                  </div>
			                  <div class="x_content">
			                    <canvas id="DP44_current"></canvas>
			                  </div>
			                </div>
			            </div>
			            <div class="col-md-6 col-sm-6 col-xs-12">
			                <div class="x_panel">
			                  <div class="x_title">
			                    <h2>Previous Temp. Room<small>°C</small></h2>
			                    <ul class="nav navbar-right panel_toolbox">
			                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			                      </li>
			                      <li><a class="close-link"><i class="fa fa-close"></i></a>
			                      </li>
			                    </ul>
			                    <div class="clearfix"></div>
			                  </div>
			                  <div class="x_content">
			                    <canvas id="DP44_previus"></canvas>
			                  </div>
			                </div>
			            </div>
			            
			            <div class="col-md-6 col-sm-6 col-xs-12">
			                <div class="x_panel">
			                  <div class="x_title">
			                    <h2>Current Hum. Rel. Room<small>%</small></h2>
			                    <ul class="nav navbar-right panel_toolbox">
			                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			                      </li>
			                      <li><a class="close-link"><i class="fa fa-close"></i></a>
			                      </li>
			                    </ul>
			                    <div class="clearfix"></div>
			                  </div>
			                  <div class="x_content">
			                    <canvas id="DP49_current"></canvas>
			                  </div>
			                </div>
			            </div>
			            <div class="col-md-6 col-sm-6 col-xs-12">
			                <div class="x_panel">
			                  <div class="x_title">
			                    <h2>Previous Hum. Rel. Room<small>%</small></h2>
			                    <ul class="nav navbar-right panel_toolbox">
			                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			                      </li>
			                      <li><a class="close-link"><i class="fa fa-close"></i></a>
			                      </li>
			                    </ul>
			                    <div class="clearfix"></div>
			                  </div>
			                  <div class="x_content">
			                    <canvas id="DP49_previus"></canvas>
			                  </div>
			                </div>
			            </div>
						<span align="left"><button type="button" id="download-pdf" class="btn btn-round btn-success">Descargar Current PDF</button></span> 
						<span align="right"><button type="button" id="download-pdf-previous" class="btn btn-round btn-success">Descargar Previous PDF</button></span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /page content -->
@endsection 
