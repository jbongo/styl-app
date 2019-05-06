@component('mail::message')
# Annulation d' une formation

@component('mail::panel')
@php setlocale(LC_TIME, "fr_FR.UTF-8"); header('Content-Type: text/html; charset=UTF-8') @endphp
{{ $me->civilite }} {{ $me->prenom }} {{ $me->nom }}, <br />
Vous avez modifier le lieu de la formation {{ $formation->titre }} pour {{$formation->lieu}} ( {{ $formation->postal }} ) , {{ $formation->st }}, <br />
Merci de rapporter les raisons pour lesquelles vous avez prit cette décision. <br />
@endcomponent

Nous vous souhaitons une excellente journée,<br />
L' équipe Stylimmo.
{{-- {{ config('app.name') }} --}}
@endcomponent