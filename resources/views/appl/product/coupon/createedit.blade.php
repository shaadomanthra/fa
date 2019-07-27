@extends('layouts.app')
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
        <label for="formGroupExampleInput ">{{ ucfirst($app->module)}} Code</label>
        <input type="text" class="form-control" name="code" id="formGroupExampleInput" 
            @if($stub=='Create')
            value="{{ (old('code')) ? old('code') : $obj->code }}"
            @else
            value = "{{ $obj->code }}"
            @endif
          >
      </div>
      
      <div class="form-group">
        <label for="formGroupExampleInput ">Expiry</label>
        <input type="text" class="form-control" name="expiry" id="formGroupExampleInput" 
            @if($stub=='Create')
            value="{{ (old('expiry')) ? old('expiry') : $obj->expiry }}"
            @else
            value = "{{ $obj->expiry }}"
            @endif
          >
      </div>

      <div class="form-group">
        <label for="formGroupExampleInput">Products</label>
         <div class=" card p-3">
          <div class="row">
          @foreach($products as $product)
          @if($product->status==1)
          <div class="col-12 col-md-3">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="products[]" value="{{$product->id}}" id="defaultCheck1" @if($obj->products->contains($product->id))) checked @endif>
            <label class="form-check-label" for="defaultCheck1">
              {{ $product->name }}
            </label>
          </div>
          </div>
          @endif
          @endforeach
         </div>
         </div>
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