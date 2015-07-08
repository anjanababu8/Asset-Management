<?php
/* @var $this ManufacturerController */
/* @var $data Manufacturer */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('add1')); ?>:</b>
	<?php echo CHtml::encode($data->add1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('add2')); ?>:</b>
	<?php echo CHtml::encode($data->add2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('emailid')); ?>:</b>
	<?php echo CHtml::encode($data->emailid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mobile')); ?>:</b>
	<?php echo CHtml::encode($data->mobile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pan')); ?>:</b>
	<?php echo CHtml::encode($data->pan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tin')); ?>:</b>
	<?php echo CHtml::encode($data->tin); ?>
	<br /> ?>

</div>