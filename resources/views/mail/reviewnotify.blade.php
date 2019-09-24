
@component('mail::message')
# Hi {{$user['name']}}! <br>

Greetings from First Academy!

Your Test ({{$test['name']}}) has been evaluated. You can access the test evaluation at <br>

@component('mail::button', ['url' =>  route('test.review',$test['slug']).'?user_id='.$user['id']])
Test Evaluation
@endcomponent

Thanks,<br>
First Academy
@endcomponent
