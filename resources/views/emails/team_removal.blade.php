@component('mail::message')
Hi {{$name . ' ' . $surname}},<br>

You have been unsubscribed from team {{$team_name}}. Contact your manager for any querries.


Thanks,<br>
{{ config('app.name') }}
@endcomponent
