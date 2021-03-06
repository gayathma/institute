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

<div id="deleteModal" class="modal  bs-example-modal-sm" tabindex="1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Delete Class</h4>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to delete the class?....</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" id="btnDelete" class="btn btn-danger">
					<i class="fa fa-trash-o"></i><span class="btntitle">Delete</span>
				</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
    $('.confirm-delete').on('click', function(e) {
        e.preventDefault();

        var id = $(this).data('id');
        $('#deleteModal').data('id', id).modal('show');
    });

    $(document).on("click","#btnDelete",function() {
        var id = $('#deleteModal').data('id');
        $.ajax({
            url: '/classes/delete',
            data: {
                id : id
            },
            type: 'get',
            success: function(response) {
                $('#deleteModal').modal('hide');
                $('[data-id='+id+']').parents('tr').remove();
                message('success', response)
            },
            error: function(xhr, status, error) {

                message('error', xhr);
            }
        });
    });

</script>
@endsection