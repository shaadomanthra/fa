@if($test->category->name=='OET')
@foreach($extract->fillup as $f)
            <div class="row question">
                <div class="col-12 col-md-4" id="{{$f->qno}}">
                  <div class="card-text float-sm-none float-md-right text-md-right" ><b>{{ $f->label}}</b>
                  </div>
                </div>
                <div class="col-12 col-md-8">
                  <div class="card-text"><div>
                  @if($f->prefix ) {{$f->prefix }}  @endif 
                  @if($f->answer) <span class="badge badge-warning h2">{{$f->qno}}</span><input type="text" class="fill input" name="{{$f->qno}}" data-id="{{$f->qno}}" >
                   @endif
                  @if($f->suffix ){{$f->suffix }}@endif
                    </div>
                  </div>
                </div>
            </div>
@endforeach
@elseif($test->category->name=='IELTS')
@foreach($extract->fillup as $f)
            <div class="row question">
                <div class="col-12 " id="{{$f->qno}}">
                  <div class="card-text " ><b>{{ $f->label}}</b>
                  </div>
                </div>
                <div class="col-12 ">
                  <div class="card-text"><div>
                  @if($f->prefix ) {{$f->prefix }}  @endif 
                  @if($f->answer) <span class="badge badge-warning h2">{{$f->qno}}</span><input type="text" class="fill input" name="{{$f->qno}}" data-id="{{$f->qno}}" >
                   @endif
                  @if($f->suffix ){{$f->suffix }}@endif
                    </div>
                  </div>
                </div>
            </div>
@endforeach

@endif

