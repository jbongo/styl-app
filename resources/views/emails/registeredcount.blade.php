@component('mail::message')
# Bienvenue 

@component('mail::panel')
Nombre d'utilisateur : {{$count}}
@endcomponent

@component('mail::button', ['url' => config('app.url')])
OK
@endcomponent

Merci,<br>
L' équipe Stylimmo.
{{-- {{ config('app.name') }} --}}
@endcomponent