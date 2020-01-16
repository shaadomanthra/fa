@if(!request()->is('admin/collection*') && !request()->is('admin/label*'))
<form class=" mb-4 mt-4 w-100" method="GET" action="{{ route('blog.index') }}">
            <div class="input-group ">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-search"></i></div>
              </div>
              <input class="form-control " id="search" name="item" autocomplete="off" type="search" placeholder="Search" data-url="{{ route('blog.index') }}" aria-label="Search" 
              value="{{Request::get('item')?Request::get('item'):'' }}">
            </div>
            
          </form>
@endif