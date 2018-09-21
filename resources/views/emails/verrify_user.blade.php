@component('mail::message')
Orbit Registration - Account Verification

Hi {{$name .'  '. $surname}},

You have been successfully registered with MiShift.
Please verify your account by clinking the link below.

@component('mail::button', ['url' => $url,'color'=>'green'])
Verify Account
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
