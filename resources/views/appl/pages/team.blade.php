@extends('layouts.app')
@section('title', 'Our Team | First Academy')
@section('content')


<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto ">
  <h1 class="display-4 text-center mb-5">Our Team</h1>
  
  <div class="row">
  	<div class="col-12 col-md-3">
  		<div class="card mb-3" style="">
  			<img src="{{ asset('images/team/sahithy.jpg')}}" class="card-img-top" alt="...">
  			<div class="card-body">
  				<h4 class="card-title"><b>Sahithy</b></h4>
  				<p class="card-text">Our raison d’être. There would be no First Academy without her. She is the soul of the organisation and beyond any doubt the hardest working member of the team. She is our IELTS trainer. Our reviews say enough about her, but there is always more that can be said, but for that, we would have to invent words!.</p>
  			</div>
  		</div>
  	</div>

  	<div class="col-12 col-md-3">
  		<div class="card mb-3" style="">
  			<img src="{{ asset('images/team/teju.jpg')}}" class="card-img-top" alt="...">
  			<div class="card-body">
  				<h4 class="card-title"><b>Teju</b></h4>
  				<p class="card-text">Our answer to Murphy’s law is Teju – the miracle maker. When the whole world turns to God in distress, we turn to Teju. What in all companies is achieved by a lot of teams working very hard, is achieved in First Academy very casually by Teju. He is our marketing team, our designing team, technology team, content developing team, web support and much more. The Multi-talented, humorous, charming, social-media-avoiding Teju.</p>
  			</div>
  		</div>
  	</div>

  	<div class="col-12 col-md-3">
  		<div class="card mb-3" style="">
  			<img src="{{ asset('images/team/bharathi.jpg')}}" class="card-img-top" alt="...">
  			<div class="card-body">
  				<h4 class="card-title"><b>Bharathi</b></h4>
  				<p class="card-text">The resident polyglot who can switch between Marathi, Tamil, Telugu, Hindi, and heaven-know-what-else, she is the kindest, sweetest, and in many instances the most hilariously, gullible person one would have the good fortune of ever coming across. A firm believer in being blind to the bad side of everyone, she is loved by all, and for good reason!</p>
  			</div>
  		</div>
  	</div>

  		<div class="col-12 col-md-3">
  		<div class="card mb-3" style="">
  			<img src="{{ asset('images/team/bhanu.jpg')}}" class="card-img-top" alt="...">
  			<div class="card-body">
  				<h4 class="card-title"><b>Bhanu</b></h4>
  				<p class="card-text">Being on time and frequently brining awesome food to office are two of the many things we love about Bhanu. Pleasant, professional, email-juggling, and Friday-fasting; the workplace wouldn’t be the same without her. Do we love her, or the food she makes? None of us wants to hazard answering that!</p>
  			</div>
  		</div>
  	</div>

  	<div class="col-12 col-md-3">
  		<div class="card mb-3" style="">
  			<img src="{{ asset('images/team/divya.jpg')}}" class="card-img-top" alt="...">
  			<div class="card-body">
  				<h4 class="card-title"><b>Divya</b></h4>
  				<p class="card-text">Divya is the girl who cares. About our students, about staff, and about getting work done, and sometimes getting worked-up too! The ‘kid’ in the workplace; she is – the subject of most jokes, lover of dogs, adorer of pups, and a devotee of the chrome mode in the iPhone. If someone were to be voted the most approachable, it would be her, hands down.</p>
  			</div>
  		</div>
  	</div>

  	<div class="col-12 col-md-3">
  		<div class="card mb-3" style="">
  			<img src="{{ asset('images/team/ram.jpg')}}" class="card-img-top" alt="...">
  			<div class="card-body">
  				<h4 class="card-title"><b>Ram</b></h4>
  				<p class="card-text">The oil to First Academy’s machine. With the possible exception of handling the sessions, there is little that Ram doesn’t know or can’t do. Dedicated, devoted, and absolutely trust worthy and easily the most loved and the most depended upon member of our family. Truly, రాముడు చాలా మంచి బాలుడు. बेमिसाल राम्!</p>
  			</div>
  		</div>
  	</div>

  </div>
</div>

@endsection
