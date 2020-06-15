

@if(count($products))
<div class="table-responsive">
<table class="table table-bordered">
  <thead>
    <tr class="bg-light">
      <th scope="col">#</th>
      <th scope="col">Survey</th>
      
      <th scope="col">Status</th>
      <th scope="col">Deadline</th>
    </tr>
  </thead>
  <tbody>
	<tr>
      <th scope="row">1</th>
      <td><a href="http://onlinelibrary.test/test/week1-fof/try"><i class="fa fa-check-square-o"></i> Week 1 - Foundation of finance</a></td>
      <td>
        Active
      </td>
      <td>20 June 2020</td>
    </tr>		
    <tr>
      <th scope="row">2</th>
      <td><a href=""><i class="fa fa-check-square-o"></i>  Group Discussion Class - Feedback</a></td>
      <td>
        Active
      </td>
      <td>20 June 2020</td>
    </tr>   
  </tbody>
</table>
</div>
@else
<div class="card">
	<div class="card-body">
		- No products -
	</div>
</div>
@endif
