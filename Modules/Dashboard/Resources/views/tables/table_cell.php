 <?php switch ($params['type']): 

    case 'hidden': ?>
        <input  value="<?php echo $value; ?>" name="<?php echo $name; ?>"   type="hidden"/>
    <?php break; 

    case 'string': ?>
        <input class="form-control <?php echo isset($params['classes'])?$params['classes']:'';?>" value="<?php echo $value; ?>" name="<?php echo $name; ?>" <?php echo $validation; ?>  placeholder="<?php echo $params['label']?>..."/>
    <?php break; 

    case 'text': ?>
        <textarea class="form-control <?php echo isset($params['classes'])?$params['classes']:'';?>" name="<?php echo $name; ?>"  <?php echo $validation; ?>><?php echo $value; ?></textarea>
    <?php break; 

    case 'date': ?>
        <div class="input-prepend input-group">
        <span class="add-on input-group-addon">
            <i class="glyph-icon icon-calendar"></i>
        </span><input type="text" class="bootstrap-datepicker form-control <?php echo isset($params['classes'])?$params['classes']:'';?>" data-date-format="yyyy-mm-dd" value="<?php echo $value; ?>" 
        name="<?php echo $name; ?>" <?php echo $validation; ?>></div>

    <?php break; 

    case 'month': ?>
        <div class="date-input-wrap"><input class="form-control input-sm date-input month <?php echo isset($params['classes'])?$params['classes']:'';?>" data-date-format="MM-YYYY" value="<?php echo (!empty($value))? date('m-Y', strtotime($value)): ''; ?>" 
        name="<?php echo $name; ?>" data-rules='<?php echo $validation; ?>'></div>
    <?php break; 

    case 'select': ?>
        <select class=" <?php echo isset($params['classes'])?$params['classes']:'';?>" 
            data-placeholder="..." name="<?php echo $name; ?>" <?php echo $validation; ?>>

            <option value=""></option>
            <?php foreach ($params['options'] as $opValue => $opLabel): ?>
                <option value="<?php echo $opValue; ?>" <?php echo $value == $opValue ? ' selected' :''; ?>>
                    <?php echo $opLabel; ?>
                </option>
            <?php endforeach ?>
        </select>
    <?php break; 

    case 'radio': ?>

        <input type="radio" class="<?php echo isset($params['classes'])?$params['classes']:'';?>" value="<?php echo $params['radio_value'][0]; ?>" name="<?php echo $name; ?>"> <?php echo $params['radio_label'][0]; ?> 
        <input type="radio" class="<?php echo isset($params['classes'])?$params['classes']:'';?>" value="<?php echo $params['radio_value'][1]; ?>" name="<?php echo $name; ?>"> <?php echo $params['radio_label'][1]; ?>

    <?php break;

    case 'select-select2': ?>
                
        <select class="<?php echo isset($params['classes'])?$params['classes']:'';?>" 
             name="<?php echo $name; ?>" <?php echo $validation; ?>>
                <option value=""></option>
                <?php 
                    if($value != ''):
                        $mileage = \Modules\Master\Entities\Eloquent\Mileage::find($value);
                            $from = $mileage->from;
                            $to = $mileage->to;
                            $from = (!is_null($from)? $from->des_code: ' None ');
                            $to = (!is_null($to)? $to->des_code: ' None ');
                           echo '<option value="'.$value.'" selected="true" >'. $from.' - '.$to.'</option>';
                    endif;
                    ?>
        </select>
    <?php break; 

    case 'select-select3': ?>
                
        <select class="<?php echo isset($params['classes'])?$params['classes']:'';?>" 
             name="<?php echo $name; ?>" <?php echo $validation; ?>>
                <option value=""></option>
                <?php 
                    if($value != ''):
                           echo '<option value="'.$value.'" selected="true" >'. $value.'</option>';
                    endif;
                    ?>
        </select>
    <?php break; 

    case 'checkbox': ?>
    <label>
        <input type="checkbox" class="<?php echo isset($params['classes'])?$params['classes']:'';?>" value="<?php echo $params['value']; ?>" <?php echo $params['value']==$value? "checked='true'":''; ?> id="<?php echo $name; ?>" name="<?php echo $name; ?>" <?php echo $validation; ?>>
        <?php echo $params['label']; ?>
    </label>
    <?php break; 

    default: 
?>
    <input type="text" class="form-control <?php echo isset($params['classes'])?$params['classes']:'';?>" value="<?php echo $value; ?>" placeholder="<?php echo $params['label']?>..."> 
<?php
endswitch; ?>