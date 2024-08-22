@component('mail::message')
# Account created

An admin's just created an account for you, click button below to login <br>
Email : {{$username}} <br>
Password: {{$password}} <br>

After logging in, you should change you pasword!
@component('mail::button', ['url' => route('profile.edit')])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
