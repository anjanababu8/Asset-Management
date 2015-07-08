<?php
/* @var $this FileTypeController */
/* @var $data FileType */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('label_width')); ?>:</b>
	<?php echo CHtml::encode($data->label_width); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('label_height')); ?>:</b>
	<?php echo CHtml::encode($data->label_height); ?>
	<br />


</div>