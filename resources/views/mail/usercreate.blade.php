
@component('mail::message')
# Hi {{$user['name']}}!, Welcome to First Academy.

Your account details are as follows <br>

@component('mail::panel')
Email : {{$user['email']}} <br>
Password : {{$user['password_string']}}<br>
Website : {{ url('/') }}<br>
@endcomponent

Thanks,<br>
First Academy
@endcomponent
