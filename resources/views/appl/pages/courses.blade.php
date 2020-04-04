@extends('layouts.bg')
@section('title', 'Courses | First Academy')
@section('content')


<div class="container">
<div class="px-3 px-md-0 pt-md-5 pb-md-4  mx-auto ">
  <h1 class="display-4 mb-3 mb-md-5 bborder " >Courses</h1>
    <div class="row">
<div class="col-12 col-md-9">

  <div class="row">
  	<div class="col-12 col-md-4">
  		<div class="card mb-3" style="">
  			<img src="{{ asset('images/courses/oet.gif')}}" class="card-img-top" alt="OET Course">
  			<div class="card-body">
  				<h4 class="card-title"><i class="fa fa-thumbs-o-up"></i> <b>OET</b></h4>
          <hr>
  				<p class="card-text">OET is the newest and the most specialised kid on the block. It is an English test aimed squarely at the medical professional. It is gaining wide acceptance and fast. If you are a medical professional and want to work in an English speaking country, the chances are, you are required to take the OET test.</p>
          <a href="" class="btn btn-success">READ MORE <i class="fa fa-angle-right"></i></a>
  			</div>
  		</div>
  	</div>

  	<div class="col-12 col-md-4">
  		<div class="card mb-3" style="">
  			<img src="{{ asset('images/courses/sat.jpg')}}" class="card-img-top" alt="SAT Course">
  			<div class="card-body">
  				<h4 class="card-title"><i class="fa fa-thumbs-o-up"></i> <b>SAT</b></h4>
          <hr>
  				<p class="card-text">Our SAT students get ridiculously high scores, without sweating it out. Why? Attend our sessions and you will understand the magic our trainers can weave!</p>
          <a href="" class="btn btn-success">READ MORE <i class="fa fa-angle-right"></i></a>
  			</div>
  		</div>
  	</div>

  	<div class="col-12 col-md-4">
  		<div class="card mb-3" style="">
  			<img src="{{ asset('images/courses/gre.gif')}}" class="card-img-top" alt="GRE Course">
  			<div class="card-body">
  				<h4 class="card-title"><i class="fa fa-thumbs-o-up"></i> <b>GRE</b></h4>
          <hr>
  				<p class="card-text">Did you know that our GRE students get phenomenally high scores, without sweating it out to learn vocabulary? Surprised? Attend our sessions and you will be amazed at how much fun GRE can be!</p>
           <a href="" class="btn btn-success">READ MORE <i class="fa fa-angle-right"></i></a>
  			</div>
  		</div>
  	</div>

    <div class="col-12 col-md-4">
      <div class="card mb-3" style="">
        <img src="{{ asset('images/courses/ielts.gif')}}" class="card-img-top" alt="IELTS Course">
        <div class="card-body">
          <h4 class="card-title"><i class="fa fa-thumbs-o-up"></i> <b>IELTS</b></h4>
          <hr>
          <p class="card-text">Many say IELTS is a difficult test. There is very little truth in that. If using English is not a challenge, you might not even need to take training. Read more to know how we can help you decide!</p>
           <a href="" class="btn btn-success">READ MORE <i class="fa fa-angle-right"></i></a>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-4">
      <div class="card mb-3" style="">
        <img src="{{ asset('images/courses/pte.gif')}}" class="card-img-top" alt="PTE Course">
        <div class="card-body">
          <h4 class="card-title"><i class="fa fa-thumbs-o-up"></i> <b>PTE</b></h4>
          <hr>
          <p class="card-text">Many say PTE is a difficult test. There is little truth in that. PTE is tricky than it is difficult. Understanding the pattern and the purpose of the questions is what will make all the difference. Our sessions focus on helping you understand how you are scored so you know how to respond!</p>
           <a href="" class="btn btn-success">READ MORE <i class="fa fa-angle-right"></i></a>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-4">
      <div class="card mb-3" style="">
        <img src="{{ asset('images/courses/ielts-online.gif')}}" class="card-img-top" alt="IELTS Online Course">
        <div class="card-body">
          <h4 class="card-title" style="line-height: 1.4;"><i class="fa fa-thumbs-o-up"></i> <b>IELTS Personalised and Online Training</b></h4>
          <hr>
          <p class="card-text">Our training customised to suit your needs. Completely personalised training for IELTS. Whether it is online or one-to-one training!</p>
           <a href="" class="btn btn-success">READ MORE <i class="fa fa-angle-right"></i></a>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-4">
      <div class="card mb-3" style="">
        <img src="{{ asset('images/courses/pte-online.gif')}}" class="card-img-top" alt="PTE Online Course">
        <div class="card-body">
          <h4 class="card-title" style="line-height: 1.4;"><i class="fa fa-thumbs-o-up"></i> <b>PTE Personalised and Online Training</b></h4>
          <hr>
          <p class="card-text">Looking for personalised training or online coaching for any PTE exam ?</p>
           <a href="" class="btn btn-success">READ MORE <i class="fa fa-angle-right"></i></a>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-4">
      <div class="card mb-3" style="">
        <img src="{{ asset('images/courses/toefl.gif')}}" class="card-img-top" alt="PTE Online Course">
        <div class="card-body">
          <h4 class="card-title" ><i class="fa fa-thumbs-o-up"></i> <b>TOEFL</b></h4>
          <hr>
          <p class="card-text">The best coaching for TOEFL – the once, most popular test of English. Small batch sizes, convenient timings, and our excellent trainers make our TOEFL sessions top notch.</p>
           <a href="" class="btn btn-success">READ MORE <i class="fa fa-angle-right"></i></a>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-4">
      <div class="card mb-3" style="">
        <img src="{{ asset('images/courses/corporate.gif')}}" class="card-img-top" alt="Corporate Course">
        <div class="card-body">
          <h4 class="card-title" style="line-height: 1.4;"><i class="fa fa-thumbs-o-up"></i> <b>Corporate | Personalised | Online</b></h4>
          <hr>
          <p class="card-text">Looking for personalised training or online coaching for any English exam or looking for Corporate training for your employees?</p>
           <a href="" class="btn btn-success">READ MORE <i class="fa fa-angle-right"></i></a>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-4">
      <div class="card mb-3" style="">
        <img src="{{ asset('images/courses/english.gif')}}" class="card-img-top" alt="Corporate Course">
        <div class="card-body">
          <h4 class="card-title" style="line-height: 1.4;" ><i class="fa fa-thumbs-o-up"></i> <b>English Language Training</b></h4>
          <hr>
          <p class="card-text">English really made easy. Attend a session. Small batches, comfortable atmosphere, stress free session. Enjoy learning!</p>
           <a href="" class="btn btn-success">READ MORE <i class="fa fa-angle-right"></i></a>
        </div>
      </div>
    </div>



  </div>

</div>
  <div class="col-12 col-md-3">

    <div class='item mb-3'>
      <div class="p-4 bg-p" style="color:#8d6cc4;background-color:#8d6cc4 ;background-image: url({{asset('images/colors/dust.png')}})">
        <div class="text">
          Study from anywhere
        </div>

      </div>
      <div class="text-link p-4" style="background-color:#f55e3d;">
        Online Training
      </div>
      <div class="p-1 bg-p" style="color:#8d6cc4;background-color:#8d6cc4 ;background-image: url({{asset('images/colors/dust.png')}})">
      </div>
    </div>

    <div class='item mb-3'>
      <div class="p-4 bg-p" style="color:#8d6cc4;background-color:#5ac59b ;background-image: url({{asset('images/colors/dots.png')}});">
        <div class="text">
          Want to ace OET?
        </div>

      </div>
      <div class="text-link p-4" style="background-color:#031327">
        BUY OET READING TESTS
      </div>
      <div class="p-1 bg-p" style="color:#8d6cc4;background-color:#5ac59b;background-image: url({{asset('images/colors/dots.png')}})">
      </div>
    </div>

    <div class='item mb-3'>
      <div class="p-4 bg-p" style="color:#8d6cc4;background-color:#f4cb13 ;background-image: url({{asset('images/colors/star.png')}});">
        <div class="text">
          Want to experience awesomeness?
        </div>

      </div>
      <div class="text-link p-4" style="background-color:#463d12">
        Attend a demo
      </div>
      <div class="p-1 bg-p" style="color:#8d6cc4;background-color:#f4cb13;background-image: url({{asset('images/colors/star.png')}})">
      </div>
    </div>

    <div class='item mb-3'>
      <div class="p-4 bg-p" style="color:#8d6cc4;background-color:#4ac8ed ;background-image: url({{asset('images/colors/cross.png')}});">
        <div class="text">
          Crack SSC CGL this year
        </div>

      </div>
      <div class="text-link p-4" style="background-color:#0b466e">
        GET OUT BOOK
      </div>
      <div class="p-1 bg-p" style="color:#8d6cc4;background-color:#4ac8ed;background-image: url({{asset('images/colors/cross.png')}})">
      </div>
    </div>

    <div class='item mb-3'>
      <div class="p-4 bg-p" style="color:#8d6cc4;background-color:#e33062 ;background-image: url({{asset('images/colors/dust.png')}});">
        <div class="text">
          Experience the test without all the stress?
        </div>

      </div>
      <div class="text-link p-4" style="background-color:#3c242b">
        Take a free test
      </div>
      <div class="p-1 bg-p" style="color:#8d6cc4;background-color:#e33062;background-image: url({{asset('images/colors/dust.png')}})">
      </div>
    </div>


</div>

</div>

</div>
</div>
<div class='p-4 bg-green' >
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-10">
        <div class="h3 mb-0 text-white fw-800" >Hear what our students say about our courses</div>
      </div>
      <div class="col-12 col-md-2">
        <a href="{{ route('reviews.page')}}" class="btn btn-light"><i class="fa fa-thumbs-o-up pr-2"></i> View Reviews</a>
      </div>
    </div>
  </div>
</div>

@endsection
