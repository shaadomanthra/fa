@component('mail::message')
<b>{{$message['name']}}</b> has sent a message<br>

<hr>
{{ $message['message'] }}


@endcomponent
