@component('mail::message')
# Happy birthday
{{$today}} <br>
Today is your birthday. Best wish to you!!! <br>

Thank you for using our service, <b>{{$user->name}}</b><br>
{{ config('app.name') }}
@endcomponent
