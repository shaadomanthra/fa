@extends('layouts.app')

@section('content')


<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1 class="display-4">Pricing</h1>
  <p class="lead">Get your tests evaluated by the expert team at first academy. We have cambridge certified trainers who are also authors of international publications.</p>
</div>

<div class="container">
  <div class="card-deck mb-3 text-center">
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Free</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title"><i class="fa fa-rupee"></i> 0 <small class="text-muted"></small></h1>
        <ul class="list-unstyled mt-3 mb-4">
          <li>1 Test included</li>
          <li>1 Evaluation</li>
          <li>Basic Expert Counselling</li>
          <li>Basic Support of application</li>
        </ul>
        <button type="button" class="btn btn-lg btn-block btn-outline-success">Sign up for free</button>
      </div>
    </div>
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Pro</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title"><i class="fa fa-rupee"></i> 2000 <small class="text-muted"></small></h1>
        <ul class="list-unstyled mt-3 mb-4">
          <li>10 Tests included</li>
          <li>10 Evaluation</li>
          <li>Pro Expert Counselling</li>
          <li>Pro Support of application</li>
        </ul>
        <button type="button" class="btn btn-lg btn-block btn-success">Get started</button>
      </div>
    </div>
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Ultra</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title"><i class="fa fa-rupee"></i> 5000 <small class="text-muted"></small></h1>
        <ul class="list-unstyled mt-3 mb-4">
          <li>30 Tests included</li>
          <li>30 Evaluation</li>
          <li>Ultra Expert Counselling</li>
          <li>Ultra Support of application</li>
        </ul>
        <button type="button" class="btn btn-lg btn-block btn-success">Contact us</button>
      </div>
    </div>
  </div>

@endsection
