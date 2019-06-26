@component('mail::message')
    # Approve Leave

    Hi PJ, {{$asset->user->first_name .' '.$asset->user->last_name}} Requested {{$asset->asset->asset_type->name.'/'.$asset->asset->make.'/'.$asset->asset->model}} on {{$date}} Kindly visit {{url($url)}} to approve.


    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
