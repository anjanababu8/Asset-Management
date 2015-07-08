<?php
/* @var $this TransferFileController */
/* @var $data TransferFile */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fid')); ?>:</b>
	<?php echo CHtml::encode($data->fid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ownedby')); ?>:</b>
	<?php echo CHtml::encode($data->ownedby); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('transfer_to')); ?>:</b>
	<?php echo CHtml::encode($data->transfer_to); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('previous_location')); ?>:</b>
	<?php echo CHtml::encode($data->previous_location); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('transfer_location')); ?>:</b>
	<?php echo CHtml::encode($data->transfer_location); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Remark')); ?>:</b>
	<?php echo CHtml::encode($data->Remark); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('timestamp')); ?>:</b>
	<?php echo CHtml::encode($data->timestamp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uid')); ?>:</b>
	<?php echo CHtml::encode($data->uid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('transfer_date')); ?>:</b>
	<?php echo CHtml::encode($data->transfer_date); ?>
	<br />

	*/ ?>

</div>