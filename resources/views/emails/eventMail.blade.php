<x-mail::message>
# Introduction
Bonjour
The body of your message.
<p>Bonjour</p>
<p>Vous êtes invité à l'événement : {{ $eventName }} </p>

<p>{{ $eventDescription }}</p>

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
