<?php
/* @var $this FieldsController */
/* @var $model FormField */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'FIELD_ID'); ?>
		<?php echo $form->textField($model,'FIELD_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FORM_ID'); ?>
		<?php echo $form->textField($model,'FORM_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'VARNAME'); ?>
		<?php echo $form->textField($model,'VARNAME',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TITLE'); ?>
		<?php echo $form->textField($model,'TITLE',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FIELD_TYPE'); ?>
		<?php echo $form->textField($model,'FIELD_TYPE',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FIELD_SIZE'); ?>
		<?php echo $form->textField($model,'FIELD_SIZE'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FIELD_SIZE_MIN'); ?>
		<?php echo $form->textField($model,'FIELD_SIZE_MIN'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'REQUIRED'); ?>
		<?php echo $form->textField($model,'REQUIRED'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MATCH'); ?>
		<?php echo $form->textField($model,'MATCH',array('size'=>60,'maxlength'=>255)); ?>
	</div>


	
	<div class="row">
		<?php echo $form->label($model,'RANGE'); ?>
		<?php echo $form->textField($model,'RANGE',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ERROR_MESSAGE'); ?>
		<?php echo $form->textField($model,'ERROR_MESSAGE',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'OTHER_VALIDATOR'); ?>
		<?php echo $form->textArea($model,'OTHER_VALIDATOR',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DEFAULT'); ?>
		<?php echo $form->textField($model,'DEFAULT',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'WIDGET'); ?>
		<?php echo $form->textField($model,'WIDGET',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'WIDGETPARAMS'); ?>
		<?php echo $form->textArea($model,'WIDGETPARAMS',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'POSITION'); ?>
		<?php echo $form->textField($model,'POSITION'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'VISIBLE'); ?>
		<?php echo $form->textField($model,'VISIBLE'); ?>
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