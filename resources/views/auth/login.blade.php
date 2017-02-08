@extends('layouts.appLogIn')

@section('content')
	<section class="login_content">
		<form  role="form" method="POST" action="{{ route('login') }}">
			{{ csrf_field() }}
			<h1>Login Form</h1>
			<div class="{{ $errors->has('email') ? ' has-error' : '' }}">
				<input type="email" id="email" class="form-control" placeholder="E-Mail Address" name="email" value="{{ old('email') }}" autofocus required="" /> 
					@if ($errors->has('email'))
						<span class="help-block"> <strong>{{ $errors->first('email') }}</strong>
						</span> 
					@endif
			</div>
			<div class="{{ $errors->has('password') ? ' has-error' : '' }}">
				<input type="password" id="password" class="form-control" placeholder="Password" name="password" required="" />
				@if ($errors->has('password')) 
					<span class="help-block"> <strong>{{ $errors->first('password') }}</strong>
					</span> 
				@endif
			</div>
			<div class="form-group">
				<div class="">
					<div class="checkbox">
						<label> <input type="checkbox" name="remember"{{ old('remember') ? 'checked' : '' }}>
							Remember Me
						</label>
					</div>
				</div>
			
				<div class="">
					<button type="submit" class="btn btn-primary">Login</button>
	
					<a class="btn btn-link" href="{{ route('password.request') }}">
						Forgot Your Password? </a>
				</div>
			</div>
		</form>
	</section>
@endsection