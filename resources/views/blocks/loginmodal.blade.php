<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login Now</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Only logged in users can perform this action.
        <?php
          session(['link' => url()->current()]);
        ?>
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