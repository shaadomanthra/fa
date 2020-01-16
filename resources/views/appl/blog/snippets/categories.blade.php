<div class="list-group mb-4">
@foreach($categories as $cat)
  <a href="{{ route('category.list', $cat->slug)}}" class="list-group-item list-group-item-action  list-group-item-primary @if(request()->is('category/'.$cat->slug)) active @endif">
    {{$cat->name}} 
  </a>
 @endforeach
</div>