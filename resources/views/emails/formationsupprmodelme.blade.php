@component('mail::message')
# Suppression d' un modèle de formation

@component('mail::panel')
@php setlocale(LC_TIME, "fr_FR.UTF-8"); header('Content-Type: text/html; charset=UTF-8') @endphp
{{ $me->civilite }} {{ $me->prenom }} {{ $me->nom }}, <br />
La modification du modèle de {{ $formation->titre }} a bien été prise en compte. <br />
Veuillez contacter un administrateur pour expliquer cette décision. <br />
@endcomponent

Nous vous souhaitons une excellente journée,<br />
L' équipe Stylimmo.
{{-- {{ config('app.name') }} --}}
@endcomponent