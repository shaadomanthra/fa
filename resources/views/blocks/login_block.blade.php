<div class="alert alert-warning alert-dismissible fade show alert-important" role="alert" style="display:none">
  <div class="alert-message">Hello!</div>
  <button type="button" class="close alertclose" >
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<form class="pt-3 register_form">
  
  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="email" class="form-control" id="_email"  name="email2" placeholder="Enter email ">
  </div>
  
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="password2" id="exampleInputP" placeholder="Password">
  </div>

  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  
  <button type="button" id="login_api" class="btn btn-primary login_api" data-url="{{ route('apilogin')}}">Login</button>
   <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
  <div class="spinner-border spinner-border-sm float-right" role="status" style="display:none">
  <span class="sr-only">Loading...</span>
</div>
</form>

