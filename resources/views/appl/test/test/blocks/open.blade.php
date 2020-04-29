@if(!count($test->sessionAttempt()))
<form class="bg-light mt-4 rounded border p-3" action="{{ route('test.instructions',$test->slug)}}" method="get">
  <div class="row">
    <div class="col-12 col-md-4 col-lg-5">
      <input type="text" class="form-control mb-3 mb-md-0" name="name" placeholder="Enter your full name" value="{{ (old('name')) ? old('name') : '' }}">
    </div>
    <div class="col-12 col-md-4 col-lg-5">
      <input type="text" class="form-control mb-3 mb-md-0" name="phone" placeholder="Enter 10 digit phone number" value="{{ (old('phone')) ? old('phone') : '' }}">
    </div>
    <div class="col-12 col-md-4 col-lg-2">
        <button type="submit" class="btn btn-success w-100"><b>Try now</b></button>
    </div>
  </div>
</form>
@else
  <a href="{{ route('test.analysis',$test->slug) }}" class="btn btn-success"><i class="fa fa-area-chart"></i> Report</a>
@endif