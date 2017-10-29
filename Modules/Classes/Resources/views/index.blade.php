@extends('layouts.app')

@section('content')
<div id="page-title">
  <h4>View All Classes</h4>
</div>
<div class="panel panel-default">
	<div class="panel-body">
		<a class="btn btn-info formbtn pull-right add-btn" href="/classes/new">
            <i class="fa fa-plus-circle"></i><span class="btntitle"> Add New Class</span>
        </a>
	     <div class="example-box-wrapper">
	         <div class="scroll-columns">
				<?php if(!is_null($results)): ?>
					<table class="table table-responsive table-striped table-condensed">
						<thead>
							<th>#</th>
							<th>Code</th>
							<th>Name</th>
							<th>Actions</th>
						</thead>
						<tbody>
							<?php 
							$i = 0;
							foreach ($results as $result):
								?>
							<tr>
								<td><?php echo ++$i;?></td>
								<td><?php echo $result->code;?></td>
								<td><?php echo $result->name;?></td>
								<td>
									<button class="btn btn-danger viewbtn confirm-delete"  data-id="<?php echo $result->id; ?>"><i class="fa fa-trash-o"></i></button>
                                    <a href="/classes/edit?id=<?php echo $result->id; ?>" class="btn btn-default viewbtn"><i class="fa fa-pencil"></i></a>
								</td>
							</tr>
							<?php endforeach;?>
						</tbody>
					</table>
				<?php else:?>
					No Results Found!!
				<?php endif;?>
				<div class="text-center">
	                @if(isset($results))
	                    {!! $results->render() !!}
	                @endif
	            </div>
			</div>
		</div>
	</div>
</div>
@endsection