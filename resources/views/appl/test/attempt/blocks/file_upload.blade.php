<div class="rounded p-4 mb-4" style="border: 3px dotted silver">
	<h4><i class="fa fa-file-o"></i> Upload File</h4>
	<p>All essays need to be TYPED (handwriting essays will not be accepted)</p>
	<form method="post" action="{{ route('attempt.upload',$test->slug) }}" enctype="multipart/form-data">
		<div class="form-group bg-light p-2 border">
			<input type="file" class="form-control-file" name="file_" id="exampleFormControlFile1">
		</div>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="type" value="doc">
		<input type="hidden" name="product" value="{{$product->slug}}">
		<button class="btn btn-success mb-4" type="submit">Upload</button>
	</form>
	<div class="text-secondary">*Only the following file types are supported: doc, docx, pdf, rtf, txt</div>
</div>