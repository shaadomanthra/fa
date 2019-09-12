<div class="rounded p-4 mb-4" style="border: 3px dotted silver">
	<h4><i class="fa fa-file-o"></i> Upload File</h4>
	<p>Record the speaking task  using your mobile audio recorder and upload it.</p>
	<form method="post" action="{{ route('attempt.upload',$test->slug) }}" enctype="multipart/form-data">
		<div class="form-group bg-light p-2 border">
			<input type="file" class="form-control-file" name="file_" id="exampleFormControlFile1">
		</div>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="type" value="audio">
		<input type="hidden" name="product" value="@if($product){{ $product->slug }} @endif">
		<button class="btn btn-success mb-4" type="submit">Upload</button>
	</form>
	<div class="text-secondary">*Only the following file types are supported: mp3, wav, mkv, mp4, aac, 3gp, ogg, mpga</div>
</div>