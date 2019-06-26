@component('mail::message')
    Hi {{$manager->first_name.' '.$manager->last_name}}, {{$user_data->first_name .' '.$user_data->last_name}} applied leave on {{$date}} Kindly approve.
    @component('mail::button', ['url' => url($url)])
        View Details
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
