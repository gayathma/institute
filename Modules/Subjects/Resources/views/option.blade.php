<?php foreach ($instructors as $instructor):?>
	<option value="<?php echo $instructor->id;?>"><?php echo $instructor->first_name.' '.$instructor->last_name;?></option>
<?php endforeach;?>