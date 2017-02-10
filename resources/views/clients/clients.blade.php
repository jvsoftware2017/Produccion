@extends('layouts.app') @section('title', 'Clientes')

@section('content')
<!-- page content -->
<div class="right_col" role="main">
	<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Administrador de clientes</h2>
						<div class="clearfix"></div>
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
					<div class="x_content">
						<p class="text-muted font-13 m-b-30">Por medio de este módulo, puedes crear y editar clientes.</p>
						<button type="button" class="btn btn-round btn-success" onclick="document.location.href='/clients/create';">Crear</button>
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Id</th>
									<th>Nombre</th>
									<th>E-mail</th>
									<th>Teléfono</th>
									<th>Dirección</th>
									<th>Ciudad</th>
									<th>Fecha de registro</th>
									<th>Fecha de modificación</th>
									<th>Estado</th>
									<th>Acción</th>
								</tr>
							</thead>
							<tbody>
								@foreach($clients as $client)
								<tr>
									<td>{{ $client->id }}</td>
									<td>{{ $client->name }}</td>
									<td>{{ $client->email }}</td>
									<td>{{ $client->phone }}</td>
									<td>{{ $client->adress }}</td>
									<td>{{ $client->city->name }}</td>
									<td>{{ $client->created_at }}</td>
									<td>{{ $client->updated_at }}</td>
									<td>{{ $client->status }}</td>
									<td>
										<!-- Large modal -->
										<div type="button" id="edit-client" class="btn btn-round btn-warning" onclick="document.location.href='/clients/{{ $client->id }}/edit';" >Editar</div>
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
