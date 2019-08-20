<form method="post" action="{{ route('attempt.upload',$test->slug) }}" enctype="multipart/form-data">
<h3 >Write your response in the textbox below.</h3>
<div class="mb-4  mt-3 bg-light p-4 border">
	
	<textarea class="summernote2" name="response">
		
	</textarea>
	<a href="#" class="btn btn-success btn-lg  mt-3" data-toggle="modal" data-target="#exampleModal" data-tooltip="tooltip" data-placement="top" title="Delete" >Submit </a>
		
		<div class="float-right mt-4 text-secondary"><span class="word-count">0</span> words</div>

</div>

  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        This following action is permanent and it cannot be reverted.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
        
        
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="product" value="{{$product->slug}}">
        	<button type="submit" class="btn btn-success">Confirm Submission</button>
        
      </div>
    </div>
  </div>
</div>
</form>