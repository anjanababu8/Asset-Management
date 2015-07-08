<?php
/* @var $this TypesController */
/* @var $data Type */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('TYPE_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->TYPE_ID), array('view', 'id'=>$data->TYPE_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TYPE_LABEL')); ?>:</b>
	<?php echo CHtml::encode($data->TYPE_LABEL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CREATED_BY')); ?>:</b>
	<?php echo CHtml::encode($data->CREATED_BY); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LAST_MODIFIED_BY')); ?>:</b>
	<?php echo CHtml::encode($data->LAST_MODIFIED_BY); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CREATED_DATE')); ?>:</b>
	<?php echo CHtml::encode($data->CREATED_DATE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LAST_MODIFIED_DATE')); ?>:</b>
	<?php echo CHtml::encode($data->LAST_MODIFIED_DATE); ?>
	<br />


</div>