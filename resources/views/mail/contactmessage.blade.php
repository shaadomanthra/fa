@component('mail::message')
<b>{{$message['name']}}</b> has sent a message<br>
<hr>
Email: {{$message['email']}}<br>
Phone: {{$message['phone']}}<br>
<hr>
<b>Message:</b><br>{{ $message['message'] }}


@endcomponent
