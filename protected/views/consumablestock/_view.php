<?php
/* @var $this ConsumablestockController */
/* @var $data Consumablestock */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('consumable_id')); ?>:</b>
	<?php echo CHtml::encode($data->consumable->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('po_number')); ?>:</b>
	<?php echo CHtml::encode($data->po_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unit_cost')); ?>:</b>
	<?php echo CHtml::encode($data->unit_cost); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quantity')); ?>:</b>
	<?php echo CHtml::encode($data->quantity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('supplier_id')); ?>:</b>
	<?php echo CHtml::encode($data->supplier->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('warranty')); ?>:</b>
	<?php echo CHtml::encode($data->warranty); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_in')); ?>:</b>
	<?php echo CHtml::encode($data->date_in); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('expiry_date')); ?>:</b>
	<?php echo CHtml::encode($data->expiry_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('inventory_no')); ?>:</b>
	<?php echo CHtml::encode($data->inventory_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_id')); ?>:</b>
	<?php echo CHtml::encode($data->status->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('documentFileName')); ?>:</b>
	<?php echo CHtml::encode($data->documentFileName); ?>
	<br />
        <br/>
        
</div>