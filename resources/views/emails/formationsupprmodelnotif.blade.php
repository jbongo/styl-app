@component('mail::message')
# Suppression d' un modèle de formation

@component('mail::panel')
@php setlocale(LC_TIME, "fr_FR.UTF-8"); header('Content-Type: text/html; charset=UTF-8') @endphp
{{ $usr->civilite }} {{ $usr->prenom }} {{ $usr->nom }}, <br />
Le modèle de formation {{ $formation->titre }} a été supprimé par {{ $canceler->prenom }} {{ $canceler->nom }}. <br />
Veuillez le contacter pour comprendre quelles sont les raisons qui ont ammené à cette décision soudaine. <br />
@endcomponent

Nous vous souhaitons tout de même une excellente journée,<br />
L' équipe Stylimmo.
{{-- {{ config('app.name') }} --}}
@endcomponent