@component('mail::message')
    Hi {{$user_data->first_name .' '.$user_data->last_name}} Your leave has been rejected.
    @component('mail::button', ['url' => url($url)])
        View Details
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent