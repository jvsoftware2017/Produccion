@extends('layouts.app') @section('title', 'Crear Cliente')

@section('content')
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Crear Nuevo Cliente</h3>
			</div>
		</div>
		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_content">
						<form class="form-horizontal form-label-left" method="post" action="/clients">
							{{ csrf_field() }}
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12"
									for="name">Nombre <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="name" class="form-control col-md-7 col-xs-12"
										data-validate-length-range="6" data-validate-words="2"
										name="name" required="required" type="text"
										value="">
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12"
									for="email">Email <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="email" id="email" name="email" required="required"
										class="form-control col-md-7 col-xs-12"
										value="">
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12"
									for="telephone">Teléfono <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="tel" id="telephone" name="phone"
										required="required" data-validate-length-range="8,20"
										class="form-control col-md-7 col-xs-12"
										value="">
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12"
									for="adress">Dirección <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="adress" class="form-control col-md-7 col-xs-12"
										data-validate-length-range="6" data-validate-words="2"
										name="adress" required="required" type="text"
										value="">
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12"
									for="city">Ciudad <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="city" class="form-control col-md-7 col-xs-12"
										data-validate-length-range="6" data-validate-words="2"
										name="id_city" required="required" type="text"
										value="">
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12"
									for="status">Estado <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select class="select2_single form-control" tabindex="-1"
										name="status">
										<option value="active">Activo</option>
										<option value="inactive">Inactivo</option>
									</select>
								</div>
							</div>
							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-6 col-md-offset-3">
									<button id="send" type="submit" class="btn btn-success">Crear</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /page content -->

@endsection 