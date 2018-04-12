@component('mail::message')
Hi {{$name . ' '. $surname}}<br>

You have been invited to join a team on orbit. Please accept the invite by clicking the button below.<br>

@component('mail::button', ['url' => $url,'color'=>'green'])
 Accept Invite
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
