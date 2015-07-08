<?php
/* @var $this BlockeditemController */
/* @var $data Blockeditem */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('commodity_id')); ?>:</b>
	<?php echo CHtml::encode($data->commodity_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_id')); ?>:</b>
	<?php echo CHtml::encode($data->item_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('blocked_by')); ?>:</b>
	<?php echo CHtml::encode($data->blocked_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('blocked_on')); ?>:</b>
	<?php echo CHtml::encode($data->blocked_on); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('blocked_from')); ?>:</b>
	<?php echo CHtml::encode($data->blocked_from); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('blocked_to')); ?>:</b>
	<?php echo CHtml::encode($data->blocked_to); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('unblock_by')); ?>:</b>
	<?php echo CHtml::encode($data->unblock_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unblock_on')); ?>:</b>
	<?php echo CHtml::encode($data->unblock_on); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('blocked_for')); ?>:</b>
	<?php echo CHtml::encode($data->blocked_for); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('flag')); ?>:</b>
	<?php echo CHtml::encode($data->flag); ?>
	<br />

	*/ ?>

</div>