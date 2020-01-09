<div class="list-group mb-4">
@foreach($categories as $cat)
  <a href="#" class="list-group-item list-group-item-action  list-group-item-primary">
    {{$cat->name}}
  </a>
 @endforeach
</div>