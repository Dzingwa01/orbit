@component('mail::message')

Hi {{$name . ' ' . $surname}},

You have been invited to join MiShift. Your team members are waiting for you to join them. Click the button below to
activate your account.

Your default generated password are as below:<br>
Username:{{$user_name}} <br>
Password: {{$password}}

@component('mail::button', ['url' => $url,'color'=>'green'])
    Verify Account
    @endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
