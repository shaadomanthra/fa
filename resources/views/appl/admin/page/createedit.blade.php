@extends('layouts.app')
@section('title', 'Page | First Academy')
@section('description', 'Take a free IELTS | OET test completely free. Full-length OET practice test for free! Free IELTS writing band scores. Test your vocabulary for OET and IELTS.')
@section('keywords', 'IELTS Practice Test, OET Practice Online, OET Online Training, Vocabulary for IELTS, Vocabulary for OET')
@section('content')

@include('flash::message')
<div class="row">
  <div class="col-12 col-md-12">
  <div class="card">
    <div class="card-body">
      <h1 class="p-3 border bg-light mb-3">
        @if($stub=='Create') Create Page @else Edit Page @endif
       </h1>
      
      @if($stub=='Create')
      <form method="post" action="{{route('page.store')}}" enctype="multipart/form-data">
      @else
      <form method="post" action="{{route($app->module.'.update',$obj->slug)}}" enctype="multipart/form-data">
      @endif  

      <div class="form-group">
        <label for="formGroupExampleInput ">Title</label>
        <input type="text" class="form-control" name="title" id="formGroupExampleInput" placeholder="Enter the title of the page" 
            @if($stub=='Create')
            value="{{ (old('title')) ? old('title') : '' }}"
            @else
            value = "{{ $obj->title }}"
            @endif
          >
      </div>
      <div class="form-group">
        <label for="formGroupExampleInput ">Slug</label>
        <input type="text" class="form-control" name="slug" id="formGroupExampleInput" placeholder="Enter the unique url identifier" 
            @if($stub=='Create')
            value="{{ (old('slug')) ? old('slug') : '' }}"
            @else
            value = "{{ $obj->slug }}"
            @endif
          >
      </div>

      <div class="form-group">
        <label for="formGroupExampleInput ">Page Content </label>
         <textarea class="form-control summernote" name="content"  rows="10">@if($stub=='Create'){{ (old('content')) ? old('content') : '' }}@else{{ $obj->content }}@endif</textarea>
    </div>
    <div class="form-group">
        <label for="formGroupExampleInput ">SEO Description </label>
        
         <textarea class="form-control " name="description"  rows="3">@if($stub=='Create'){{ (old('description')) ? old('description') : '' }}@else{{ $obj->description }}@endif</textarea>
    </div>

    <div class="form-group">
        <label for="formGroupExampleInput ">Status</label>
        <select class="form-control" name="status">
          <option value="0" @if(isset($obj)) @if($obj->status==0) selected @endif @endif >Inactive</option>
          <option value="1" @if(isset($obj)) @if($obj->status==1) selected @endif @endif >Active</option>
        </select>
      </div>


      @if($stub=='Update')
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" value="{{ $obj->id }}">
      @endif
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="user_id" value="{{ \auth::user()->id }}">
       <button type="submit" class="btn btn-primary btn-lg">Save</button>
    </form>
    </div>
  </div>
</div>

</div>
@endsection