@component('mail::message')
# Bienvenue {{$user->prenom}} {{$user->nom}}

Votre compte  stylimmo a été crée. afin de valider votre compte veuillez completer vos informations en cliquant 
sur le bouton ci-dessous.
@component('mail::panel')
Vos identifiants : 
Email : {{$user->email}} <br>
Mot de passe : {{$user->password_temporaire}}
@endcomponent

@component('mail::button', ['url' => config('app.url')])
Je complète mon profil
@endcomponent

@component('mail::panel')

Pour passer au statut de mandataire, il vous faut 
completer vos informations.
<br>
Pour des raisons de sécurité, noubliez pas de modifier votre mot de passe une fois connecté.
@endcomponent

Merci,<br>
L'équipe Stylimmo.
{{-- {{ config('app.name') }} --}}
@endcomponent
