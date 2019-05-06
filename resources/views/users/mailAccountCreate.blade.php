@component('mail::message')
# Bienvenue {{$user->prenom}} {{$user->nom}}

Votre compte  stylimmo a été crée. 
@component('mail::panel')
Vos identifiants : 
Email : {{$user->email}} <br>
Mot de passe : {{$user->password_temporaire}}
@endcomponent

@component('mail::button', ['url' => config('app.url')])
Je me connecte
@endcomponent

@component('mail::panel')

Pour des raisons de sécurité, noubliez pas de modifier votre mot de passe une fois connecté.
@endcomponent

Merci,<br>
L'équipe Stylimmo.
{{-- {{ config('app.name') }} --}}
@endcomponent