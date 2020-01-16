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
            <label for="formGroupExampleInput "> Title</label>
            <input type="text" class="form-control" name="title" id="formGroupExampleInput" placeholder="Enter the blog title" 
                @if($stub=='Create')
                value="{{ (old('title')) ? old('title') : '' }}"
                @else
                value = "{{ $obj->title }}"
                @endif
              >
          </div>


        </div>
        <div class="col-12 col-md-6">
          
          <div class="form-group">
            <label for="formGroupExampleInput "> slug</label>
            <input type="text" class="form-control" name="slug" id="formGroupExampleInput" placeholder="Enter the blog slug(Unique URL)" 
                @if($stub=='Create')
                value="{{ (old('slug')) ? old('slug') : '' }}"
                @else
                value = "{{ $obj->slug }}"
                @endif
              >
          </div>

          

        </div>
      </div>
      
      <div class="form-group">
        <label for="formGroupExampleInput ">Header Image</label>
        <input type="file" class="form-control" name="file" id="formGroupExampleInput" placeholder="Enter the image path" 
          >
      </div>

      <div class="form-group">
            <label for="formGroupExampleInput ">Body</label>
            <textarea class="form-control summernote" name="body"  rows="3">@if($stub=='Create'){{ (old('body')) ? old('body') : '' }}@else {{ $obj->body }} @endif</textarea>
          </div>

      <div class="form-group">
            <label for="formGroupExampleInput "> Test slug</label>
            <input type="text" class="form-control" name="test" id="formGroupExampleInput" placeholder="Enter the test slug(Unique URL)" 
                @if($stub=='Create')
                value="{{ (old('test')) ? old('test') : '' }}"
                @else
                value = "{{ $obj->test }}"
                @endif
              >
          </div>
      
      <div class="form-group">
            <label for="formGroupExampleInput ">Conclusion</label>
            <textarea class="form-control summernote" name="conlusion"  rows="3">@if($stub=='Create'){{ (old('conlusion')) ? old('conlusion') : '' }}@else {{ $obj->conlusion }} @endif</textarea>
      </div>

      <div class="row">
        <div class="col-12 col-md-6">
          <div class="form-group">
            <label for="formGroupExampleInput ">Tags</label><br>
            @foreach($labels as $a=>$tag)
            @if($a==0)
            <input  type="checkbox" name="tag[]" value="{{$tag->id}}" 
              @if($stub=='Create')
                @if(old('tag'))
                  @if(in_array($tag->id,old('tag')))
                  checked
                  @endif
                @endif
              @else
                @if($obj->tags)
                  @if(in_array($tag->id,$obj->tags->pluck('id')->toArray()))
                  checked
                  @endif
                @endif
              @endif
            > 
            {{ $tag->name}}
            @else
            {{','}}
            <input  type="checkbox" name="tag[]" value="{{$tag->id}}"
              @if($stub=='Create')
                @if(old('tag'))
                  @if(in_array($tag->id,old('tag')))
                  checked
                  @endif
                @endif
              @else
                @if($obj->tags)
                  @if(in_array($tag->id,$obj->tags->pluck('id')->toArray()))
                  checked
                  @endif
                @endif
              @endif
            > 
            {{$tag->name }}
            @endif
            @endforeach
          </div>
           <div class="form-group">
            <label for="formGroupExampleInput ">Status</label>
            <select class="form-control" name="status">
              <option value="1" @if(isset($obj)) @if($obj->status==1) selected @else selected @endif  @endif >Active</option>
              <option value="0" @if(isset($obj)) @if($obj->status===0) selected @endif @endif >Inactive</option>
            </select>
          </div>

           <div class="form-group">
            <label for="formGroupExampleInput ">Meta Title (SEO)</label>
            <textarea class="form-control " name="meta_title"  rows="3">@if($stub=='Create'){{ (old('meta_title')) ? old('meta_title') : '' }}@else {{ $obj->meta_title }} @endif</textarea>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="form-group">
            <label for="formGroupExampleInput ">Category</label><br>
            @foreach($collections as $a=>$tag)
            @if($a==0)
            <input  type="checkbox" name="category[]" value="{{$tag->id}}" 
              @if($stub=='Create')
                @if(old('tag'))
                  @if(in_array($tag->id,old('tag')))
                  checked
                  @endif
                @endif
              @else
                @if($obj->tags)
                  @if(in_array($tag->id,$obj->categories->pluck('id')->toArray()))
                  checked
                  @endif
                @endif
              @endif
            > 
            {{ $tag->name}}
            @else
            {{','}}
            <input  type="checkbox" name="category[]" value="{{$tag->id}}"
              @if($stub=='Create')
                @if(old('tag'))
                  @if(in_array($tag->id,old('tag')))
                  checked
                  @endif
                @endif
              @else
                @if($obj->tags)
                  @if(in_array($tag->id,$obj->categories->pluck('id')->toArray()))
                  checked
                  @endif
                @endif
              @endif
            > 
            {{$tag->name }}
            @endif
            @endforeach
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput ">Schedule (optional)</label>
            <input type="text" class=" form-control" value="@if($obj->schedule) {{$obj->schedule}} @endif" name="schedule" id="datetimepicker"/>
          </div>
           <div class="form-group">
            <label for="formGroupExampleInput ">created on </label>
            <input type="text" class=" form-control" value="@if($obj->created_at) {{$obj->created_at}} @endif" name="created_at" id=""/>
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput ">Meta Description (SEO)</label>
            <textarea class="form-control " name="meta_description"  rows="3">@if($stub=='Create'){{ (old('meta_description')) ? old('meta_description') : '' }}@else {{ $obj->meta_description }} @endif</textarea>
          </div>
        </div>
      </div>
     

      @if($stub=='Update')
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" value="{{ $obj->id }}">
      @endif
        <input type="hidden" name="user_id" value="{{ \auth::user()->id }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
       <button type="submit" class="btn btn-success">Save</button>
    </form>
    </div>
  </div>
@endsection