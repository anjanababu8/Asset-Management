<?php
/* @var $this AllocateController */
/* @var $data Allocate */
?>

<div class="view">
    
    	<b><?php echo CHtml::encode($data->getAttributeLabel('allocate_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->allocate_id),array('view','id'=>$data->allocate_id)); ?>
	<br /> 
        <!--
	<b><?php //echo CHtml::encode($data->getAttributeLabel('stock_id')); ?>:</b>
	<?php //echo CHtml::encode($data->stock_id); ?>
	<br />
        
	<b><?php //echo CHtml::encode($data->getAttributeLabel('allocate_to')); ?>:</b>
	<?php //echo CHtml::encode($data->allocate_to); ?>
	<br />

	<b><?php //echo CHtml::encode($data->getAttributeLabel('allocate_to_extend')); ?>:</b>
	<?php //echo CHtml::encode($data->allocate_to_extend); ?>
	<br />
    
        -->

	<b><?php echo CHtml::encode($data->getAttributeLabel('cons_id')); ?>:</b>
	<?php echo CHtml::encode($data->consumable->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_in')); ?>:</b>
	<?php echo CHtml::encode($data->date_in); ?>
	<br />
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('date_out')); ?>:</b>
	<?php echo CHtml::encode($data->date_out); ?>
	<br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('return_on')); ?>:</b>
	<?php echo CHtml::encode($data->return_on); ?>
	<br />
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('given_by')); ?>:</b>
	<?php echo CHtml::encode($data->given_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('given_to')); ?>:</b>
	<?php echo CHtml::encode($data->given_to); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('purpose')); ?>:</b>
	<?php echo CHtml::encode($data->purpose); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comments')); ?>:</b>
	<?php echo CHtml::encode($data->comments); ?>
	<br />
        <br />

</div>