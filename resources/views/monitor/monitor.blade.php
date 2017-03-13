@extends('layouts.app')
@section('title', 'Monitor')
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        {{ csrf_field() }}
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Monitor</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="text-muted font-13 m-b-30">
                            Aquí podrás visualizar el estado de los equipos a los cuales tienes permiso
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
                                <th>Id Equipo</th>
                                <th>Nombre</th>
                                <th>Planta</th>
                                <th>Estado</th>
                                <th>DP_1</th>
                                <th>DP_2</th>
                                <th>DP_3</th>
                                <th>DP_4</th>
                                @if(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user()))
                                	<th>Acción</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
	                            @foreach($dataEquipo as $row)
		                            @foreach($row as $rowmonitor)  
										@if($rowmonitor->equipo->ESTADO_EQUIPO != 'ok')
											<tr class="danger"">
										@else
											<tr>
										@endif
		                                <td>{{$rowmonitor->equipo->ID_EQUIPO}}</td>
		                                <td>{{$rowmonitor->equipo->NOMBRE_EQUIPO}}</td>
		                                <td>{{$rowmonitor->plant->name}}</td>
		                                <td>{{$rowmonitor->equipo->ESTADO_EQUIPO}}</td>
		                                <td>{{chr(ord($rowmonitor->equipo->DP_1))}}</td>
		                                <td>{{chr(ord($rowmonitor->equipo->DP_2))}}</td>
		                                <td>{{chr(ord($rowmonitor->equipo->DP_3))}}</td>
		                                <td>{{(($rowmonitor->equipo->DP_4))}}</td>		                                
			                                <td>
			                                <button data-toggle="modal" data-target="#edit-item{{$rowmonitor->equipo->ID_EQUIPO}}" class="btn btn-round btn-warning edit-item">Ver</button>
			                                
			                                <!-- Edit Item Modal -->
			                                <div class="modal fade" id="edit-item{{$rowmonitor->equipo->ID_EQUIPO}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			                                    <div class="modal-dialog" role="document">
			                                        <div class="modal-content">
			                                            <div class="modal-header">
			                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			                                                <h4 class="modal-title" id="myModalLabel">Estado monitor <strong>{{ $rowmonitor->equipo->MODELO_EQUIPO." - ".$rowmonitor->equipo->NOMBRE_EQUIPO }}</strong></h4>
			                                            </div>
			                                            <div class="modal-body">                 
			                                                
			                                                <table align="center" style="border-collapse:separate;border-spacing:15px;" border="0">
															  <tr>
															    <td align="right">Run FW <canvas id="circle{{chr(htmlspecialchars($rowmonitor->equipo->DP_2))}}"></canvas> </td>
															    <th rowspan="6">
															    <div align="center"> <img alt="Equipo {{ $rowmonitor->equipo->NOMBRE_EQUIPO }}" src="equipmentImg/{{ $rowmonitor->urlImg }}" class="img-responsive"> </div>
															    </th>
															    <td align="right">Comunicación OK <canvas id="circle0"></canvas></td>
															  </tr>
															  <tr>
															    <td align="right">Run BW <canvas id="circle{{chr(ord($rowmonitor->equipo->DP_3))}}"></canvas></td>
															    <td align="right">Operation Hrs: <strong style="font-size: 16px">{{chr(ord($rowmonitor->equipo->DP_40))}}</strong></td>
															  </tr>
															  <tr>
															    <td align="right">READY <canvas id="circle{{chr(ord($rowmonitor->equipo->DP_4))}}"></canvas></td>
															    <td align="right">Next Mantenaince: <strong style="font-size: 16px">{{chr(ord($rowmonitor->equipo->DP_39))}}</strong></td>
															  </tr>
															  <tr>
															    <td align="right">At Speed Ref <canvas id="circle{{chr(ord($rowmonitor->equipo->DP_7))}}"></canvas></td>
															    <td align="right">Temperature: <strong style="font-size: 16px">{{chr(ord($rowmonitor->equipo->DP_44))}}</strong></td>
															  </tr>
															  <tr>
															    <td align="right">Warning <canvas id="circle{{chr(ord($rowmonitor->equipo->DP_1))}}"></canvas></td>
															    <td align="right">Humidity: <strong style="font-size: 16px">{{chr(ord($rowmonitor->equipo->DP_49))}}</strong></td>
															  </tr>
															  <tr>
															    <td align="right">Flaut <canvas id="circle{{chr(ord($rowmonitor->equipo->DP_0))}}"></canvas></td>
															    <td align="right">Velocidad: <strong style="font-size: 16px">{{chr(ord($rowmonitor->equipo->DP_16))}}</strong></td>
															  </tr>
															  <tr>
															    <td align="center"></td>
															    <td align="center"></td>
															    <td align="center"></td>
															  </tr>
															  <tr style="background-color: red;color: white; font-size: 14px;">
															    <td align="center">Fecha</td>
															    <td align="center">Evento</td>
															    <td align="center">Tipo</td>
															  </tr>
															</table>
			                                            </div>
			                                        </div>
			                                    </div>
			                                </div>
			                        	</td>
		                                </tr>       
		                            @endforeach
	                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
