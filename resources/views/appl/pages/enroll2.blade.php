
@extends('layouts.page')
@section('title', 'Enroll2 | First Academy')
@section('content')


<style>
input[type="checkbox"]{
cursor: pointer;
-webkit-appearance: none;
appearance: none;
background: #fff;
border:1px solid #888;
border-radius: 1px;
box-sizing: border-box;
position: relative;
box-sizing: content-box ;
width: 20px;
height: 20px;
border-width: 1;
transition: all .3s linear;
}
input[type="checkbox"]:checked{
  background-color: #2ECC71;
}
input[type="checkbox"]:focus{
  outline: 0 none;
  box-shadow: none;
}
</style>
<div class="row">
  <div class="col-12 col-md-8">
    <div class="pricing-header px-2 py-2 pt-md-4 pb-md-4  mx-auto text-center text-md-left">
  <h1 class="display-4">Improve your <br>scores now!</h1>
  
  <p><i><u style="text-decoration-style:dotted;">view our testimonials</u> <i class="fa fa-play-circle"></i></i></p>
</div>
    </div>


 
  <div class="col-12 col-md-4">
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <img src="{{ asset('images/general/trophy.png')}}" />
    </div>
     </div>
  </div>
  <hr>
  <p class="text-center h3 p-3 mb-4">Choose from a range of free and flexible training and evaluation options.</p>


<div class="container">
 <div class='row'>
    <div class="col-12 col-md-8">
      <div class="pb-3 border rounded p-4 mb-3">
      <div class="form-group form-check h3 mb-2">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label " for="exampleCheck1"><b>Free Mock Test</b></label>
          <div class="badge badge-warning float-right"><i class="fa fa-rupee"></i> 0</div>
      </div>
      <div class="mb-0 h5" style='line-height: 30px'>
        Full length Listening<br>
        Full length Reading<br>
        Basic Writing Evaluation <span class="badge badge-success">Star Offering</span><br>
        Speaking Question Paper Evaluation<hr>
        For those who want a low down on the test
      </div>
      </div>

      <div class="pb-3 border rounded p-4 mb-3">
      <div class="form-group form-check h3 mb-2">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label " for="exampleCheck1"><b>Free Mini Test</b></label>
          <div class="badge badge-warning float-right"><i class="fa fa-rupee"></i> 0</div>
      </div>
      <div class="mb-0 h5" style='line-height: 30px'>

        Mini Listening Test<br>
Mini Reading Test<br>
Mini Writing Evaluation<span class="badge badge-success">Star Offering</span><hr>
        For those who want a
quick overview of the test
      </div>
      </div>

       <div class="pb-3  rounded p-4 mb-3" style="background: #fffae0;border:1px solid #e7deaf">
      <div class="form-group form-check h3 mb-2">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label " for="exampleCheck1"><b>Full Classroom Training</b></label>
          <div class="badge badge-warning float-right"><i class="fa fa-rupee"></i> 9000</div>
      </div>
      <div class="mb-0 h5" style='line-height: 35px'>

        <span style="font-size: 30px;font-weight: 800;color:#d65c5c">4</span> weeks classroom training<br>
<span style="font-size: 30px;font-weight: 800;color:#d65c5c">10</span> writing tasks evaluation<br>
<span style="font-size: 30px;font-weight: 800;color:#d65c5c">8</span> one-to-one sessions<br>
Exclusive material worth  <i class="fa fa-rupee"></i> 6000<br>
<span style="font-size: 30px;font-weight: 800;color:#d65c5c">6</span> months validity<br><hr>
        The full monty blockbuster for all round improvement
      </div>
      </div>


    </div>
    <div class="col-12 col-md-4">
      <div class="card">
  <div class="card-header">
    <h4 class="mb-0">My Cart</h4>
  </div>
  <div class="card-body">
    <h5 class="card-title"><i class="fa fa-check-circle"></i> Free Mock Test </h5>
    <p class="card-text">  Full length Listening<br>
Full length Reading<br>
Basic Writing Evaluation <span class="badge badge-success">Star Offering</span><br>
Speaking Question Paper Evaluation</p>
    <a href="#" class="btn btn-primary">Checkout</a>
  </div>
</div>
    </div>
 </div>    
</div>
@endsection           