@component('mail::message')
# Annulation de la formation {{ $formation->titre }} par {{ $canceler->prenom }} {{ $canceler->nom }}

@component('mail::panel')
@php setlocale(LC_TIME, "fr_FR.UTF-8"); header('Content-Type: text/html; charset=UTF-8') @endphp
{{ $user->civilite }} {{ $user->prenom }} {{ $user->nom }}, <br />
{{ $canceler->prenom }} {{ $canceler->nom }} a annulé la formation {{ $formation->titre }}. <br />
Veuillez le contacter pour comprendre quelles sont les raisons qui ont ammené à cette décision soudaine. <br />
@endcomponent

Nous vous souhaitons tout de même une excellente journée,<br />
L' équipe Stylimmo.
{{-- {{ config('app.name') }} --}}
@endcomponent