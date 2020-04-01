@extends('layouts.front')
@section('title', 'First Academy - The best practice tests for IELTS | OET and other tests')
@section('description', 'Take a free IELTS | OET test completely free. Full-length OET practice test for free! Free IELTS writing band scores. Test your vocabulary for OET and IELTS.')
@section('keywords', 'IELTS Practice Test, OET Practice Online, OET Online Training, Vocabulary for IELTS, Vocabulary for OET')
@section('content')
<style>
.element a{ color:white; text-decoration: underline;text-decoration-color:#71bce2;}

.topbar{
  background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
  background-size: 400% 400%;
  animation: gradient 15s ease infinite;
}

@keyframes gradient {
  0% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 100% 50%;
  }
  100% {
    background-position: 0% 50%;
  }
}

</style>
<div class="topbar" style="  "> 
<div class="container ">
    <div class="row p-3 p-md-0">
        <div class="col-12 ">
            <div class="p-3 p-md-5"></div>
    <div class="heading1  text-center" style="color:#fff;font-family: 'Montserrat', sans-serif;font-weight: 900;line-height: 1.2;font-size:80px">
    The time to be awesome<br> has come
    </div>
    <div class="heading1  mb-4 mt-3 text-center" style="color:#fff;font-family: 'Montserrat';font-size:60px;font-weight: 500;">
   Get <span class="element" style="color: white"></span> 
    </div>

   
   <div class="p-5"></div>
     </div>
       
    </div>
</div>
</div>
<div class="pr-0 pl-0 pt-4 pb-4 pt-md-5 pb-md-5 " style="background: #30b3a9">
 sample
</div>

<div class="pr-0 pl-0 pt-4 pb-4 pt-md-4 pb-md-3 bg-white">
  @include('blocks.popular_ielts')
</div>
<div class="pr-0 pl-0 pt-4 pb-4 pt-md-5 pb-md-2" style="background: #f3fbff">
  @include('blocks.free_listening_tests')
</div>
<div class="pr-0 pl-0 pt-4 pb-4 pt-md-5 pb-md-2">
  @include('blocks.free_reading_tests')
</div>
<div class="pr-2 pl-2 pt-4 pb-4 " style="background: #f3fbff">
  @include('blocks.experience_best')
</div>






</script> 

@endsection