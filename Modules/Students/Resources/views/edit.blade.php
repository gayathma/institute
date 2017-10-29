@extends('layouts.app')
@section('content')    

<?php if (is_null($result)): ?>                   
    <div id="page-title">
      <h4>Enter New Student</h4>
    </div>
<?php else: ?>
    <div id="page-title">
      <h4>Edit Student</h4>
    </div>
<?php endif ?>                    


<div class="panel">                          	  
  <div class="panel-body">
      <h5 class="title-hero">
          Student Details
      </h5>
      <div class="example-box-wrapper">
      <?php if (is_null($result)): ?>
          <form class="form-horizontal"  role="form" method="POST" action="/students/new" id="studentForm">
      <?php else: ?>
        <form class="form-horizontal"  role="form" method="POST" action="/students/edit" id="studentForm">
        <input type="hidden" name="id" value="<?php echo $result->id; ?>">

      <?php endif ?>
              <div class="col-md-12 form-group">
                  <label class="col-md-2 col-sm-3 control-label">First Name<span>*</span></label>
                  <div class="col-md-8 col-sm-9">
                      <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo (!is_null($result) ? $result->first_name : ''); ?>" data-parsley-length="[10, 10]" placeholder="First Name...">
                  </div>
              </div>       
              <div class="col-md-12 form-group">
                  <label class="col-md-2 col-sm-3 control-label">Last Name<span>*</span></label>
                  <div class="col-md-8 col-sm-9">
                      <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo (!is_null($result) ? $result->last_name : ''); ?>" placeholder="Last Name..." required>
                  </div>
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
var f = $('#studentForm');
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
                window.open("/students","_parent");
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


</script>

@endsection