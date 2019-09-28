@auth

<div class="modal fade" id="test_submit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Test Submission</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        The following test will be submitted. The action is permanent and it cannot be reverted.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Confirm Submission</button>
      </div>
    </div>
  </div>
</div>


@else
<div class="modal fade" id="test_submit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login Now</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Only logged in users can submit the test.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="{{ route('login')}}">
        <button type="button" class="btn btn-success">Login</button>
        </a>
        <a href="{{ route('register')}}">
        <button type="button" class="btn btn-primary">Register</button>
        </a>
      </div>
    </div>
  </div>
</div>
@endauth

<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Report Error</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" class="error" action="{{ route('admin.notify')}}">
          <div class="form-group">
          <label for="exampleInputEmail1">Name</label>
          <input type="email" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">
        
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Question Number</label>
          <input type="email" class="form-control" name="qno" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter question number">
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Details</label>
          <textarea class="form-control details" id="exampleFormControlTextarea1" rows="3" name="details"></textarea>
        </div>

        

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="url" value="{{ route('admin.notify')}}">
        <button type="button" class="btn btn-success btn-error-report">Submit</button>
        <div class="spinner-border spinner-border-sm float-right" role="status" style="display:none">
  <span class="sr-only">Loading...</span>
</div>
      </form>
      </div>
    </div>
  </div>
</div>


@foreach($test->sections as $s=>$section)
<div class="modal fade" id="review_{{$s+1}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Review - Section {{$s+1}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Number</th>
      <th scope="col">Status</th>
      <th scope="col">Marked</th>
    </tr>
  </thead>
  <tbody>
    @foreach($section->mcq_order as $k=>$m)
    <tr>
      <th scope="row">{{$k+1}}</th>
      <td class="r_{{$s+1}}_{{$m->qno}}"><span class="badge badge-secondary">Not answered</span></td>
      <td class="m_{{$s+1}}_{{$m->qno}}"></td>
    </tr>
    @endforeach
  </tbody>
</table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endforeach

<div class="modal fade" id="section_submit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Section Submission</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        The following section will be submitted. After submission you cannot review or update your responses.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success btn-submit-section">Submit</button>
      </div>
    </div>
  </div>
</div>