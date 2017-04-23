@extends('layouts.app') @section('title', 'Usuarios | DriveSysMonitor')

@section('content')
<!-- page content -->
<div class="right_col" role="main">
	<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Listado de Eventos</h2>
						<div class="clearfix"></div>
					</div>
					
					<div class="x_content">
						<p class="text-muted font-13 m-b-30">Aqui podrá visualizar el listado de Eventos/Alarmas completo para el equipo seleccionado.</p>
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
									<th>Equipo(TAG ID)</th>
									<th>Fecha</th>
									<th>Evento</th>
									<th>Tipo</th>
									<th>Monitor</th>
								</tr>
							</thead>
							<tbody>
								@foreach($dataEvent as $rowevent)
									@if($rowevent->type == 'alarm')
			                         <tr style="color: red;">
			                         @else
									 <tr>
									 @endif
									 	<td align="center">{{$rowevent->id_equipo}}</td>
				                     	<td align="center">{{$rowevent->created_at}}</td>
				                        <td align="center">{{$rowevent->state->name}}</td>
				                        <td align="center">{{$rowevent->type}}</td>                                                              
										<td>
											<a href="/monitor/{{$rowevent->id_equipo}}"><div type="button" class="btn btn-round btn-success">Monitor</div></a>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /page content -->

@endsection 
