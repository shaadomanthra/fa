@component('mail::message')
Hi {{$user['name']}},<br>

To complete your sign up, please verify your email:

@component('mail::button', ['url' =>  route('email.verify',$user['activation_token']).'?email='.$user['email']])
Verify Email
@endcomponent

Or visit this link:<br>
<a href="{{ route('email.verify',$user['activation_token']) }}?email={{$user['email']}}">
 {{ route('email.verify',$user['activation_token']) }}?email={{$user['email']}}
</a>

Thanks,<br>
First Academy
@endcomponent
