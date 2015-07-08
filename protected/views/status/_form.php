<?php
/* @var $this StatusController */
/* @var $model Status */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'status-form',
	'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

        <?php echo '<br/>'.$form->textFieldControlGroup($model,'status',array('span'=>3,'maxlength'=>100,'placeHolder'=>'Status')); ?>

        <div style="text-align: center;">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Submit' : 'Update',array(
		    'color'=>TbHtml::BUTTON_COLOR_SUCCESS,
		    'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
		)); ?>
		<?php echo TbHtml::button('Cancel',array(
				'color' => TbHtml::BUTTON_COLOR_DANGER,
				'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
				'onclick' => 'history.go(-1)'
		));?>
        </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->