@component('mail::message')
# Hi First Academy! <br>

{{$form['name'] }}has filled a request form in the website prep.firstacademy.in
<hr>
Name : {{$form['name']}}<br>
Email : {{$form['email']}}<br>
Phone : {{$form['phone']}}<br>
College : {{$form['college']}}<br>
Year of Passing : {{$form['year']}}<br>
Subject : {{$form['subject']}}<br>
Description : {{$form['description']}}<br>


@endcomponent
