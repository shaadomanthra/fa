@extends('layouts.app')
@include('meta.createedit')
@section('content')


<nav aria-label="breadcrumb">
  <ol class="breadcrumb border bg-light">
    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin')}}">Admin</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/prospect')}}">{{ ucfirst($app->module) }}</a></li>
    <li class="breadcrumb-item">Create</li>
  </ol>
</nav> 
@include('flash::message')

@if($stub=='Create')
  <form method="post" class="form" action="{{route($app->module.'.store')}}" enctype="multipart/form-data" data-type="create">
@else
  <form method="post" class="form" action="{{route($app->module.'.update',$obj->id)}}" enctype="multipart/form-data" data-type="update">

@endif 
<div class="mb-4" style="border:1px solid #cceaf9">
  <div class=" p-4 " style="background: #e2f5ff;">
    <h1 class="mb-1">
      @if($stub=='Create')
        Create {{ $app->module }}
      @else
        Update {{ $app->module }}
      @endif  
      <button type="submit" class="btn btn-outline-primary btn-lg float-right">Save</button>
    </h1>
  </div>
  <div class="p-4 bg-white">

    <div class="alert alert-success alert-important" role="alert" style="display:none">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <h4 class="alert-heading">User exists!</h4>
      <p>User record <span class="name badge badge-primary">sample</span> with phone number <span class="phonenumber badge badge-warning">999999</span> already exists in database. kindly change the status of the record.</p>
      <p class="mb-0"><a href="" class="btn btn-success userlink">Update</a></p>
    </div>

     <div class="row">
        <div class="col-12 col-md-4">
          <div class="form-group">
            <label for="formGroupExampleInput ">Phone</label>
            <input type="text" class="form-control" name="phone" id="phone" data-url="{{ route('apiphone') }}" data-edit="{{ route('prospect.index') }}" placeholder="Enter the phone number" 
                @if($stub=='Create')
                value="{{ (old('phone')) ? old('phone') : '' }}"
                @else
                value = "{{ $obj->phone }}"
                @endif
              >
          </div>
        </div>
        <div class="col-12 col-md-4">
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
        </div>
        <div class="col-12 col-md-4">
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
        </div>
      </div>


      <div class="row">
        <div class="col-12 col-md-6">
          <div class="form-group">
            <label for="formGroupExampleInput ">Course </label><br>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
              <label class="btn btn-outline-primary @if(isset($obj)) @if($obj->course=='ielts') active @endif @endif @if($stub=='Create') active @endif">
                <input type="radio" name="course" id="option1" value="ielts" autocomplete="off" @if(isset($obj)) @if($obj->course=='ielts') checked @endif @else @endif @if($stub=='Create') checked @endif> IELTS
              </label>
              <label class="btn btn-outline-primary @if(isset($obj)) @if($obj->course=='gre') active @endif @endif">
                <input type="radio" name="course" id="option2" value="gre" autocomplete="off"  @if(isset($obj)) @if($obj->course=='gre') checked @endif  @endif > GRE
              </label>
              <label class="btn btn-outline-primary @if(isset($obj)) @if($obj->course=='ielts-gre') active @endif @endif">
                <input type="radio" name="course" id="option3" value="ielts-gre" autocomplete="off"  @if(isset($obj)) @if($obj->course=='ielts-gre') checked @endif  @endif > IELTS & GRE
              </label>
              <label class="btn btn-outline-primary @if(isset($obj)) @if($obj->course=='pte') active @endif @endif">
                <input type="radio" name="course" id="option4" value="pte" autocomplete="off"  @if(isset($obj)) @if($obj->course=='pte') checked @endif  @endif > PTE
              </label>
              <label class="btn btn-outline-primary  @if(isset($obj)) @if($obj->course=='oet') active @endif @endif">
                <input type="radio" name="course" id="option5" value="oet" autocomplete="off" @if(isset($obj)) @if($obj->course=='oet') checked @endif  @endif> OET
              </label>
              <label class="btn btn-outline-primary @if(isset($obj)) @if($obj->course=='toefl') active @endif @endif">
                <input type="radio" name="course" id="option6" value="toefl" autocomplete="off" @if(isset($obj)) @if($obj->course=='toefl') checked @endif  @endif> TOEFL
              </label>
              <label class="btn btn-outline-primary @if(isset($obj)) @if($obj->course=='sat') active @endif @endif">
                <input type="radio" name="course" id="option3" value="sat" autocomplete="off" @if(isset($obj)) @if($obj->course=='sat') checked @endif  @endif> SAT
              </label>
            </div>
          </div>

        </div>
        <div class="col-12 col-md-5">
         



        </div>
      </div>

    

      <div class="row">
        <div class="col-12 col-md-9">
          <div class="form-group">
            <label for="formGroupExampleInput ">Source</label><br>

            <div class="btn-group btn-group-toggle" data-toggle="buttons">
              <label class="btn btn-outline-primary @if(isset($obj)) @if($obj->source=='call') active @endif @endif @if($stub=='Create') active @endif">
                <input type="radio" name="source" id="option1" value="call" autocomplete="off" @if(isset($obj)) @if($obj->source=='call') checked @endif @endif @if($stub=='Create') checked @endif> Call
              </label>
              <label class="btn btn-outline-primary @if(isset($obj)) @if($obj->source=='walkin') active @endif @endif">
                <input type="radio" name="source" id="option2" value="walkin" autocomplete="off" @if(isset($obj)) @if($obj->source=='walkin') checked @endif @endif > Walkin
              </label>
              <label class="btn btn-outline-primary @if(isset($obj)) @if($obj->source=='google-search') active @endif @endif">
                <input type="radio" name="source" id="option2" value="google-search" autocomplete="off" @if(isset($obj)) @if($obj->source=='google-search') checked @endif @endif > Google Search
              </label>
              <label class="btn btn-outline-primary @if(isset($obj)) @if($obj->source=='contact-form') active @endif @endif">
                <input type="radio" name="source" id="option2" value="contact-form" autocomplete="off" @if(isset($obj)) @if($obj->source=='contact-form') checked @endif @endif > Contact Form
              </label>
              <label class="btn btn-outline-primary @if(isset($obj)) @if($obj->source=='email') active @endif @endif">
                <input type="radio" name="source" id="option2" value="email" autocomplete="off" @if(isset($obj)) @if($obj->source=='email') checked @endif @endif > Email
              </label>
              <label class="btn btn-outline-primary @if(isset($obj)) @if($obj->source=='just-dial') active @endif @endif">
                <input type="radio" name="source" id="option2" value="just-dial" autocomplete="off" @if(isset($obj)) @if($obj->source=='just-dial') checked @endif @endif > Just Dial
              </label>
              <label class="btn btn-outline-primary @if(isset($obj)) @if($obj->source=='packetprep') active @endif @endif">
                <input type="radio" name="source" id="option2" value="packetprep" autocomplete="off" @if(isset($obj)) @if($obj->source=='packetprep') checked @endif @endif > PacketPrep
              </label>
              <label class="btn btn-outline-primary @if(isset($obj)) @if($obj->source=='other') active @endif @endif">
                <input type="radio" name="source" id="option2" value="other" autocomplete="off" @if(isset($obj)) @if($obj->source=='other') checked @endif @endif > Other Consultancy
              </label>

            </div>
          </div>

        </div>
        <div class="col-12 col-md">

        </div>
        <div class="col-12 col-md">

        </div>
      </div>

      <div class="form-group">
            <label for="formGroupExampleInput ">Counsellor</label><br>

              <div class="btn-group btn-group-toggle" data-toggle="buttons">
              @foreach($employees as $emp)
              <label class="btn btn-outline-primary @if(isset($obj)) @if($obj->user_id==$emp->id) active @endif @endif @if($emp->id==\auth::user()->id) active @endif">
    <input type="radio" name="user_id" id="option" value="{{$emp->id}}" autocomplete="off"  @if(isset($obj)) @if($obj->user_id==$emp->id) checked @endif  @endif   @if($emp->id==\auth::user()->id) checked @endif> <i class="fa fa-user"></i> {{$emp->name}}
  </label>
              @endforeach
            </div>
          </div>



      <div class="row">
        <div class="col-12 col-md">
          <div class="form-group">
            <label for="formGroupExampleInput ">Stage</label><br>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
              <label class="btn btn-outline-primary @if(isset($obj)) @if($obj->stage=='enquiry') active @endif @endif @if($stub=='Create') active @endif">
                <input type="radio" name="stage" id="option1" value="enquiry" autocomplete="off" @if(isset($obj)) @if($obj->stage=='enquiry') checked @endif @endif @if($stub=='Create') checked @endif> Enquiry
              </label>
              <label class="btn btn-outline-primary @if(isset($obj)) @if($obj->stage=='invited') active @endif @endif">
                <input type="radio" name="stage" id="option1" value="invited" autocomplete="off" @if(isset($obj)) @if($obj->stage=='invited') checked @endif @endif >Invited
              </label>
              <label class="btn btn-outline-primary @if(isset($obj)) @if($obj->stage=='demo') active @endif @endif">
                <input type="radio" name="stage" id="option1" value="demo" autocomplete="off" @if(isset($obj)) @if($obj->stage=='demo') checked @endif @endif >Demo
              </label>
              <label class="btn btn-outline-primary @if(isset($obj)) @if($obj->stage=='enrolled') active @endif @endif">
                <input type="radio" name="stage" id="option1" value="enrolled" autocomplete="off" @if(isset($obj)) @if($obj->stage=='enrolled') checked @endif @endif > Enrolled
              </label>
            </div>
          </div>

        </div>
        <div class="col-12 col-md">
          <div class="form-group">
            <label for="formGroupExampleInput ">Mode</label><br>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
              <label class="btn btn-outline-primary @if(isset($obj)) @if($obj->mode=='classroom') active @endif @endif @if($stub=='Create')active @endif">
                <input type="radio" name="mode" id="option1" value="classroom" autocomplete="off" @if(isset($obj)) @if($obj->course=='classroom') checked @endif @endif @if($stub=='Create') checked @endif> Classroom
              </label>
              <label class="btn btn-outline-primary @if(isset($obj)) @if($obj->mode=='online') active @endif @endif">
                <input type="radio" name="mode" id="option2" value="online" autocomplete="off"  @if(isset($obj)) @if($obj->mode=='online') checked @endif  @endif > Online
              </label>
            </div>
          </div>

        </div>
        <div class="col-12 col-md">
          <div class="form-group">
            <label for="formGroupExampleInput ">Batch</label><br>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
              <label class="btn btn-outline-primary @if(isset($obj)) @if($obj->batch=='weekend') active @endif @endif">
                <input type="radio" name="batch" id="option1" value="weekend" autocomplete="off" @if(isset($obj)) @if($obj->batch=='weekend') checked @endif @endif > Weekend
              </label>
              <label class="btn btn-outline-primary @if(isset($obj)) @if($obj->batch=='weekday') active @endif @endif @if($stub=='Create') active @endif">
                <input type="radio" name="batch" id="option1" value="weekday" autocomplete="off" @if(isset($obj)) @if($obj->batch=='weekday') checked @endif @endif @if($stub=='Create') checked @endif> Weekday
              </label>
            </div>
          </div>
        </div>
        <div class="col-12 col-md">
          <div class="form-group">
            <label for="formGroupExampleInput ">Center</label><br>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
              <label class="btn btn-outline-primary @if(isset($obj)) @if($obj->center=='ameerpet') active @endif @endif @if($stub=='Create') active @endif">
                <input type="radio" name="center" id="option1" value="ameerpet" autocomplete="off" @if(isset($obj)) @if($obj->center=='ameerpet') checked @endif @endif @if($stub=='Create') checked @endif> Ameerpet
              </label>
              <label class="btn btn-outline-primary @if(isset($obj)) @if($obj->center=='madhapur') active @endif @endif">
                <input type="radio" name="center" id="option1" value="madhapur" autocomplete="off" @if(isset($obj)) @if($obj->center=='madhapur') checked @endif @endif > Madhapur
              </label>
            </div>
          </div>
        </div>
        <div class="col-12 col-md">
         <div class="form-group">
          <label for="formGroupExampleInput ">Status</label><br>
          <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-outline-primary @if(isset($obj)) @if($obj->status==1) active @endif @endif @if($stub=='Create') active @endif">
              <input type="radio" name="status" id="option1" value="1" autocomplete="off" @if(isset($obj)) @if($obj->status==1) checked @endif @endif  @if($stub=='Create') checked @endif> Active
            </label>
            <label class="btn btn-outline-primary @if(isset($obj)) @if($obj->status==='0') active @endif @endif">
              <input type="radio" name="status" id="option1" value="0" autocomplete="off" @if(isset($obj)) @if($obj->status==0) checked @endif @endif > Archive
            </label>
          </div>

        </div>
        </div>
      </div>
      <hr>

      <div class="row">
        <div class="col-12 col-md-6">
          <div class="form-group">
            <label for="formGroupExampleInput ">Comment</label>
            <textarea class="form-control " name="comment"  rows="3">@if($stub=='Create'){{ (old('comment')) ? old('comment') : '' }}@else @if(isset($followup->comment)) {{ $followup->comment }}@endif @endif</textarea>
          </div>
          <div class="form-group">
            <input type="hidden" class="form-control" name="contacted" id="formGroupExampleInput" placeholder="Enter the Email" value="1"
              >
          </div>

        </div>
        <div class="col-12 col-md-3">
          <div class="form-group">
            <label for="formGroupExampleInput ">Enquiry Date</label>
            <input type="text" class=" form-control" value="@if($obj->created_at) {{$obj->created_at}} @endif" name="created_at" id="datetimepicker_2"/>
          </div>


        </div>
        <div class="col-12 col-md-3">
          <div class="form-group">
            <label for="formGroupExampleInput ">Schedule Followup Call (optional)</label>
            <input type="text" class=" form-control" value="@if($followup) {{$followup->schedule}} @endif" name="schedule" id="datetimepicker"/>
          </div>

        </div>
        

      </div>

      @if($stub=='Update')
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" value="{{ $obj->id }}">
      @endif
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="module" value="full">
       <button type="submit" class="btn btn-success btn-lg">Save</button>

       
    
  </div>
</div>
</form>

@endsection