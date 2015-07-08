<?php
/* @var $this FormController */
/* @var $data Form */
?>
<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('FORM_ID')); ?>:</b>
	<?php echo CHtml::encode($data->FORM_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TABLE_NAME')); ?>:</b>
	<?php echo CHtml::encode($data->TABLE_NAME); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FORM_NAME')); ?>:</b>
	<?php echo CHtml::encode($data->FORM_NAME); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('BEGIN_DATE')); ?>:</b>
	<?php echo CHtml::encode($data->BEGIN_DATE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('END_DATE')); ?>:</b>
	<?php echo CHtml::encode($data->END_DATE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TYPE_ID')); ?>:</b>
	<?php if ($data->TYPE_ID){echo CHtml::encode(Commodity::model()->FindByPk($data->TYPE_ID)->name);} ?>
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