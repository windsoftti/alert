@component('mail::message')
# {{$user->name}} Bienvenido a {{config('app.name')}}

Este es tu acceso<br /><br />

@component('mail::panel')
Usuario: `{{$user->email}}` <br />
Contraseña: `{{$visiblePassword}}`
@endcomponent

URL: `{{url("/login")}}`
@component('mail::button', ['url' => url("/login"), 'color' => 'success'])
Acceder
@endcomponent



Gracias,<br>
{{ config('app.name') }}
@endcomponent
