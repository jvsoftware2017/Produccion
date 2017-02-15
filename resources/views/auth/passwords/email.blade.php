@extends('layouts.appLogIn')

@section('content')
<div class="login_content">
	<h3>Escriba su email</h3>
	<p>Se le enviará un link para cambiar su password.</p>
	@if (session('status'))
		<div class="alert alert-success">{{ session('status') }}</div>
	@endif
	<form role="form" method="POST" action="{{ route('password.email') }}">
		{{ csrf_field() }}
		<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
			<input id="email" type="email" class="form-control" name="email" placeholder="Escriba su Email"
				value="{{ old('email') }}" required> @if ($errors->has('email')) <span
				class="help-block"> <strong>{{ $errors->first('email') }}</strong>
			</span> @endif
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary">Enviar link para
				cambiar el password</button>
		</div>
	</form>
</div>
@endsection
