@extends('layouts.app') @section('title', 'Perfil del Usuario')

@section('content')
<!-- page content -->
<div class="right_col" role="main">
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Perfil de usuario</h2>
					<div class="clearfix"></div>
				</div>
				<div class="x-content">
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
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Cliente</th>
									<th>Role</th>
									<th>Nombre</th>
									<th>Email</th>
									<th>Status</th>
									<th>Editar</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>{{ $user->client->name }}</td>
									<td>{{ $user->role->description }}</td>
									<td>{{ $user->name }}</td>
									<td>{{ $user->email }}</td>
									<td>{{ $user->status }}</td>
									<td>
										<!-- Large modal -->
													<div type="button" id="edit-user" class="btn btn-round btn-warning" data-toggle="modal" data-target="#edit-item{{ $user->id }}" >Editar</div>
									</td>
								</tr>
							</tbody>
							<!-- Edit Item Modal -->
							<div class="modal fade" id="edit-item{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Editar Perfil de <strong>{{ $user->name }}</strong></h4>
										</div>
										<div class="modal-body">
											<form data-toggle="validator" action="/user_profile" method="POST">
												{{ csrf_field() }}
												{{ method_field('PUT') }}
												<div class="form-group">
													<label class="control-label" for="name">Nombre:</label>
													<input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" data-error="Por favor escribir un nombre válido" oninvalid="this.setCustomValidity('Por favor escribir un nombre válido')" oninput="setCustomValidity('')" required />
													<div class="help-block with-errors"></div>
												</div>
												<div class="form-group">
													<label for="password" class="control-label">Password:</label>
													<input id="password" type="password" name="password" data-validate-length="6,8" class="form-control" placeholder="Mínimo 6 caracteres">
													<div class="help-block with-errors"></div>
												</div>
												<div class="form-group">
													<button type="submit" class="btn btn-round crud-submit btn-success">Editar</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- /page content -->

@endsection