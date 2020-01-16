<div class="row">
  @foreach($obj->related as $item)
              <div class="col-12 col-md">
                <h5><a href="{{ route('page.view',$item->slug)}}">{{$item->title}}</a></h5>
                <p>{!! substr(strip_tags($item->body),0,250)!!}</p>
                <span class="text-info">{{ \Carbon\Carbon::parse($item->created_at)->format('M d Y') }}</span><br>
                @if($item->categories)
                <span class="badge badge-success">{{$item->categories[0]->name}}</span>
                @endif
              </div>
  @endforeach           
            </div>