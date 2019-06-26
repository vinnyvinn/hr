@component('mail::message')
  Hi {{$username}} Your travel plan has been approved.
    @component('mail::button', ['url' => url($url)])
      View Details
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
