@extends('layouts.app')
@section('title', 'Monitor | DriveSysMonitor')
@section('content')
    <!-- page content -->
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
                        </div>                                               
                        <br/>
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
                        <table id="datatablex" class="table table-striped table-bordered"> 
                            <thead>
                            <tr>
                            	<th>Monitor</th>
                                <th>Id Equipo</th>
                                <th>TAG ID</th>
                                <th>Sede</th>
                                <th>Estado</th>
                                <th>GStat_bit0</th>
                                <th>GStat_bit1</th>
                                <th>GStat_bit2</th>
                                <th>GStat_bit3</th>
                                <th>GStat_bit4</th>      
                                <th>Variables...</th>                          
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
		                                <td>{{(($rowmonitor->equipo->DP_0))}}</td>
		                                <td>{{(($rowmonitor->equipo->DP_1))}}</td>
		                                <td>{{(($rowmonitor->equipo->DP_2))}}</td>
		                                <td>{{(($rowmonitor->equipo->DP_3))}}</td>
		                                <td>{{(($rowmonitor->equipo->DP_4))}}</td> 
		                                <td align="center">		 									
		 									<input type="button" value="Ver Más" onclick="mostrar({{$rowmonitor->equipo->ID_EQUIPO}})">	
					                    </td>                           
		                                </tr> 
		                                <tr>
		                                <td colspan="11" align="right">
			                                <div id="variables{{$rowmonitor->equipo->ID_EQUIPO}}" style="display: none;">
			                                	<table style="width: 20%" border="1">
			                                		<tr>
					                                <td colspan="2" align="center"><input type="button" value="Ver Menos" onclick="ocultar({{$rowmonitor->equipo->ID_EQUIPO}})"></td> 
					                                </tr>
			                                		<?php 
													for($i=5;$i<94;$i++){
														$var = "DP_".$i;
											 			echo "<tr><td align='center' width='10%'>".$nameVariables[$var]."</td>";											 			
											 			echo "<td align='center' width='10%'>".(($rowmonitor->equipo->$var))."</td></tr>";
													}
													?> 
				                                	<tr>
					                                <td colspan="2" align="center"><input type="button" value="Ver Menos" onclick="ocultar({{$rowmonitor->equipo->ID_EQUIPO}})"></td> 
					                                </tr>
				                                </table>
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
	<script type="text/javascript">
		var ban = 0; 
    	setInterval('refreshMon()', 5000);
    	function refreshMon(){	
        	if(ban == 0)
    			$("#datatablemon").load("/monitorLoad"); 
    	}
    	//setTimeout("location.reload()", 5000);

		function mostrar(idEquipo){
			document.getElementById('variables'+idEquipo).style.display = 'block';
			ban = 1;
		}
		function ocultar(idEquipo){
			document.getElementById('variables'+idEquipo).style.display = 'none';
			ban = 0;
		}
    	
    </script>
    <!-- /page content -->
@endsection