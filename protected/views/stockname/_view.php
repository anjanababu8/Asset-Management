<?php
/* @var $this StocknameController */
/* @var $data Stockname */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('organisation_id')); ?>:</b>
	<?php echo CHtml::encode($data->organisation_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('commodity_id')); ?>:</b>
	<?php echo CHtml::encode($data->commodity_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prefix')); ?>:</b>
	<?php echo CHtml::encode($data->prefix); ?>
	<br />


</div>