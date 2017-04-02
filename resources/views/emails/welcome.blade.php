@component('mail::message')
# Tu usuario ha sido creado!

Tu Usuario ha sido creado exitosamente, para ingresar usa tu correo, y el pass es:

Password: {!! $password !!}

Por favor, cambiar este password al iniciar sesión por primera vez.

@component('mail::button', ['url' => 'https://deitydev.com/'])
Ir a la aplicación
@endcomponent

Saludos,<br>
{{ config('app.name') }}
@endcomponent
