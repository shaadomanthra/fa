@extends('layouts.front')
@section('title', 'First Academy - The best practice tests for IELTS | OET and other tests')
@section('description', 'Take a free IELTS | OET test completely free. Full-length OET practice test for free! Free IELTS writing band scores. Test your vocabulary for OET and IELTS.')
@section('keywords', 'IELTS Practice Test, OET Practice Online, OET Online Training, Vocabulary for IELTS, Vocabulary for OET')
@section('content')

<div class="@if(request()->get('n')==1) topbar1 @else topbar @endif" style="  "> 
<div class="container ">
    <div class="row p-3 p-md-0">
        <div class="col-12 ">
            <div class="p-3 p-md-5"></div>
    <div class="heading_one  text-center" >
    The time to be awesome<br> has come
    </div>
    <div class="heading_two  mb-4 mt-3 text-center" >
   Get <span class="element" ></span> 
    </div>

   
   <div class="p-2 p-md-5"></div>
     </div>
       
    </div>
</div>
</div>
<div class="pr-0 pl-0 pt-4 pb-4 pt-md-3 pb-md-3 mb-3" style="background: #64c293">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-6">
        <div class="heading_one text-center text-md-left mt-1 mb-3  mb-md-0" style="font-weight: 500;font-size:30px">
      Attend a free session
    </div>

      </div>
      <div class="col-12 col-md-6">

    
    <div class="text-center pb-2 pb-md-0 float-md-right">
    <button class="btn  btn-lg float-center float-md-right  h5 mb-0 " style="background: #fff"><i class="fa fa-ioxhost"></i> &nbsp;Take a free test  </button>
  </div>
    <div class="text-center float-md-right">
    <button class="btn  btn-lg   h5 mb-0 text-white mr-md-3" style="background: #2d4059;">Choose a slot &nbsp; <i class="fa fa-angle-right"></i></button>
  </div>
      </div>
    </div>
    
  </div>
 
</div>

<div class="pr-0 pl-0 pt-4 pb-4 pt-md-4 pb-md-3 bg-white mb-3">
  <div class="container">
    <div class="row">
        <div class="col-12 col-md-3">
          <img src="{{ asset('images/front/course.png')}}" style="width:50px"/>
          <h4 class="mt-3 text-primary">Our Courses</h4>
          <p>Take a look at all the courses we offer. The best coaching, the timings, the courses. Start here if you are yet to take tests related to studying abroad.</p>
        </div>

         <div class="col-12 col-md-3">
          <img src="{{ asset('images/general/interview.png')}}" style="width:50px"/>
          <h4 class="mt-3 text-primary">Personalised Coaching</h4>
          <p>If you want to be trained personally, or online or if you want to attend only a part of the training, we can help. Do contact us!</p>
        </div>
        <div class="col-12 col-md-3">
          <img src="{{ asset('images/page/grade.png')}}" style="width:50px"/>
          <h4 class="mt-3 text-primary">Our Scores</h4>
          <p>Our students have made us really happy with some incredible scores. Take a look at some our scores. There a lot more that we couldn’t display here!</p>
        </div>

        <div class="col-12 col-md-3">
          <img src="{{ asset('images/front/love.png')}}" style="width:50px"/>
          <h4 class="mt-3 text-primary">People love us</h4>
          <p>We love our students and our students love us back. Look at our reviews and see what they have to say about us!</p>
        </div>
    </div>
  </div>
</div>
<div class="pr-0 pl-0 pt-4 pb-4 pt-md-5 pb-md-5 " style="background: #f3fbff">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-3 text-center text-md-left mb-3 mb-md-0">
        <div class="heading1 counter " style="font-size:50px">25,000</div> students and counting
      </div>
      <div class="col-12 col-md-3 text-center text-md-left mb-3 mb-md-0">
        <div class="heading1 counter" style="font-size:50px">32</div> awards and
counting
      </div>
      <div class="col-12 col-md-3 text-center text-md-left mb-3 mb-md-0">
        <div class="heading1 counter" style="font-size:50px">400</div> Top Universities
worldwide
      </div>
      <div class="col-12 col-md-3 text-center text-md-left mb-3 mb-md-0">
        <span class="heading1 counter" style="font-size:50px">100</span><span class="heading1 " style="font-size:50px">%</span>  <br>satisfied
clients
      </div>
    </div>
    
  </div>
  
</div>

<div class="pr-0 pl-0 pt-4 pb-4 pt-md-5 pb-md-5 bg-white mb-3">
  <div class="container">
    <h2 class="mb-3"><b>Our Story</b></h2>
    <div class="row">
        <div class="col-12 col-md-5 mb-4 mb-md-0">
          <div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/QNr-147tmv8?showinfo=0" allowfullscreen></iframe>
</div>
        </div>
        <div class="col-12 col-md-7">
          <p>In 2001 two individuals with the experience of having studied and worked in the USA decided to make it easy for students in India to have access to unbiased information about international education.</p>
          <p>The two member team has now evolved into a cohesive cohort of people from different cultural backgrounds speaking several languages, who understand the importance of cross-cultural sensitivity. This has contributed towards our continued growth and staggering levels of customer satisfaction.</p>
          <p class="text-success h4" style="line-height: 1.4">If diversity were the measure of team quality, First Academy would be the industry leader.</p>
        </div>
    </div>
  </div>
</div>

<div class="pr-0 pl-0 pt-4 pb-4 pt-md-5 pb-md-5 " style="background: #f3fbff">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-6">
        <div class="heading_one text-center text-md-left mt-1 mb-4 mb-md-0" style="font-weight: 500;font-size:30px;color:#2e3135">
      Want to change the world
    </div>

      </div>
      <div class="col-12 col-md-6">
          <div class="text-center float-md-right">
    <button class="btn  btn-lg   h5 mb-0 text-white mr-md-3" style="background: #2d4059;">Contact Us &nbsp; <i class="fa fa-angle-right"></i></button>
  </div>
      </div>
    </div>
    
    
    
  </div>
</div>







@endsection