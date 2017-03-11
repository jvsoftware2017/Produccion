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
                                <th>Estado</th>
                                <th>DP_1</th>
                                <th>DP_2</th>
                                <th>DP_3</th>
                                <th>DP_4</th>
                                <th>DP_7</th>
                                @if(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user()))
                                	<th>Acción</th>
                                @endif
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($dataEquipo as $rowmonitor)
								@if($rowmonitor->status == 'inactive')
									<tr class="danger"">
								@else
									<tr>
								@endif
                                        <td>{{$rowmonitor->ID_EQUIPO}}</td>
                                        <td>{{$rowmonitor->NOMBRE_EQUIPO}}</td>
                                        <td>{{$rowmonitor->ESTADO_EQUIPO}}</td>
                                        <td>{{ord($rowmonitor->DP_1)}}</td>
                                        <td>{{ord($rowmonitor->DP_2)}}</td>
                                        <td>{{ord($rowmonitor->DP_3)}}</td>
                                        <td>{{ord($rowmonitor->DP_4)}}</td>
                                        <td>{{ord($rowmonitor->DP_7)}}</td>
                                        @if(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user()))
	                                        <td>
	                                            <button data-toggle="modal" data-target="#edit-item{{$rowmonitor->id}}" class="btn btn-round btn-warning edit-item">Editar</button>
	                                        </td>
                                        @endif
                                    </tr>
									@if(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user()))
	                                    <!-- Edit Item Modal -->
	                                    <div class="modal fade" id="edit-item{{$rowmonitor->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	                                        <div class="modal-dialog" role="document">
	                                            <div class="modal-content">
	                                                <div class="modal-header">
	                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                                                    <h4 class="modal-title" id="myModalLabel">Estado monitor <strong>{{ $rowmonitor->NOMBRE_EQUIPO }}</strong></h4>
	                                                </div>
	                                                <div class="modal-body">
	                                                <div align="center"> <img alt="Equipo ID XXX" src="equipmentImg/{{ $rowmonitor->Equipment->urlImg }}" class="img-responsive"> </div>	
	                                                    <form data-toggle="validator" action="/plants/{{$rowmonitor->id}}" method="POST">
	                                                        {{ csrf_field() }}
	                                                        {{ method_field('PUT') }}
	
	
	                                                    </form>
	
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div>
									@endif
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