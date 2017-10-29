<?php  $tableId = $table->getFieldName() . '-table-' . uniqid(); ?>

<script type="text/javascript">
$(function(){
    $('#<?php echo $tableId; ?>').find('tr').not('.table-cloner').find('input, select').each(function(){
        $(this).removeClass('.ignore-validate');
        if ($(this).data('rules') != undefined ) {
            $(this).rules('add', $(this).data('rules'));
        }
    });

    $('.table-cloner').find('input, select').addClass('ignore-validate');
});  
</script>
    <table class="custom-table table table-bordered table-striped table-condensed"  name ="<?php echo $table->getFieldName();?>" id="<?php echo $tableId; ?>">
        <thead class="cf">
            <tr>
               <?php foreach ($table->tabularFields() as $field => $params): ?>
                    <th><?php echo $params['label']; ?></th>
                <?php endforeach; ?>
                <th></th>
            </tr>
        </thead>

        <?php if (count($table->getItems())): ?>

            <?php foreach ($table->getItems() as $i => $item): ?>

                <tr class="table-row">

                    <!-- Row Incrementer Start-->
                    <?php 
                    $incrementer = $table->rowIncrementer();
                    if($incrementer['enabled']):
                        ?>
                    <label class="<?php echo $incrementer['row_label_class'];?> control-label"><?php echo $incrementer['row_label'];?></label>

                <?php endif; ?>
                <!-- Row Incrementer End-->

                <?php foreach ($table->tabularFields() as $field => $params): ?>
                    <td <?php if($params['main_class'] != ''): ?> class="<?php echo $params['main_class']; ?>"<?php endif; ?> >
                    <input type="hidden" value="<?php echo $item->id; ?>" name="<?php echo $table->getFormattedFieldName($i, 'id'); ?>">

                    <?php 

                    echo View::make('dashboard::tables.table_cell', [
                        'params' => $params,
                        'name' => $table->getFormattedFieldName($i, $field), 
                        'validation' => $params['validation'],
                        'value' => $item->$field
                        ])->render(); 

                        ?>

                    <?php endforeach ?>    

                    <td class="<?php echo $table->buttonClass();?>"><a href="#" class="btn btn-danger viewbtn table-del-row"><i class="fa fa-trash-o"></i></a></td>

                </tr>

            <?php endforeach ?>   

        <?php else: ?>

            <?php $i = isset($i) ? $i + 1 : 0; ?>

            <tr data-table-i="<?php echo $i; ?>" class="table-row">

                <!-- Row Incrementer Start-->
                <?php 
                $incrementer = $table->rowIncrementer();
                if($incrementer['enabled']):
                    ?>
                <label class="<?php echo $incrementer['row_label_class'];?> control-label"><?php echo $incrementer['row_label'];?></label>

            <?php endif; ?>
            <!-- Row Incrementer End-->

            <?php foreach ($table->tabularFields() as $field => $params): ?>
                <td <?php if($params['main_class'] != ''): ?> class="<?php echo $params['main_class']; ?>" <?php endif; ?> >
                <?php 

                echo View::make('dashboard::tables.table_cell', [
                    'params' => $params,
                    'name' => $table->getFormattedFieldName($i, $field), 
                    'validation' => $params['validation'],
                    'value' => ''
                    ])->render(); 

                    ?>

                <?php endforeach ?>  

                <td class="<?php echo $table->buttonClass();?>"><a href="#" class="btn btn-danger viewbtn table-del-row"><i class="fa fa-trash-o"></i></a></td>

            </tr>

        <?php endif ?>


        <?php if ($table->addMore): ?>

            <?php $i = isset($i) ? $i + 1 : 0; ?>

            <tr data-table-i="<?php echo $i; ?>" class="table-cloner">

                <!-- Row Incrementer Start-->
                <?php 
                $incrementer = $table->rowIncrementer();
                if($incrementer['enabled']):
                    ?>
                <label class="<?php echo $incrementer['row_label_class'];?> control-label"><?php echo $incrementer['row_label'];?></label>

            <?php endif; ?>
            <!-- Row Incrementer End-->

            <?php foreach ($table->tabularFields() as $field => $params): ?>
                <td <?php if($params['main_class'] != ''): ?> class="<?php echo $params['main_class']; ?>" <?php endif; ?> >
                    <?php 

                    echo View::make('dashboard::tables.table_cell', [
                        'params' => $params,
                        'name' => $table->getFormattedFieldName($i, $field), 
                        'validation' => $table->getValidationString($field),
                        'value' => ''
                        ])->render(); 

                        ?>
                </td>

                <?php endforeach ?>  

                <td class="<?php echo $table->buttonClass();?>">
                    <a href="#" class="btn btn-danger viewbtn table-del-row"><i class="fa fa-trash-o"></i></a>
                </td>

            </tr>
            <tr class="table-row">
                <!-- Row Incrementer Start-->
                <?php 
                $incrementer = $table->rowIncrementer();
                if($incrementer['enabled']):
                    ?>
                <label class="<?php echo $incrementer['row_label_class'];?> control-label">&nbsp;</label>

            <?php endif; ?>
            <!-- Row Incrementer End-->

            <?php foreach ($table->tabularFields() as $field => $params): ?>
                <td <?php if($params['main_class'] != ''): ?> class="<?php echo $params['main_class']; ?>" <?php endif; ?> >
                </td>

            <?php endforeach ?>  
            <td >
                <a href="#" class="btn btn-primary btn-del table-add-row"><i class="fa fa-plus"></i></a>
            </td>
        </tr>

    <?php endif ?>

</table>