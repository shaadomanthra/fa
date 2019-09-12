@extends('layouts.app')
@section('title', 'Test Form | First Academy')
@section('description', 'Take a free IELTS | OET test completely free. Full-length OET practice test for free! Free IELTS writing band scores. Test your vocabulary for OET and IELTS.')
@section('keywords', 'IELTS Practice Test, OET Practice Online, OET Online Training, Vocabulary for IELTS, Vocabulary for OET')
@section('content')

@include('flash::message')
  <div class="card">
    <div class="card-body">
      <h1 class="p-3 border bg-light mb-3">
        @if($stub=='Create')
          Create {{ $app->module }}
        @else
          Update {{ $app->module }}
        @endif  
       </h1>
     
      @if($stub=='Create')
      <form method="post" action="{{route($app->module.'.store')}}" enctype="multipart/form-data">
      @else
      <form method="post" action="{{route($app->module.'.update',$obj->id)}}" enctype="multipart/form-data">
      @endif  
      <div class="form-group">
        <label for="formGroupExampleInput ">{{ ucfirst($app->module)}} Name</label>
        <input type="text" class="form-control" name="name" id="formGroupExampleInput" placeholder="Enter the Name" 
            @if($stub=='Create')
            value="{{ (old('name')) ? old('name') : '' }}"
            @else
            value = "{{ $obj->name }}"
            @endif
          >
      </div>
      
      <div class="form-group">
        <label for="formGroupExampleInput ">Slug</label>
        <input type="text" class="form-control" name="slug" id="formGroupExampleInput" placeholder="Enter the unique identifier" 
            @if($stub=='Create')
            value="{{ (old('slug')) ? old('slug') : '' }}"
            @else
            value = "{{ $obj->slug }}"
            @endif
          >
      </div>

      <div class="form-group">
        <label for="formGroupExampleInput ">Category</label>
        <select class="form-control" name="category_id">
          @foreach($categories as $category)
          <option value="{{$category->id}}" @if(isset($obj)) @if($obj->category_id == $category->id) selected @endif @endif >{{ $category->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="formGroupExampleInput ">Type</label>
        <select class="form-control" name="type_id">
          @foreach($types as $type)
          <option value="{{$type->id}}" @if(isset($obj)) @if($obj->type_id == $type->id) selected @endif @endif >{{ $type->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="formGroupExampleInput ">Group</label>
        <select class="form-control" name="group_id">
          @foreach($groups as $group)
          <option value="{{$group->id}}" @if(isset($obj)) @if($obj->group_id == $group->id) selected @endif @endif >{{ $group->name }} ({{ $group->slug}})</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="formGroupExampleInput ">Details</label>
        <textarea class="form-control summernote" name="details"  rows="5">
            @if($stub=='Create')
            {{ (old('details')) ? old('details') : '' }}
            @else
            {{ $obj->details }}
            @endif
        </textarea>
      </div>
      

      <div class="form-group">
        <label for="formGroupExampleInput ">Instructions</label>
        <textarea class="form-control summernote" name="instructions"  rows="5">
            @if($stub=='Create')
            {{ (old('instructions')) ? old('instructions') : '' }}
            @else
            {{ $obj->instructions }}
            @endif



        </textarea>
      </div>

      <div class="form-group">
        <label for="formGroupExampleInput ">Description</label>
        <textarea class="form-control summernote" name="description"  rows="5">
            @if($stub=='Create')
            {{ (old('description')) ? old('description') : '' }}
            @else
            {{ $obj->description }}
            @endif
        </textarea>
      </div>

      <div class="form-group">
        <label for="formGroupExampleInput ">Audio File</label>
        <input type="file" class="form-control" name="file_" id="formGroupExampleInput" 
          >
      </div>

      <div class="form-group">
        <label for="formGroupExampleInput ">Image</label>
        <input type="file" class="form-control" name="image_" id="formGroupExampleInput" 
          >
      </div>

      <div class="form-group">
        <label for="formGroupExampleInput ">Marks</label>
        <input type="text" class="form-control" name="marks" id="formGroupExampleInput" placeholder="Enter the total marks" 
            @if($stub=='Create')
            value="{{ (old('marks')) ? old('marks') : '' }}"
            @else
            value = "{{ $obj->marks }}"
            @endif
          >
      </div>

      <div class="form-group">
        <label for="formGroupExampleInput ">Test Time (minutes)</label>
        <input type="text" class="form-control" name="test_time" id="formGroupExampleInput" placeholder="Enter the total time in minutes" 
            @if($stub=='Create')
            value="{{ (old('test_time')) ? old('test_time') : '' }}"
            @else
            value = "{{ $obj->test_time }}"
            @endif
          >
      </div>

      <div class="form-group">
        <label for="formGroupExampleInput ">Price</label>
        <input type="text" class="form-control" name="price" id="formGroupExampleInput" placeholder="Enter the price in rupees" 
            @if($stub=='Create')
            value="{{ (old('price')) ? old('price') : '' }}"
            @else
            value = "{{ $obj->price }}"
            @endif
          >
      </div>
     
     <div class="form-group">
        <label for="formGroupExampleInput ">Validity (months)</label>
        <input type="text" class="form-control" name="validity" id="formGroupExampleInput"  
            @if($stub=='Create')
            value="{{ (old('validity')) ? old('validity') : '6' }}"
            @else
            value = "{{ $obj->validity }}"
            @endif
          >
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
       <button type="submit" class="btn btn-info">Save</button>
    </form>
    </div>
  </div>
@endsection