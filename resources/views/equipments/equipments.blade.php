@extends('layouts.app') @section('title', 'Equipos')

@section('content')
<!-- page content -->
<div class="right_col" role="main">
	<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Administrador de Equipos</h2>
						<div class="clearfix"></div>
					</div>
					
					<div class="x_content">
						<p class="text-muted font-13 m-b-30">Por medio de este módulo, puedes crear y editar equipos.</p>
						 <p align="right">
						<button type="button" id="create-client" class="btn btn-round btn-success" data-toggle="modal" data-target="#create-item">Crear</button>
						</p>
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
									<th>Id</th>
									<th>Nombre</th>
									<th>Tipo</th>
									<th>Planta</th>
									<th>Modelo</th>
									<th>Ultimo Evento</th>
									<th>Fecha registro</th>
									<th>Fecha modificación</th>
									<th>Estado</th>
									<th>Acción</th>
								</tr>
							</thead>
							<tbody>
								@foreach($dataEquipment as $rowEquipment)
								<tr>
									<td>{{ $rowEquipment->id }}</td>
									<td>{{ $rowEquipment->name }}</td>
									<td>{{ $rowEquipment->type->name }}</td>
									<td>{{ $rowEquipment->plant->name }}</td>
									<td>{{ $rowEquipment->model }}</td>
									<td>{{ $rowEquipment->last_event }}</td>
									<td>{{ $rowEquipment->created_at }}</td>
									<td>{{ $rowEquipment->updated_at }}</td>
									<td>{{ $rowEquipment->status }}</td>
									<td>
										<!-- Large modal -->
										<div type="button" id="edit-client" class="btn btn-round btn-warning" data-toggle="modal" data-target="#edit-item{{ $rowEquipment->id }}" >Editar</div>
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
