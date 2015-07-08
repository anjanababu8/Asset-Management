<?php
/* @var $this CartridgeController */
/* @var $data Cartridge */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('commodity_id')); ?>:</b>
	<?php echo CHtml::encode($data->commodity_id); ?>
	<br />

	

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('location_id')); ?>:</b>
	<?php echo CHtml::encode($data->location_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('technical_incharge_id')); ?>:</b>
	<?php echo CHtml::encode($data->technical_incharge_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_id')); ?>:</b>
	<?php echo CHtml::encode($data->status_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('manufacturer_id')); ?>:</b>
	<?php echo CHtml::encode($data->manufacturer_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cartridge_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->cartridge_type_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('management_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->management_type_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('threshold')); ?>:</b>
	<?php echo CHtml::encode($data->threshold); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('link_to')); ?>:</b>
	<?php echo CHtml::encode($data->link_to); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('image')); ?>:</b>
	<?php echo CHtml::encode($data->image); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('imageFileName')); ?>:</b>
	<?php echo CHtml::encode($data->imageFileName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('imageFileType')); ?>:</b>
	<?php echo CHtml::encode($data->imageFileType); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('document')); ?>:</b>
	<?php echo CHtml::encode($data->document); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('documentFileName')); ?>:</b>
	<?php echo CHtml::encode($data->documentFileName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('documentFileType')); ?>:</b>
	<?php echo CHtml::encode($data->documentFileType); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_deleted')); ?>:</b>
	<?php echo CHtml::encode($data->is_deleted); ?>
	<br />

	*/ ?>

</div>