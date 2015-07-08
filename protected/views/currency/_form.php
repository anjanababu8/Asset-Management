<html>
<style>
.inline-labels{
    display:inline-block;
    padding:10px;
}
</style>
</html>
<?php
/* @var $this CurrencyController */
/* @var $model Currency */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'consumable-form',
	 'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )); ?>


    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <table>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'name',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->textField($model,'name',array('span'=>3,'maxlength'=>50,'placeHolder'=>'Currency Name'));?></div>
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'symbol',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->fileField($model,'symbol');?></div>
                </div>
            </div>
        </tr>
    </table>
   
        
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