@extends('layouts.app')
@section('content')    

<?php if (is_null($result)): ?>                   
    <div id="page-title">
      <h4>Enter New Class</h4>
    </div>
<?php else: ?>
    <div id="page-title">
      <h4>Edit Class</h4>
    </div>
<?php endif ?>                    


<div class="panel">                          	  
  <div class="panel-body">
      <h5 class="title-hero">
          Class Details
      </h5>
      <div class="example-box-wrapper">
      <?php if (is_null($result)): ?>
          <form class="form-horizontal"  role="form" method="POST" action="/classes/new" id="classForm">
      <?php else: ?>
        <form class="form-horizontal"  role="form" method="POST" action="/classes/edit" id="classForm">
        <input type="hidden" name="id" value="<?php echo $result->id; ?>">

      <?php endif ?>
              <div class="col-md-12 form-group">
                  <label class="col-md-2 col-sm-3 control-label">Code<span>*</span></label>
                  <div class="col-md-4 col-sm-9">
                      <input type="text" class="form-control" id="code" name="code" value="<?php echo (!is_null($result) ? $result->code : ''); ?>" required placeholder="Code...">
                  </div>
              </div>       
              <div class="col-md-12 form-group">
                  <label class="col-md-2 col-sm-3 control-label">Name<span>*</span></label>
                  <div class="col-md-8 col-sm-9">
                      <input type="text" class="form-control" id="name" name="name" value="<?php echo (!is_null($result) ? $result->name : ''); ?>" placeholder="Name..." required>
                  </div>
              </div>

              <div class="col-sm-offset-2 col-md-8">
                <?php  echo \Modules\Classes\Tables\DetailTable::create(!is_null($result) ? $result : null, 'details', 'table')->render();  ?>                                                
              </div>
              <?php echo csrf_field(); ?>

              <div class="col-md-12 form-group">
                    <div class="col-sm-offset-9">

                        <button class="btn btn-primary formbtn" type="submit">
                            <i class="fa fa-floppy-o"></i><span class="btntitle"> Save</span>
                        </button>

                    </div>
              </div>                                                                                                               
          </form>
      </div>
  </div>
</div>   
                       
<script type="text/javascript">
$(function () {
var f = $('#classForm');
  f.parsley().on('field:validated', function() {
    var ok = $('.parsley-error').length === 0;
    $('.bs-callout-info').toggleClass('hidden', !ok);
    $('.bs-callout-warning').toggleClass('hidden', ok);
  })
  .on('form:success', function() {
    $.ajax({
        url: f.attr('action'),
        data: f.serialize(),
        type: 'post',
        success: function(response) {
            message('success', response);
            setTimeout(function(){
                window.open("/classes","_parent");
            }, 1000);
        },
        error: function(xhr, status, error) {
            message('error', xhr);
        }
    });
  })
  .on('form:submit', function() {
    return false;
  });  
});



$(document).on('change', '.subject', function(e) {
  var element = $(this);
  var subject_id = $(this).val();

    $.ajax({
      url: '/subjects/instructors',
      data: {
        subject_id : subject_id
      },
      async:true,
      type: 'get',
      success: function(response) {
          element.parent().next().find('select').html(response);
      }
    });
});

</script>

@endsection