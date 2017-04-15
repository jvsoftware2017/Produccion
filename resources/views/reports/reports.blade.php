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
						@if(isset($equipo))
						<div align="center"><h4 class="modal-title" id="myModalLabel"> REPORTE EQUIPO <strong>{{$equipo}}</strong></h4></div>						
						<input type="hidden" id="id_equipo" value="{{$equipo}}"/>
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
				                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
				                      </li>
				                      <li class="dropdown">
				                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
				                        <ul class="dropdown-menu" role="menu">
				                          <li><a href="#">Settings 1</a>
				                          </li>
				                          <li><a href="#">Settings 2</a>
				                          </li>
				                        </ul>
				                      </li>
				                      <li><a class="close-link"><i class="fa fa-close"></i></a>
				                      </li>
				                    </ul>
				                    <div class="clearfix"></div>
			                  	</div>
			                  	<div class="x_content">
			                    	<canvas id="DP0_current"></canvas>
			                  	</div>
			            	</div>
			            </div>
			            
			            <div class="col-md-6 col-sm-6 col-xs-12">
			                <div class="x_panel">
			                	<div class="x_title">
				                    <h2>Previus VFD on Fail <small>cantidad</small></h2>
				                    <ul class="nav navbar-right panel_toolbox">
				                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
				                      </li>
				                      <li class="dropdown">
				                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
				                        <ul class="dropdown-menu" role="menu">
				                          <li><a href="#">Settings 1</a>
				                          </li>
				                          <li><a href="#">Settings 2</a>
				                          </li>
				                        </ul>
				                      </li>
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
			                    <h2>Previus Motor Voltage<small>Volts</small></h2>
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
			                    <h2>Previus Total Current<small>Amps</small></h2>
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
			                    <h2>Previus Output Power<small>kW</small></h2>
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
			                    <h2>Previus Input Voltage<small>Volts</small></h2>
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
			                    <h2>Previus Input Power Fact.<small>%</small></h2>
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
			                    <h2>Previus Input kVARS<small>kVAR</small></h2>
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
			                    <h2>Previus Hottest Cell Temp<small>%</small></h2>
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
			                    <h2>Previus Temp. Room<small>°C</small></h2>
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
			                    <h2>Previus Hum. Rel. Room<small>%</small></h2>
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

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /page content -->
@endsection 
