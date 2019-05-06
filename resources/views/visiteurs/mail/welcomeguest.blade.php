@component('mail::message')
 Bonjour

Votre compte a été créé sur STYL'IMMO, il vous permettera de suivre votre transaction en temps réel. 
@component('mail::panel')
Vos identifiants : <br>
Nom d'utilisateur : {{$guestuser->email}} <br>
Mot de passe : <strong>{{$password}}</strong>
@endcomponent

@component('mail::panel')
Je me connecte :<br>
{{route('guestusers.login')}}
@endcomponent

@component('mail::panel')

Pour des raisons de sécurité, noubliez pas de modifier votre mot de passe une fois connecté.
@endcomponent

Merci,<br>
L'équipe Stylimmo.
{{-- {{ config('app.name') }} --}}
@endcomponent