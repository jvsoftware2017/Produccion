{{ csrf_field() }}
<div class="clearfix"></div>

<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="x_panel">
<div class="x_title">
<h2>Detalle Monitor</h2>
<ul class="nav navbar-right panel_toolbox">
<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
</li>
</ul>
<div class="clearfix"></div>
</div>
<div class="x_content"  >
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
                    <div><p align="right"><strong style="color: green;font-size: 16px"><?php echo date('Y-m-d H:i:s');?></strong></p></div>   
                    @foreach($dataEquipo as $rowmonitor)                                 
                    
                    <div align="center"><h4 class="modal-title" id="myModalLabel"> <strong>{{ $rowmonitor->equipo->MODELO_EQUIPO." - ".$rowmonitor->equipo->NOMBRE_EQUIPO }}</strong></h4></div>
                    <div class="table-responsive">
                    <table align="center" style="border-collapse:separate;border-spacing:15px;" border="0" width="70%" class="table-responsive">
                    	<tr>
                        	<td><img src="{{ URL::to('/') }}/clientLogo/{{ $rowmonitor->plant->client->urlLogo }}" class="img-responsive" alt="Logo del Cliente" style="max-width: 100px;"></td>
                            <td colspan="2" align="center">
                            	<?php 
                            	$restaMin = strtotime('now')-strtotime($rowmonitor->equipo->date_DP68);                            	
                            	?>
                            	@if($restaMin > 65)
                            	OFF LINE <canvas id="circle1"></canvas>
                        		@else 
                        		ON LINE <canvas id="circle0"></canvas>
                        		@endif                            	
							</td>
                            <td></td>
                        </tr>
                        <tr>                       
                            <td align="right"></td>                        
                            <th align="center" rowspan="6" style="max-height: 80%;max-width: 100%">
                        	    <div align="center"> <img alt="Equipo {{ $rowmonitor->equipo->NOMBRE_EQUIPO }}" src="../equipmentImg/{{ $rowmonitor->urlImg }}" class="img-responsive"> </div>
                            </th>
                       	    <td align="left"></td>
                            <td align="left"></td>
                       	</tr>
                        <tr>
                        @if((($rowmonitor->equipo->DP_2))== 1 || (($rowmonitor->equipo->DP_3))== 1)
                            <td align="right">Run <canvas id="circle0"></canvas> </td>
                        @else
                            <td align="right">Run <canvas id="circle1"></canvas></td>
                        @endif
                       	                                                             
                        	<td align="left">Operation Hrs: </td>
                         	<td align="left"><strong style="font-size: 16px">{{$rowmonitor->equipo->DP_40}} Hrs</strong></td>
                        </tr>
                        <tr>
                        @if((($rowmonitor->equipo->DP_7))== 1)
                        	<td align="right">READY <canvas id="circle1"></canvas></td>
                        @else
                        	<td align="right">READY <canvas id="circle0"></canvas></td>
                        @endif  
                       	
                            <td align="left">Next Mantenaince: </td>
                        	<td align="left"><strong style="font-size: 16px">{{$rowmonitor->equipo->DP_39}} Hrs</strong></td>
                        </tr>
                        <tr>
                        @if((($rowmonitor->equipo->DP_1))== 1)
                        	<td align="right">Warning <canvas id="circle2"></canvas></td>
                        @else
                            <td align="right">Warning <canvas id="circle0"></canvas></td>
                        @endif
                        
                        	<td align="left">Temperature: </td>
                            <td align="left"><strong style="font-size: 16px">{{$rowmonitor->equipo->DP_44}} °C</strong></td>
                         </tr>
                         <tr>
                         @if((($rowmonitor->equipo->DP_0))== 1)
                         	<td align="right">Fault <canvas id="circle1"></canvas></td>
                         @else
                            <td align="right">Fault <canvas id="circle0"></canvas></td>
                         @endif
                         
                            <td align="left">Humidity: </td>
                         	<td align="left"><strong style="font-size: 16px">{{$rowmonitor->equipo->DP_49}} %</strong></td>
                         </tr>
                         <tr>
                         	<td align="right">Comunicación OK
								<?php 
				                $restaMin = strtotime('now')-strtotime($rowmonitor->equipo->date_DP68);                            	
				                ?>
				                @if($restaMin > 65)
				                <canvas id="circle1"></canvas>
				                @else
				                <canvas id="circle0"></canvas>
				                @endif 
							</td>
                            <td align="left">Speed: </td>
                         @if((($rowmonitor->equipo->DP_8)) == 1)
                         	<td align="left"><strong style="font-size: 16px">{{$rowmonitor->equipo->DP_16}} %</strong></td>
                         @endif
                         @if((($rowmonitor->equipo->DP_9)) == 1)
                         	<td align="left"><strong style="font-size: 16px">{{$rowmonitor->equipo->DP_16}} RPM</strong></td>
                         @endif
                         @if((($rowmonitor->equipo->DP_10)) == 1)
                            <td align="left"><strong style="font-size: 16px">{{$rowmonitor->equipo->DP_16}} Hz</strong></td>
                         @endif
  	                     </tr>
                         <tr>
                         	<td align="center"></td>
                            <td align="center" colspan="2">
                            	<a href="/events/{{$rowmonitor->id_equipo}}"><div type="button" class="btn btn-round btn-success">Alarms/Event</div></a>
                                <button type="button" class="btn btn-round btn-success" data-toggle="modal" data-target="#detail-item" onclick="mostrar()">Details</button>
                                <a href="/report/{{ $rowmonitor->id_equipo }}"><div type="button" class="btn btn-round btn-success">Reportes</div></a>
                           	</td>
                            <td align="center"></td>
                         </tr>
                         <tr style="background-color: gray;color: white; font-size: 14px;">
                         	<td align="center">Fecha</td>
                            <td align="center" colspan="2">Evento</td>
                             <td align="center">Tipo</td>                                                              
                         </tr>
                         @foreach($dataEvent as $rowevent)
                         @if($rowevent->type == 'alarm')
                         <tr style="background-color: red;color: white;">
                         @else
						 <tr>
						 @endif
	                     	<td align="center">{{$rowevent->created_at}}</td>
	                        <td align="center" colspan="2">{{$rowevent->state->name}}</td>
	                        <td align="center">{{$rowevent->type}}</td>                                                              
                         </tr>
                         @endforeach
                    </table>
                    </div>
										<!-- View details Modal -->
										<div class="modal fade" id="detail-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="ocultar()"><span aria-hidden="true">&times;</span></button>
														<h4 class="modal-title" id="myModalLabel">Datos complementarios del Equipo <strong>{{ $rowmonitor->equipo->MODELO_EQUIPO." - ".$rowmonitor->equipo->NOMBRE_EQUIPO }}</strong></h4>
													</div>
													<div class="modal-body">
																										
															<div class="form-group">
																<label class="control-label" for="plant">Número de serie:</label>
																<?php echo strtoupper($rowmonitor->serialNumber) ?>
																<div class="help-block with-errors"></div>
															</div>
															<div class="form-group">
																<label class="control-label" for="equipment">Potencia:</label>
																<?php echo strtoupper($rowmonitor->power) ?>
																<div class="help-block with-errors"></div>
															</div>
															<div class="form-group">
																<label class="control-label" for="equipment">Voltage:</label>
																<?php echo strtoupper($rowmonitor->voltage) ?>
																<div class="help-block with-errors"></div>
															</div>
															<div class="form-group">
																<label class="control-label" for="equipment">Área:</label>
																<?php echo strtoupper($rowmonitor->area) ?>
																<div class="help-block with-errors"></div>
															</div>
															<div class="form-group">
																<label class="control-label" for="equipment">Sub Área:</label>
																<?php echo strtoupper($rowmonitor->subarea) ?>
																<div class="help-block with-errors"></div>
															</div>
															<div class="form-group">
																<label class="control-label" for="equipment">Función:</label>
																<?php echo strtoupper($rowmonitor->function) ?>
																<div class="help-block with-errors"></div>
															</div>
															<div class="form-group">
																<label class="control-label" for="equipment">Ciclo de Vida:</label>
																<?php echo strtoupper($rowmonitor->lifecycle) ?>
																<div class="help-block with-errors"></div>
															</div>
															<div class="form-group">							
																<button type="button" data-dismiss="modal" class="btn btn-round btn-success" onclick="ocultar()">Aceptar</button>
															</div>													
													</div>
												</div>
											</div>
										</div>                    
                    
                    @endforeach
                    </div>
                </div>
            </div>
        </div>