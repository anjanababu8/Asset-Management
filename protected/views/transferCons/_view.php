<?php
/* @var $this TransferConsController */
/* @var $data TransferCons */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('consumable_id')); ?>:</b>
	<?php echo CHtml::encode($data->consumable->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('belongs_to')); ?>:</b>
	<?php echo CHtml::encode($data->belongs_to); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('transfer_to')); ?>:</b>
	<?php echo CHtml::encode($data->transfer_to); ?>
	<br />


</div>