<?php
/* @var $this ConsumableController */
/* @var $data Consumable */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

        <b><?php //echo CHtml::encode($data->getAttributeLabel('commodity_id')); ?>:</b>
	<?php //echo CHtml::encode($data->commodity_id); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_id')); ?>:</b>
	<?php echo CHtml::encode($data->status->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('manufacturer_id')); ?>:</b>
	<?php echo CHtml::encode($data->manufacturer->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('consumable_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->consumabletype->name); ?>
	<br />

	
	<b><?php echo CHtml::encode($data->getAttributeLabel('management_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->managementtype->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('model')); ?>:</b>
	<?php echo CHtml::encode($data->model); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('threshold')); ?>:</b>
	<?php echo CHtml::encode($data->threshold); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('image')); ?>:</b>
	<b><?php echo CHtml::image(Yii::app()->controller->createUrl('consumable/loadImage', array('id'=>$data->id)));?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('semi_consumable')); ?>:</b>
	<?php echo CHtml::encode($data->semi_consumable); ?>
	<br />
	
	<br/>
	<br/>
</div>