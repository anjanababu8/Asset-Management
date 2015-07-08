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

	<b><?php echo CHtml::encode($data->getAttributeLabel('size')); ?>:</b>
	<?php echo CHtml::encode($data->size); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_id')); ?>:</b>
	<?php echo CHtml::encode($data->status->status); ?>
	<br />

	<b><?php //echo CHtml::encode($data->getAttributeLabel('monitor_type_id')); ?>:</b>
	<?php //echo CHtml::encode($data->consumabletype->name); ?>
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
	<b><?php echo CHtml::image(Yii::app()->controller->createUrl('monitor/loadImage', array('id'=>$data->id)));?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('has_microphone')); ?>:</b>
	<?php echo CHtml::encode($data->has_microphone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('has_speaker')); ?>:</b>
	<?php echo CHtml::encode($data->has_speaker); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('has_subD')); ?>:</b>
	<?php echo CHtml::encode($data->has_subD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('has_BNC')); ?>:</b>
	<?php echo CHtml::encode($data->has_BNC); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('has_DVI')); ?>:</b>
	<?php echo CHtml::encode($data->has_DVI); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('has_pivot')); ?>:</b>
	<?php echo CHtml::encode($data->has_pivot); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('has_HDMI')); ?>:</b>
	<?php echo CHtml::encode($data->has_HDMI); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('has_displayport')); ?>:</b>
	<?php echo CHtml::encode($data->has_displayport); ?>
	<br />



</div>