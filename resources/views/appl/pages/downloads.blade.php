@extends('layouts.app')
@section('title', 'Privacy Policy | First Academy')
@section('description', 'Our free Material on GRE and IELTS is best in class. You can download pool of arguments, pool of topics, gre important words all for free.')
@section('keywords', 'gre word list, gre important words, pool of arguments for gre,download pool of arguments, download pool of topics')
@section('content')

<div class="bg-white">
<div class="card-body p-4 p-md-5 ">
  <h1>Downloads</h1>
  <p>Free downloads of our updated and acclaimed in house material. Free material for IELTS, GRE and English Learning.</p>
  <br>

  <div class="row">
    <div class="col-12 col-md-6 col-lg-4">
      <div class="card mb-4" >
        <div class="card-body">
          <img src="{{ asset('images/general/gre_important_words.png') }}" class="w-100 mb-4"/>
          <h5 class="card-title"><b>GRE Important Words</b></h5>
          <h6 class="card-subtitle mb-2 text-muted">PDF Document</h6>
          <p class="card-text">Studying for the GRE Verbal? Supercharge your prep with our vocabulary list, with the most important GRE words to learn.</p>
          @if(!\auth::user())
          <a href="#" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-lg">Download</a>
          @else
          <a href="https://www.dropbox.com/s/ip01jos40wn9a7s/GRE%20Word%20List%20Set%201%20-%204.zip" class="btn btn-primary btn-lg">Download</a>
          @endif
        </div>
      </div>
    </div>
    <div class="col-12 col-md-6 col-lg-4">
      <div class="card mb-4" >
        <div class="card-body">
          <img src="{{ asset('images/general/pool_of_issue_topics.png') }}" class="w-100 mb-4"/>
          <h5 class="card-title"><b>Pool of Issue Topics</b></h5>
          <h6 class="card-subtitle mb-2 text-muted">PDF Document</h6>
          <p class="card-text">This document contains the Issue topics for the Analytical Writing section of the GRE revised General Test.</p>
          @if(!\auth::user())
          <a href="#" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-lg">Download</a>
          @else
          <a href="https://www.dropbox.com/s/s1hqagztlawencp/Pool%20of%20Issue%20Topics.pdf" class="btn btn-primary btn-lg">Download</a>
          @endif
        </div>
      </div>
    </div>
    <div class="col-12 col-md-6 col-lg-4">
      <div class="card mb-4" >
        <div class="card-body">
          <img src="{{ asset('images/general/pool_of_argument_topics.png') }}" class="w-100 mb-4"/>
          <h5 class="card-title"><b>Pool of Argument Topics</b></h5>
          <h6 class="card-subtitle mb-2 text-muted">PDF Document</h6>
          <p class="card-text">This document contains the Argument topics for the Analytical Writing section of the GRE revised General Test.</p>
          @if(!\auth::user())
          <a href="#" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-lg">Download</a>
          @else
          <a href="https://www.dropbox.com/s/6tf8a4cpm5efias/Pool%20of%20Argument%20Topics.pdf" class="btn btn-primary btn-lg">Download</a>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
</div>

  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Kindly login to download the document.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
        
        <a href="{{route('login')}}" class="btn btn-success ">Login</a>
          
      </div>
    </div>
  </div>
</div>
@endsection
