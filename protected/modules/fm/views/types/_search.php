<?php
/* @var $this TypesController */
/* @var $model Type */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'TYPE_ID'); ?>
		<?php echo $form->textField($model,'TYPE_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TYPE_LABEL'); ?>
		<?php echo $form->textField($model,'TYPE_LABEL',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CREATED_BY'); ?>
		<?php echo $form->textField($model,'CREATED_BY',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'LAST_MODIFIED_BY'); ?>
		<?php echo $form->textField($model,'LAST_MODIFIED_BY',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CREATED_DATE'); ?>
		<?php echo $form->textField($model,'CREATED_DATE'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'LAST_MODIFIED_DATE'); ?>
		<?php echo $form->textField($model,'LAST_MODIFIED_DATE'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->