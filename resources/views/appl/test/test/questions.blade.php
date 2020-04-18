@extends('layouts.bg')

@section('title', 'Question List | First Academy')
@section('description', 'Take a free IELTS | OET test completely free. Full-length OET practice test for free! Free IELTS writing band scores. Test your vocabulary for OET and IELTS.')

@section('content')

<div class="bg-white py-2 mb-4">
<div class="container">
<nav >
 <ol class="breadcrumb bg-white p-0 py-2">
   <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin')}}">Admin</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/test')}}">Test</a></li>
    <li class="breadcrumb-item"><a href="{{ route('test.show',$test->id)}}">{{$test->name}}</a></li>
    <li class="breadcrumb-item">Questions</li>
  </ol>
</nav>

<div class="mb-3">

          <p class="h2 d-inline"><i class="fa fa-bars"></i>  Questions ({{count($data)}})
           
          

          <div class="btn float-right mt-0 pt-0" role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Create
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
      <a class="dropdown-item" href="{{ route('mcq.create',$test->id)}}">MCQ</a>
      <a class="dropdown-item" href="{{ route('fillup.create',$test->id)}}">Fillup</a>
    </div>
  </div>


          <form class="form-inline float-right" method="GET" action="{{ route('test.questions',$test->id) }}">


            
            <div class="input-group ">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-search"></i></div>
              </div>
              <input class="form-control " id="search" name="item" autocomplete="off" type="search" placeholder="Search" aria-label="Search" 
              value="{{Request::get('item')?Request::get('item'):'' }}">
            </div>
            
          </form>
          </p>
         

</div>

</div>
</div>


<div class="container">

<div  class="row ">
  @include('flash::message')
  <div class="col-12 col-md-10">
 
    <div class="card mb-3 mb-md-0">
      <div class="card-body mb-0">
        

        <div id="search-items">
         @include('appl.test.test.qlist')
       </div>

     </div>
   </div>
 </div>

  <div class="col-12 col-md-2">
      @include('appl.test.snippets.menu')
    </div>
 
</div>
</div>

@endsection


