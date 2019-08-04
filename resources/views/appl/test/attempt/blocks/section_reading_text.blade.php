<div class="mb-3 r r{{$section->id}} r{{$s+1}}" data-id={{$s+1}} @if($s!=0)style="display:none" @endif>
	<div class="p-2">
	<h3 class="heading-box 
	"><i class="fa fa-clone"></i>  {{ $section->name}}
	</h3>
	<p >{!! $section->instructions !!}</p>
	</div>
</div>