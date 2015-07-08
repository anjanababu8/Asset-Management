<?php
/* @var $this MonitorController */
/* @var $data Monitor */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />
	
	 <b><?php echo CHtml::encode($data->getAttributeLabel('category_id')); ?>:</b>
	<?php echo CHtml::encode($data->category_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('location_id')); ?>:</b>
	<?php echo CHtml::encode($data->location->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('technical_incharge_id')); ?>:</b>
	<?php echo CHtml::encode($data->user->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('brand')); ?>:</b>
	<?php echo CHtml::encode($data->brand); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_id')); ?>:</b>
	<?php echo CHtml::encode($data->status->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('device_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->monitortype->name); ?>
	<br />

	
	<b><?php echo CHtml::encode($data->getAttributeLabel('manufacturer_id')); ?>:</b>
	<?php echo CHtml::encode($data->manufacturer->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('serial_number')); ?>:</b>
	<?php echo CHtml::encode($data->serial_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('management_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->managementtype->name); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('image')); ?>:</b>
	<b><?php echo CHtml::image(Yii::app()->controller->createUrl('devices/loadImage', array('id'=>$data->id)));?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('imageFileName')); ?>:</b>
	<?php echo CHtml::encode($data->imageFileName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('documentFileName')); ?>:</b>
	<?php echo CHtml::encode($data->documentFileName); ?>
	<br />
	





	<b><?php echo CHtml::encode($data->getAttributeLabel('enable_financial')); ?>:</b>
	<?php echo CHtml::encode($data->enable_financial); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('available_on_loan')); ?>:</b>
	<?php echo CHtml::encode($data->available_on_loan); ?>
	<br />

	*/ ?>

</div>