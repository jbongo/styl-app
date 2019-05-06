
@component('mail::message')
# Désinscription à une formation

@component('mail::panel')
@php setlocale(LC_TIME, "fr_FR.UTF-8"); header('Content-Type: text/html; charset=UTF-8') @endphp
{{ $usr->civilite }} {{ $usr->prenom }} {{ $usr->nom }}, <br />
Votre désinscription à la formation {{ $formation->titre }} a bien été prise en compte.
@endcomponent

Cordialement,<br>
L' équipe Stylimmo.
{{-- {{ config('app.name') }} --}}
@endcomponent