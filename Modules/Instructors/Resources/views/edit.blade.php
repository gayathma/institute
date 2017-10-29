@extends('layouts.app')
@section('content')    

<?php if (is_null($result)): ?>                   
    <div id="page-title">
      <h4>Enter New Instructor</h4>
    </div>
<?php else: ?>
    <div id="page-title">
      <h4>Edit Instructor</h4>
    </div>
<?php endif ?>                    


<div class="panel">                          	  
  <div class="panel-body">
      <h5 class="title-hero">
          Instructor Details
      </h5>
      <div class="example-box-wrapper">
      <?php if (is_null($result)): ?>
          <form class="form-horizontal"  role="form" method="POST" action="/instructors/new" id="instructorForm">
      <?php else: ?>
        <form class="form-horizontal"  role="form" method="POST" action="/instructors/edit" id="instructorForm">
        <input type="hidden" name="id" value="<?php echo $result->id; ?>">

      <?php endif ?>
              <div class="col-md-12 form-group">
                  <label class="col-md-2 col-sm-3 control-label">Code<span>*</span></label>
                  <div class="col-md-8 col-sm-9">
                      <input type="text" class="form-control" id="code" name="code" value="<?php echo (!is_null($result) ? $result->code : ''); ?>" required placeholder="Code...">
                  </div>
              </div>       
              <div class="col-md-12 form-group">
                  <label class="col-md-2 col-sm-3 control-label">First Name<span>*</span></label>
                  <div class="col-md-8 col-sm-9">
                      <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo (!is_null($result) ? $result->first_name : ''); ?>" placeholder="First Name..." required>
                  </div>
              </div>
              <div class="col-md-12 form-group">
                  <label class="col-md-2 col-sm-3 control-label">Last Name<span>*</span></label>
                  <div class="col-md-8 col-sm-9">
                      <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo (!is_null($result) ? $result->last_name : ''); ?>" placeholder="Last Name..." required>
                  </div>
              </div>
              <div class="col-md-12 form-group">
                  <label class="col-md-2 col-sm-3 control-label">Marital Status<span>*</span></label>
                  <div class="col-md-4 col-sm-4">
                    <select name="marital_status" id="marital_status" required class="form-control">
                      <option value=""></option>
                      <option<?php echo (!is_null($result) && $result->marital_status == 'single' ? ' selected' :  ' '); ?> value="single">Single</option>
                      <option<?php echo (!is_null($result) && $result->marital_status == 'married' ? ' selected' :  ' '); ?> value="married">Married</option>
                      <option<?php echo (!is_null($result) && $result->marital_status == 'widowed' ? ' selected' :  ' '); ?> value="widowed">Widowed</option>
                  </select>
                  </div>
              </div>
              <div class="col-md-12 form-group">
                <label class="col-md-2 col-sm-3 control-label">Gender<span>*</span></label>
                <div class="col-md-8 col-sm-9">
                  <label class="radio-inline">
                    <input type="radio" name="gender" value="Male" <?php echo(!is_null($result) ? (($result->gender == 'Male')? 'checked="true"': '') : ''); ?> required>
                    Male
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="gender" value="Female" <?php echo(!is_null($result) ? (($result->gender == 'Female')? 'checked="true"': '') : ''); ?> required>
                    Female
                  </label>
                </div>
              </div>
              <div class="col-md-12 form-group">
                  <label class="col-md-2 col-sm-3 control-label">Address<span>*</span></label>
                  <div class="col-md-8 col-sm-9">
                      <textarea class="form-control" id="address" name="address"  placeholder="Address..." required><?php echo (!is_null($result) ? $result->address : ''); ?></textarea>
                  </div>
              </div>
              <div class="col-md-12 form-group">
                  <label class="col-md-2 col-sm-3 control-label">Contact No<span>*</span></label>
                  <div class="col-md-8 col-sm-9">
                      <input type="text" class="form-control" id="phone" name="phone" value="<?php echo (!is_null($result) ? $result->phone : ''); ?>" placeholder="Contact No..." required data-parsley-length="[10, 10]" data-parsley-type="integer">
                  </div>
              </div>
              <div class="col-md-12 form-group">
                  <label class="col-md-2 col-sm-3 control-label">Subjects</label>
                  <div class="col-md-10">
                    <div class="col-md-12 form-group">
                      <?php foreach ($subjects as $subject) :?>
                      <div class="col-md-4">
                        <div class="checkbox checkbox-primary">
                          <label>
                            <input type="checkbox" id="inlineCheckbox110" name="subjects[]" value="<?php echo $subject->id; ?>" class="custom-checkbox" <?php if(in_array($subject->id, $instructor_subjects)):?> checked="true" <?php endif;?>>
                            <?php echo $subject->code.' - '.$subject->name; ?>
                          </label>
                        </div>
                      </div>
                    <?php endforeach;?>
                  </div>
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
var f = $('#instructorForm');
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
                window.open("/instructors","_parent");
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