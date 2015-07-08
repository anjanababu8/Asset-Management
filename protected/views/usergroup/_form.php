<?php
/* @var $this UsergroupController */
/* @var $model Usergroup */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'usergroup-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>
                <?php 
                    $this->widget('ext.multiselects.XMultiSelects',array(
                    'leftTitle'=>'Group Users',
                    'leftName'=>'Usergroup[][1]',
                    'leftList'=>Usergroup::model()->findUsersByGroup(1),
                    'rightTitle'=>'Other Users',
                    'rightName'=>'Usergroup[][1]',
                    'rightList'=>Usergroup::model()->findUsersNotInGroup(1),
                    'size'=>20,
                    'width'=>'200px',
                ));?>
    
    <div class="form-actions">
    <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
                'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                'size'=>TbHtml::BUTTON_SIZE_LARGE,
            )); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
