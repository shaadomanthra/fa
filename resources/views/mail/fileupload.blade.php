
@component('mail::message')
# {{$user['name']}} has uploaded a file.

Access the file at <br>

@component('mail::button', ['url' =>  route('file.index')])
View Files
@endcomponent

Thanks,<br>
First Academy
@endcomponent
