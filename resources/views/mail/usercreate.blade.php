
@component('mail::message')
# Hi {{$user['name']}}!

<h3>Welcome aboard.</h3>
<p>We’re excited you're joining us! First Academy is the Platinum Partner of British Council. We are the most awarded training institute in South India. We have the most awesome classes on this side of the solar system.
</p>

Your account details are as follows <br>

@component('mail::panel')
Email : {{$user['email']}} <br>
Password : {{$user['password_string']}}<br>
Website : {{ url('/') }}<br>
@endcomponent

Thanks,<br>
First Academy
@endcomponent
