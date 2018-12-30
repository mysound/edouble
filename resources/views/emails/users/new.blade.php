@component('mail::message')
Thank You For Registering

Login: {{ $user->email }}<br>
Password: {{ $random_pas }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
