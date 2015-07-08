<?php
/* @var $this FieldsController */
/* @var $data FormField */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('FIELD_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->FIELD_ID), array('view', 'id'=>$data->FIELD_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FORM_ID')); ?>:</b>
	<?php echo CHtml::encode($data->FORM_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('VARNAME')); ?>:</b>
	<?php echo CHtml::encode($data->VARNAME); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TITLE')); ?>:</b>
	<?php echo CHtml::encode($data->TITLE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FIELD_TYPE')); ?>:</b>
	<?php echo CHtml::encode($data->FIELD_TYPE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FIELD_SIZE')); ?>:</b>
	<?php echo CHtml::encode($data->FIELD_SIZE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FIELD_SIZE_MIN')); ?>:</b>
	<?php echo CHtml::encode($data->FIELD_SIZE_MIN); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('REQUIRED')); ?>:</b>
	<?php echo CHtml::encode($data->REQUIRED); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MATCH')); ?>:</b>
	<?php echo CHtml::encode($data->MATCH); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RANGE')); ?>:</b>
	<?php echo CHtml::encode($data->RANGE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ERROR_MESSAGE')); ?>:</b>
	<?php echo CHtml::encode($data->ERROR_MESSAGE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('OTHER_VALIDATOR')); ?>:</b>
	<?php echo CHtml::encode($data->OTHER_VALIDATOR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DEFAULT')); ?>:</b>
	<?php echo CHtml::encode($data->DEFAULT); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('WIDGET')); ?>:</b>
	<?php echo CHtml::encode($data->WIDGET); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('WIDGETPARAMS')); ?>:</b>
	<?php echo CHtml::encode($data->WIDGETPARAMS); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('POSITION')); ?>:</b>
	<?php echo CHtml::encode($data->POSITION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('VISIBLE')); ?>:</b>
	<?php echo CHtml::encode($data->VISIBLE); ?>
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

	*/ ?>

</div>