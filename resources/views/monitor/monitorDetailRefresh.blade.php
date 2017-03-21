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
                    @foreach($dataEquipo as $row)
                                    @foreach($row as $rowmonitor)                     
                    <div align="center"><h4 class="modal-title" id="myModalLabel"> <strong>{{ $rowmonitor->equipo->MODELO_EQUIPO." - ".$rowmonitor->equipo->NOMBRE_EQUIPO }}</strong></h4></div>
                    <table align="center" style="border-collapse:separate;border-spacing:15px;" border="0" width="70%" class="table-responsive">
                                                              <tr>
                                                                <td></td>
                                                                <td align="center">Comunicación OK <canvas id="circle0"></canvas></td>
                                                                <th align="left" rowspan="2" style="background-color: gray;color: white;l">{{$rowmonitor->model}}<br/>{{$rowmonitor->serialNumber}}<br/>Power: {{$rowmonitor->power}}<br/>Current: {{$rowmonitor->voltage}}</th>                                                                
                                                              </tr>
                                                              <tr>
                                                                <td align="right">Run FW <canvas id="circle{{(($rowmonitor->equipo->DP_2))}}"></canvas> </td>
                                                                <th rowspan="6">
                                                                <div align="center"> <img alt="Equipo {{ $rowmonitor->equipo->NOMBRE_EQUIPO }}" src="../equipmentImg/{{ $rowmonitor->urlImg }}" class="img-responsive"> </div>
                                                                </th>                                                                
                                                              </tr>
                                                              <tr>
                                                                <td align="right">Run BW <canvas id="circle{{(($rowmonitor->equipo->DP_3))}}"></canvas></td>
                                                                <td align="left">Operation Hrs: <strong style="font-size: 16px">{{$rowmonitor->equipo->DP_40}}</strong></td>
                                                              </tr>
                                                              <tr>
                                                                <td align="right">READY <canvas id="circle{{(($rowmonitor->equipo->DP_4))}}"></canvas></td>
                                                                <td align="left">Next Mantenaince: <strong style="font-size: 16px">{{$rowmonitor->equipo->DP_39}}</strong></td>
                                                              </tr>
                                                              <tr>
                                                                <td align="right">At Speed Ref <canvas id="circle{{(($rowmonitor->equipo->DP_7))}}"></canvas></td>
                                                                <td align="left">Temperature: <strong style="font-size: 16px">{{$rowmonitor->equipo->DP_44}}</strong></td>
                                                              </tr>
                                                              <tr>
                                                                <td align="right">Warning <canvas id="circle{{(($rowmonitor->equipo->DP_1))}}"></canvas></td>
                                                                <td align="left">Humidity: <strong style="font-size: 16px">{{$rowmonitor->equipo->DP_49}}</strong></td>
                                                              </tr>
                                                              <tr>
                                                                <td align="right">Flaut <canvas id="circle{{(($rowmonitor->equipo->DP_0))}}"></canvas></td>
                                                                <td align="left">Speed: <strong style="font-size: 16px">{{$rowmonitor->equipo->DP_16}}</strong></td>
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
                            @endforeach
                            @endforeach
                    </div>
                </div>
            </div>
        </div>