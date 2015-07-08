<?php
/* @var $this BarcodedetailController */
/* @var $model Barcodedetail */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'barcodedetail-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>
    <?php echo $form->hiddenField($model,'organisation_id',array('span'=>4,'value'=>Yii::app()->user->getState("org_id")));?>
    
    <table>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'bar_width',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->textField($model,'bar_width',array('span'=>2,'placeHolder'=>'Bar Width'));?> in inches</div>
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'bar_height',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->textField($model,'bar_height',array('span'=>2,'placeHolder'=>'Bar Height')); ?> in inches</div>
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'type',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->dropDownList($model,'type',array('ean8'=>'EAN 8','ean13'=>'EAN 13','upc'=>'UPC','std25'=>'standard 2 of 5 (industrial)','int25'=>'interleaved 2 of 5','code11'=>'code 11','code39'=>'code 39','code93'=>'code 93','code128'=>'code 128','codabar'=>'codabar','msi'=>'MSI'),array('span'=>2,'prompt'=>'---'));?>
                        
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'format',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->radioButtonList($model,'format',array('css'=>'With Text', 'bmp'=>'Without Text'),array('separator'=>''));?></div>
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