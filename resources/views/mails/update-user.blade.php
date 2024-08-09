@component('mail::message')
# Account updated

An admin's just updated infomation in your account, click button below to go over profile change

@component('mail::button', ['url' => route('profile.edit')])
Profile
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
