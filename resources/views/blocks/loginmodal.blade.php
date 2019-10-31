@auth

@if(\auth::user()->sms_token!=1)
<div class="modal fade loginmodal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content p-3">
      <div class="alert alert-warning alert-dismissible fade show alert-important mb-3" role="alert" style="display:none">
      <div class="alert-message">Hello!</div>
      <button type="button" class="close alertclose" >
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

      <h3>Verify you Phone number</h3>

      <div class="otp_activation p-3 border rounded mt-3" >
 
      <p class="mb-3 text-secondary">Kindly use the OTP you have recieved while registering with First Academy. In case of any error you can reach us at +91 9866688666</p>
        <input type="text" class="form-control mb-3" name="sms_code" id="sms_code_1" placeholder="Enter the OTP">
        <button type="button" id="otp_submit" class="btn btn-success otp_submit" data-url="{{ route('sms.verify')}}">Activate Account</button>
         <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
        <div class="spinner-border spinner-border-sm float-right" role="status" style="display:none">
      <span class="sr-only">Loading...</span>
    </div>

      </div>
    </div>
  </div>
</div>
@endif

@else
<div class="modal fade loginmodal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content p-3">
      
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="true">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="false">Login</a>
        </li>
        
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="register" role="tabpanel" aria-labelledby="register-tab">
          <div class="box">
          @include('blocks.register_block')
          </div>
          
        </div>
        <div class="tab-pane fade" id="login" role="tabpanel" aria-labelledby="login-tab">
          @include('blocks.login_block')
        </div>
      </div>

    </div>
  </div>
</div>
@endauth