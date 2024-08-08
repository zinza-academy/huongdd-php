@component('mail::message')
# Account created

An admin's just update your post, click button below to login:

@component('mail::button', ['url' => route('login')])
See post
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
