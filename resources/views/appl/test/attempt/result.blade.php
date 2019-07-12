@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
          <div class="bg-light p-4">
            <h3 class="mb-4 mt-2  p-4"><i class="fa fa-bar-chart"></i> Test Report

                <div class="float-right">
                    <div class="">Your Score</div>
            <div class="display-2 mb-4">{{ $score }} </div>
                </div>
            </h3>


           @include('appl.test.attempt.blocks.answers')
          </div>
        </div>
    </div>
</div>
@endsection
