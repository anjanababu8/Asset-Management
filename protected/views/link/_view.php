<?php
/* @var $this LinkController */
/* @var $data Link */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('commodity1_id')); ?>:</b>
	<?php echo CHtml::encode($data->commodity1_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('commodity2_id')); ?>:</b>
	<?php echo CHtml::encode($data->commodity2_id); ?>
	<br />


</div>