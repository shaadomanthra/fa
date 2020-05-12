<style>
.wrap{position: relative}
.save_button{position: absolute;top:0;z-index: 99;}
</style>
<div class="mb-3">
	<div class="wrap">
	<div class="part" @if(isset($testedit) && request()->get('live_edit'))contenteditable="true"  @endif>
	<h3><i class="fa fa-clone"></i> <span class="sec_name_{{$section->id}}">{{  $section->name }}</span></h3>
	@if(trim(strip_tags($section->instructions)))
	<div class="sec_instructions_{{$section->id}}">
		{!! $section->instructions !!}
	</div>
	@endif

	
	</div>
	@if(isset($testedit) && request()->get('live_edit'))
		<div class="save_button" style="right:-140px"><button class="btn btn-section-save btn-outline-secondary" type="button" data-token="{{ csrf_token() }}" data-id="{{$section->id}}" data-url="{{route('section.ajaxupdate',[$test->id,$section->id])}}">Save Section</button></div>
	@endif
</div>
	
	<div class="mb-3">
	<div class="bg-white  p-4" >
	 @if(count($section->mcq_order)!=0)
         @include('appl.test.attempt.blocks.mcq_english')
       @endif

     @if(count($section->fillup_order)!=0)
         @include('appl.test.attempt.blocks.fillup_english')
      @endif
	</div>
</div>
</div>