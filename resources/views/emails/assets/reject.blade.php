@component('mail::message')
# Asset Request Rejected

Hi {{$user->first_name .' '.$user->last_name}}, {{$message}}



Thanks,<br>
{{ config('app.name') }}
@endcomponent
