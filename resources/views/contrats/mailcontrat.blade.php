@component('mail::message')
Bonjour {{$user->prenom}} {{$user->nom}}

Votre contrat de mandataire a été créé sur Stylimmo. vous pouvez desormais le 
télécharger à partir de votre espace sur l'application, si vous n'etes pas
encore inscrit au registre spécial des agents commerçiaux (RSAC), nous vous invitons à le faire pour activer votre compte définitivement.

@component('mail::button', ['url' => config('app.url')])
Je télécharge mon contrat
@endcomponent

@component('mail::panel')

Une fois votre inscription au RSAC effectuée et avoir contracté une assurance de résponsabilité civile professionnelle, vous devez nous retourner depuis votre espace sur l'application les informations et les pieces
jointes prouvants cette inscription, une fois les informations validées, l'annexe 5 sera ajouté à votre contrat et vous pouvez proceder à la mise en ligne et la signature de celui ci
et votre inscription sur notre réseau en tant que mandataire sera definitive et vous pourrez commencer à exercer.
@endcomponent

Cordialement,<br>
{{ config('app.name') }}
@endcomponent