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
                    <table align="center" style="border-collapse:separate;border-spacing:15px;" border="0" width="70%" class="table-responsive">
                                                              <tr>
                                                                @if((($rowmonitor->equipo->DP_2))== 1)
                                                                <td align="right">Run FW <canvas id="circle0"></canvas> </td>
                                                                @else
                                                                <td align="right"></td>
                                                                @endif
                                                                <td align="center" rowspan="6" style="max-height: 80%;max-width: 100%">
                                                                <div align="center"> <img alt="Equipo {{ $rowmonitor->equipo->NOMBRE_EQUIPO }}" src="../equipmentImg/{{ $rowmonitor->urlImg }}" class="img-responsive"> </div>
                                                                </td> 
                                                                <td align="left">Comunicación OK <canvas id="circle0"></canvas></td>     
                                                                <td align="left"></td>                                                          
                                                              </tr>
                                                              <tr>
                                                              	@if((($rowmonitor->equipo->DP_3))== 1)
                                                                <td align="right">Run BW <canvas id="circle0"></canvas></td>
                                                                @else
                                                                <td align="right"></td>
                                                                @endif                                                                
                                                                <td align="left">Operation Hrs: </td>
                                                                <td align="left"><strong style="font-size: 16px">{{$rowmonitor->equipo->DP_40}} Hrs</strong></td>
                                                              </tr>
                                                              <tr>
                                                                @if((($rowmonitor->equipo->DP_4))== 1)
                                                                <td align="right">READY <canvas id="circle0"></canvas></td>
                                                                @else
                                                                <td align="right"></td>
                                                                @endif
                                                                <td align="left">Next Mantenaince: </td>
                                                                <td align="left"><strong style="font-size: 16px">{{$rowmonitor->equipo->DP_39}} Hrs</strong></td>
                                                              </tr>
                                                              <tr>
                                                              	@if((($rowmonitor->equipo->DP_7))== 1)
                                                                <td align="right">At Speed Ref <canvas id="circle0"></canvas></td>
                                                                @else
                                                                <td align="right"></td>
                                                                @endif
                                                               	<td align="left">Temperature: </td>
                                                                <td align="left"><strong style="font-size: 16px">{{$rowmonitor->equipo->DP_44}} °C</strong></td>
                                                              </tr>
                                                              <tr>
                                                              	@if((($rowmonitor->equipo->DP_1))== 1)
                                                                <td align="right">Warning <canvas id="circle2"></canvas></td>
                                                                @else
                                                                <td align="right"></td>
                                                                @endif
                                                                <td align="left">Humidity: </td>
                                                                <td align="left"><strong style="font-size: 16px">{{$rowmonitor->equipo->DP_49}} %</strong></td>
                                                              </tr>
                                                              <tr>
                                                              	@if((($rowmonitor->equipo->DP_0))== 1)
                                                                <td align="right">Fault <canvas id="circle1"></canvas></td>
                                                                @else
                                                                <td align="right"></td>
                                                                @endif
                                                                <td align="left">Speed: </td>
                                                                <td align="left"><strong style="font-size: 16px">{{$rowmonitor->equipo->DP_16}}</strong></td>
                                                             </tr>
                                                              <tr>
                                                                <td align="center"></td>
                                                                <td align="center"></td>
                                                                <td align="center"></td>
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
                        
                            @endforeach
                    </div>
                </div>
            </div>
        </div>