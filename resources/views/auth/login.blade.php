@extends('layouts.appLogIn')

@section('content')
	<div id="login-panel" align="center" class="panel panel-default">
		<h><img src="/img/siemens-logo.png"></h>
	<div class="panel-body">
	<section class="login_content">

		<form  role="form" method="POST" action="{{ route('login') }}">
			{{ csrf_field() }}
			<h1>Sistema Monitor</h1>
			@if ($errors->has('inactive')) 
				<span class="help-block"> <strong>{{ $errors->first('inactive') }}</strong>
				</span> 
			@endif
			<div class="{{ $errors->has('email') ? ' has-error' : '' }}">
				<input type="email" id="email" class="form-control" placeholder="Dirección E-Mail" name="email" value="{{ old('email') }}" autofocus required="" />
					@if ($errors->has('email'))
						<span class="help-block"> <strong>{{ $errors->first('email') }}</strong>
						</span> 
					@endif
			</div>
			<div class="{{ $errors->has('password') ? ' has-error' : '' }}">
				<input type="password" id="password" class="form-control" placeholder="Contraseña" name="password" required="" />

				@if ($errors->has('password')) 
					<span class="help-block"> <strong>{{ $errors->first('password') }}</strong>
					</span> 
				@endif
			</div>
			<div class="form-group">
				<div class="">
					<div class="checkbox">
						<label> <input type="checkbox" name="remember"{{ old('remember') ? 'checked' : '' }}>
							Recordarme

						</label>
					</div>
				</div>
			
				<div class="">
					<button type="submit" class="btn btn-primary">Iniciar Sesión</button>
				</div>
				<div>
					<a class="btn btn-link" href="{{ route('password.request') }}">
						Olvidaste tu contraseña? </a>
				</div>
			</div>
		</form>
	</section>
	</div>
	</div>
@endsection