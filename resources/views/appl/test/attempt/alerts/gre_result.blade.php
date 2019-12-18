

<div class="">
  <div class="row">
    <div class="col-12">
      <div class="bg-white p-4">
        <div class="row">
          <div class="col-12 col-md-6">
            <h3 class="text-center text-md-left mb-md-4 mt-2  p-4">
              <i class="fa fa-bar-chart"></i> {{ $test->name}} - Report
              <br>
              @if(isset($admin))
              <a href="{{ route('test.show',$test->id)}}">
                <button class="btn btn-sm btn-outline-primary mt-3 ">
                  <i class="fa fa-angle-left"></i> back to Test</button>
              </a>
              
              @elseif(request()->get('product'))
              <a href="{{ route('product.view',request()->get('product'))}}">
                <button class="btn btn-sm btn-outline-primary mt-3 ">
                  <i class="fa fa-angle-left"></i> back to Product</button>
              </a>
              @else
              <a href="{{ route('test',$test->slug)}}">
                <button class="btn btn-sm btn-outline-primary mt-3 ">
                  <i class="fa fa-angle-left"></i> back to Test</button>
              </a>
              @endif
            </h3>
          </div>
          <div class="col-12 col-md-6">
             <div class="text-center  mt-3 mb-3 mt-md-0 mb-md-0 float-md-right border bg-light p-3 rounded ">
              <div class="">Overall Score</div>
              <div class="display-4">{{ $score }} / {{ $test->marks}} </div>
            </div>
            @if($band)
            <div class="text-center  mt-3 mb-3 mt-md-0 mb-md-0 float-md-right border bg-light p-3 rounded mr-0 mr-md-4">
              <div class="">&nbsp;&nbsp;&nbsp; Band &nbsp;&nbsp;&nbsp;</div>
              <div class="display-4">{{ $band }} </div>
            </div>
            @endif
          </div>
        </div>
        

        @if($test->slug!='gre-mini-test')
          @include('appl.test.attempt.blocks.gre_answers')
        @else
        <div class="card">
          <div class="card-body">
            <div class="alert alert-primary alert-important">

              <h5><div class="mb-2">Attend the abroad guidance session this saturday (21st Dec) at 5:00pm at our office.</div> Collect all your coupons the same day.</h5>
              <b>Note:</b> This offer is valid for 7 days  from the date({{  \Carbon\Carbon::parse($result[0]['created_at'])->format('M d Y')}}) when you have attempted the scholarship test. Call us at +91 95151 25110 for more details.
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                  <h3><i class="fa fa-thumbs-up text-secondary"></i>  Congratulations!</h3>
                  <p>You have unlocked Rs.20000 worth benefits. Collect your coupons at our office. </p>
                  <h5>Your Benefits</h5>
                  <ol>
                    <li>Attend a free GRE/ILETS session this monday (6:30to 8:00am or 6:30 to 8:00pm) </li>
                    <li>Upto 90% discount on GRE/IELTS Training </li>
                    <li>Get your profile evaluated at zero cost</li>
                    <li>300 video lectures, 10,000 practice questions and 100 practice test for TCS, Wipro and Infosys company interviews</li>
                    <li>30 company specific mock tests powered by packetprep </li>
                  </ol>
                </div>
                <div class="col-12 col-md-6">
                  <h3><i class="fa fa-map text-secondary"></i> Office Location</h3>
                  <div>
                    <b>First Academy</b><br>
707 - 708, Seventh floor<br>
Pavani Prestige, <br>
Ameerpet, Hyderabad,<br>
Telengana, 500016 <br><br>

Phone: +91 98666 88666<br>
Email: info@firstacademy.in<br>
                  </div>
                </div>
            </div>
              
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>

