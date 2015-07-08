<?php
/* @var $this FormController */
/* @var $model Form */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'FORM_ID'); ?>
		<?php echo $form->textField($model,'FORM_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TABLE_NAME'); ?>
		<?php echo $form->textField($model,'TABLE_NAME',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FORM_NAME'); ?>
		<?php echo $form->textField($model,'FORM_NAME',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'BEGIN_DATE'); ?>
		<?php echo $form->textField($model,'BEGIN_DATE'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'END_DATE'); ?>
		<?php echo $form->textField($model,'END_DATE'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TYPE_ID'); ?>
		<?php echo $form->textField($model,'TYPE_ID'); ?>
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