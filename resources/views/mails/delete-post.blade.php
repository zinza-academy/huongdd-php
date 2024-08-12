@component('mail::message')
# Post deleted

Your post having title "{{$post->title}}" has been deleted by an admin

Thanks,<br>
{{ config('app.name') }}
@endcomponent
