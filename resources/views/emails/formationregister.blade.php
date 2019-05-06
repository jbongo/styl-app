@component('mail::message')
# Inscription à une formation

@component('mail::panel')
@php setlocale(LC_TIME, "fr_FR.UTF-8"); header('Content-Type: text/html; charset=UTF-8') @endphp
{{ $usr->civilite }} {{ $usr->prenom }} {{ $usr->nom }}, <br />
Votre inscription à la formation {{ $formation->titre }} a bien été prise en compte. <br />
Rendez-vous à {{$formation->lieu}} ( {{ $formation->postal }} ) , {{ $formation->st }} le {{ strftime("%a %d %B", strtotime($formation->starting_date)) }} à {{ strftime("%H:%M", strtotime($formation->starting_date)) }}
@endcomponent

A bientôt,<br />
L' équipe Stylimmo.
{{-- {{ config('app.name') }} --}}
@endcomponent