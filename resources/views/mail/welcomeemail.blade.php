@component('mail::message')
Hi {{$user['name']}},<br>

<h3>Welcome aboard.</h3>
We’re excited you're joining us! First Academy is the Platinum Partner of British Council. We are the most awarded training institute in South India. We have the most awesome classes on this side of the solar system.

@component('mail::button', ['url' => url('/') ])
Get started now !
@endcomponent


Thanks,<br>
First Academy
@endcomponent
