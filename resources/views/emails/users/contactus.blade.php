@component('mail::message')
# This message was sent from the contact form
<br>
User name: {{ $name }}<br>
Email address: {{ $email_address }}<br><br>
{{ $text }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
