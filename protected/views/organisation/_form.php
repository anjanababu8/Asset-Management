<?php
/* @var $this OrganisationController */
/* @var $model Organisation */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'organisation-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>
    
    <table>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'name',array('class'=>'inline-labels'));?></div>
                <div class="span3"><?php echo $form->textField($model,'name',array('span'=>3,'maxlength'=>50,'placeHolder'=>'Organisation Name')); ?></div>
                </div>    
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'email',array('class'=>'inline-labels'));?></div>
                <div class="span3"><?php echo $form->textField($model,'email',array('span'=>3,'maxlength'=>50,'placeHolder'=>'Email')); ?></div>
                </div>    
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'mobile',array('class'=>'inline-labels'));?></div>
                <div class="span3"><?php echo $form->textField($model,'mobile',array('span'=>2,'maxlength'=>10,'placeHolder'=>'Mobile No.')); ?></div>
                </div>    
            </div>
        </tr>
    </table>

    <div style="text-align: center;">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Add' : 'Save',array(
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