
<?php
/* @var $this CurrencyController */
/* @var $data Currency */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('symbol')); ?>:</b>
	<?php //echo CHtml::encode($data->symbol); ?>
	
	<br/>
	<b><?php echo CHtml::image(Yii::app()->controller->createUrl('currency/loadImage', array('id'=>$data->id)));?>
	</br>
        <br />



</div>