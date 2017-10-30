<?php if (count($instructors ) > 0):?>	
	<?php foreach ($instructors as $instructor):?>
		<option value="<?php echo $instructor->id;?>"><?php echo $instructor->first_name.' '.$instructor->last_name;?></option>
	<?php endforeach;?>
<?php else:?>
	<option value="">-----</option>
<?php endif;?>