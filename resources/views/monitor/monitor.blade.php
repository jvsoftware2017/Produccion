@extends('layouts.app')
@section('title', 'Monitor')
@section('content')
    <!-- page content -->
<style>
#table_container_left {
	width: 60%;
	height: 100%;
	position: inherit;
	float: left;
	overflow: hidden;
}

#table_container_right {
	width: 40%;
	height: 100%;
	overflow: scroll;
	float: left;
	position: inherit;
}
</style>
    <div class="right_col" role="main" id="datatablemon">
        {{ csrf_field() }}
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Monitor</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content"  >
                        <div class="text-muted font-13 m-b-30">
                            Aquí podrás visualizar el estado de los equipos a los cuales tienes permiso <p align="right"><strong style="color: green;font-size: 16px"><?php echo date('Y-m-d H:i:s');?></strong></p>
                        </div><br/>
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
                         <!-- <table id="datatable" class="table table-striped table-bordered"> 
                            <thead>
                            <tr>
                                <th>Id Equipo</th>
                                <th>TAG ID</th>
                                <th>Sede</th>
                                <th>Estado</th>
                                <th>DP_1</th>
                                <th>DP_2</th>
                                <th>DP_3</th>
                                <th>DP_4</th>
                                <th>Acción</th>
                            </tr>
                            </thead>
                            <tbody>
	                            @foreach($dataEquipo as $row)
		                            @foreach($row as $rowmonitor)  
										@if($rowmonitor->equipo->ESTADO_EQUIPO != 'ok')
											<tr class="danger">
										@else
											<tr>
										@endif
		                                <td>{{$rowmonitor->equipo->ID_EQUIPO}}</td>
		                                <td>{{$rowmonitor->equipo->NOMBRE_EQUIPO}}</td>
		                                <td>{{$rowmonitor->plant->name}}</td>
		                                <td>{{$rowmonitor->equipo->ESTADO_EQUIPO}}</td>
		                                <td>{{(($rowmonitor->equipo->DP_1))}}</td>
		                                <td>{{(($rowmonitor->equipo->DP_2))}}</td>
		                                <td>{{(($rowmonitor->equipo->DP_3))}}</td>
		                                <td>{{(($rowmonitor->equipo->DP_4))}}</td>                             
			                            <td>
			                                <a href="/monitor/{{$rowmonitor->id}}"><button class="btn btn-round btn-warning edit-item">Ver</button></a> 		                                
			                        	</td>
		                                </tr>       
		                            @endforeach
	                            @endforeach
                            </tbody>
                        </table>-->
                        
                        <div id='table_container_left'>
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
                                	<th height="30px">Acción</th>
	                                <th>IdEquipo</th>
	                                <th>TAG_ID</th>
	                                <th>Sede</th>
	                                <th>Estado</th>
								</tr>
							</thead>
							<tbody>
							@foreach($dataEquipo as $row)
		                    	@foreach($row as $rowmonitor)  
									@if($rowmonitor->equipo->ESTADO_EQUIPO != 'ok')
									<tr class="danger">
									@else
									<tr>
									@endif
									<td>
			                        	<a href="/monitor/{{$rowmonitor->id}}"><button class="btn btn-round btn-warning edit-item">Ver</button></a> 		                                
			                        </td>
									<td>{{$rowmonitor->equipo->ID_EQUIPO}}</td>
		                            <td>{{$rowmonitor->equipo->NOMBRE_EQUIPO}}</td>
		                            <td>{{$rowmonitor->plant->name}}</td>
		                            <td>{{$rowmonitor->equipo->ESTADO_EQUIPO}}</td>
									</tr>
								@endforeach
	                        @endforeach
							</tbody>
						</table>
					</div>
					<div id='table_container_right'>
						<table class="table table-striped table-bordered">
							<thead>
								<tr height="30px">
									<?php 
									for($i=0;$i<94;$i++){
								 		echo "<th>DP_".$i."</th>";
								 		
									}
									?> 
									<th>Acción</th>
								</tr>
							</thead>
							<tbody>
								@foreach($dataEquipo as $row)
		                    	@foreach($row as $rowmonitor)  
									@if($rowmonitor->equipo->ESTADO_EQUIPO != 'ok')
									<tr class="danger">
									@else
									<tr>
									@endif
								
									<?php 
									for($i=0;$i<94;$i++){
										$var = "DP_".$i;
								 		echo "<td>".(($rowmonitor->equipo->$var))."</td>";
									
									}
									?> 
									<td>
			                        	<a href="/monitor/{{$rowmonitor->id}}"><button class="btn btn-round btn-warning edit-item">Ver</button></a> 		                                
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
    </div>
	<script type="text/javascript">
    	setInterval('refreshMon()',10000);
    	function refreshMon(){	
    		 $("#datatablemon").load("/monitorLoad"); 
    	}
    	//setTimeout("location.reload()", 5000);
    </script>
    <!-- /page content -->
@endsection