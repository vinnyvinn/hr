@component('mail::message')
    Hi PJ, {{$user->first_name .' '.$user->last_name}} has applied travel plan.Kindly Approve.
    @component('mail::button', ['url' => url($url)])
        View Details
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
