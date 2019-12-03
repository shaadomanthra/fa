@extends('layouts.app')
@include('meta.createedit')
@section('content')

@include('flash::message')
  <div class="card">
    <div class="card-body">

      @if($stub=='Create')
      <form method="post" action="{{route($app->module.'.store')}}" enctype="multipart/form-data">
      @else
      <form method="post" action="{{route($app->module.'.update',$obj->id)}}" enctype="multipart/form-data">
      @endif 
      <h1 class="p-3 border bg-light mb-3">
        @if($stub=='Create')
          Create {{ $app->module }}
        @else
          Update {{ $app->module }}
        @endif  

        <button type="submit" class="btn btn-outline-success float-right">Save</button>
       </h1>
      
      

      <div class="row">
        <div class="col-12 col-md-6">

          <div class="form-group">
            <label for="formGroupExampleInput "> Name</label>
            <input type="text" class="form-control" name="name" id="formGroupExampleInput" placeholder="Enter the Name" 
                @if($stub=='Create')
                value="{{ (old('name')) ? old('name') : '' }}"
                @else
                value = "{{ $obj->name }}"
                @endif
              >
          </div>

          <div class="form-group">
            <label for="formGroupExampleInput ">Email</label>
            <input type="text" class="form-control" name="email" id="formGroupExampleInput" placeholder="Enter the Email" 
                @if($stub=='Create')
                value="{{ (old('email')) ? old('email') : '' }}"
                @else
                value = "{{ $obj->email }}"
                @endif
              >
          </div>

           <div class="form-group">
              <label for="formGroupExampleInput ">Course</label>
              <select class="form-control" name="course">
                
                <option value="ielts" @if(isset($obj)) @if($obj->course=='ielts') selected @endif @endif >IELTS</option>
                <option value="gre" @if(isset($obj)) @if($obj->course=='gre') selected @endif  @endif >GRE</option>
                <option value="ielts-gre" @if(isset($obj)) @if($obj->course=='ielts-gre') selected @endif @endif >IELTS & GRE</option>
                <option value="pte" @if(isset($obj)) @if($obj->course=='pte') selected @endif @endif >PTE</option>
                <option value="oet" @if(isset($obj)) @if($obj->course=='oet') selected @endif @endif >OET</option>
              </select>
            </div>

            <div class="form-group">
              <label for="formGroupExampleInput ">Mode</label>
              <select class="form-control" name="mode">
                <option value="classroom" @if(isset($obj)) @if($obj->mode=='classroom') selected @endif @endif >Classroom</option>
                <option value="online" @if(isset($obj)) @if($obj->mode=='online') selected @endif  @endif >Online</option>
              </select>
            </div>

            <div class="form-group">
              <label for="formGroupExampleInput ">Module</label>
              <select class="form-control" name="module">
                <option value="full" @if(isset($obj)) @if($obj->module=='full') selected @endif @endif > Full </option>
                <option value="combo" @if(isset($obj)) @if($obj->module=='combo') selected @endif @endif > Combo </option>
                <option value="listening" @if(isset($obj)) @if($obj->module=='listening') selected @endif @endif >Listening</option>
                <option value="speaking" @if(isset($obj)) @if($obj->module=='speaking') selected @endif @endif >Speaking</option>
                <option value="reading" @if(isset($obj)) @if($obj->module=='reading') selected @endif @endif >Reading</option>
                <option value="writing" @if(isset($obj)) @if($obj->module=='writing') selected @endif @endif >Writing</option>
              </select>
            </div>

            <div class="form-group">
            <input type="hidden" class="form-control" name="contacted" id="formGroupExampleInput" placeholder="Enter the Email" value="1"
              >
          </div>

          <div class="form-group">
            <label for="formGroupExampleInput ">Counsellor</label>
            <select class="form-control" name="user_id">
              @foreach($employees as $emp)
              <option value="{{$emp->id}}" @if(isset($obj)) @if($obj->user_id==$emp->id) selected  @endif  @endif >{{$emp->name}}</option>
              @endforeach
             
            </select>
          </div>
  
          <div class="form-group">
            <label for="formGroupExampleInput ">Comment</label>
            <textarea class="form-control " name="comment"  rows="3">@if($stub=='Create'){{ (old('comment')) ? old('comment') : '' }}@else @if(isset($followup->comment)) {{ $followup->comment }}@endif @endif</textarea>
          </div>


        </div>
        <div class="col-12 col-md-6">
          

          <div class="form-group">
            <label for="formGroupExampleInput ">Phone</label>
            <input type="text" class="form-control" name="phone" id="formGroupExampleInput" placeholder="Enter the phone number" 
                @if($stub=='Create')
                value="{{ (old('phone')) ? old('phone') : '' }}"
                @else
                value = "{{ $obj->phone }}"
                @endif
              >
          </div>
          <div class="form-group">
              <label for="formGroupExampleInput ">Source</label>
              <select class="form-control" name="source">
                
                <option value="call" @if(isset($obj)) @if($obj->source=='call') selected @endif @endif > Call </option>
                <option value="walkin" @if(isset($obj)) @if($obj->source=='walkin') selected @endif @endif > Walk-in </option>
                <option value="google-search" @if(isset($obj)) @if($obj->source=='google-search') selected @endif @endif > Google Search </option>
                <option value="contact-form" @if(isset($obj)) @if($obj->source=='contact-form') selected @endif @endif > Contact Form </option>
                <option value="packetprep" @if(isset($obj)) @if($obj->source=='packetprep') selected @endif @endif > PacketPrep </option>
                <option value="email" @if(isset($obj)) @if($obj->source=='email') selected @endif @endif > email </option>
                <option value="other-consultancy" @if(isset($obj)) @if($obj->source=='other-consultancy') selected @endif @endif > Other Consultancy</option>
              </select>
            </div>

          <div class="form-group">
              <label for="formGroupExampleInput ">Batch</label>
              <select class="form-control" name="batch">
                <option value="weekend" @if(isset($obj)) @if($obj->batch=='weekend') selected @endif @endif >Weekend</option>
                <option value="weekday" @if(isset($obj)) @if($obj->batch=='weekday') selected @endif @endif >Weekday</option>
              </select>
            </div>

            <div class="form-group">
            <label for="formGroupExampleInput ">Stage</label>
            <select class="form-control" name="stage">
              <option value="enquiry" @if(isset($obj)) @if($obj->stage=="enquiry") selected @endif  @endif >Enquiry</option>
              <option value="demo" @if(isset($obj)) @if($obj->stage=="demo") selected @endif  @endif >Demo</option>
              <option value="enrolled" @if(isset($obj)) @if($obj->stage=="enrolled") selected  @endif  @endif >Enrolled </option>
            </select>
          </div>

          <div class="form-group">
            <label for="formGroupExampleInput ">Center</label>
            <select class="form-control" name="center">
              <option value="ameerpet" @if(isset($obj)) @if($obj->center=='ameerpet') selected  @endif  @endif >Ameerpet</option>
              <option value="madhapur" @if(isset($obj)) @if($obj->center=='madhapur') selected  @endif  @endif >Madhapur</option>
            </select>
          </div>

          

          <div class="form-group">
            <label for="formGroupExampleInput ">Status</label>
            <select class="form-control" name="status">
              <option value="1" @if(isset($obj)) @if($obj->status==1) selected @else selected @endif  @endif >Active</option>
              <option value="0" @if(isset($obj)) @if($obj->status===0) selected @endif @endif >Archive</option>
            </select>
          </div>

          <div class="form-group">
            <label for="formGroupExampleInput ">Schedule Followup Call (optional)</label>
            <input type="text" class=" form-control" value="@if($followup->schedule) {{$followup->schedule}} @endif" name="schedule" id="datetimepicker"/>
          </div>

        </div>
      </div>
      

      

      
       
       

      
  

      
      
      

     

      

      @if($stub=='Update')
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" value="{{ $obj->id }}">
      @endif
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
       <button type="submit" class="btn btn-success">Save</button>
    </form>
    </div>
  </div>
@endsection