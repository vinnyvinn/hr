@component('mail::message')
# Introduction

Hi PJ, a new document has been created by {{$data->first_name .' '.$data->last_name}}, to view click here {{url('all-documents')}}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
