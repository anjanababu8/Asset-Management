<?php
/* @var $this BarcodedetailController */
/* @var $data Barcodedetail */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('organisation_id')); ?>:</b>
	<?php echo CHtml::encode($data->organisation_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bar_width')); ?>:</b>
	<?php echo CHtml::encode($data->bar_width); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bar_height')); ?>:</b>
	<?php echo CHtml::encode($data->bar_height); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('format')); ?>:</b>
	<?php echo CHtml::encode($data->format); ?>
	<br />


</div>