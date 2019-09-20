@component('mail::message')
<b>{{$message['name']}}</b> has reported an error.<br>

<hr>
<u>Question Number:</u> {{ $message['qno'] }}<br><br>
<u>Details:</u> <br>{{ $message['details'] }}


@endcomponent