<html>
<style>
.inline-labels{
    display:inline-block;
    padding:10px;
}
</style>
</html>

<?php
/* @var $this ConsumabletypeController */
/* @var $model Consumabletype */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'manufacturer-form',
    'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>
 
    <p class="note">Fields with <span class="required">*</span> are required.</p>
 
    <?php echo $form->errorSummary($model); ?>

    <table>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'name',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->textField($model,'name',array('span'=>3,'maxlength'=>50));?></div>
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'add1',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->textArea($model,'add1',array('rows'=>6,'span'=>3));?></div>
                    <div class="span2"><?php echo $form->labelEx($model,'add2',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->textArea($model,'add2',array('rows'=>6,'span'=>3)).'<br/><br/>';?></div>
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'emailid',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->textField($model,'emailid',array('span'=>3,'maxlength'=>50));?></div>
                    <div class="span2"><?php echo $form->labelEx($model,'mobile',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->textField($model,'mobile',array('span'=>3,'maxlength'=>50)); ?></div>
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'pan',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->textField($model,'pan',array('span'=>3)); ?></div>
                    <div class="span2"><?php echo $form->labelEx($model,'tin',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->textField($model,'tin',array('span'=>3)); ?></div>
                </div>
            </div>
        </tr>
        
    </table>
    <div style="text-align: center;">
    <?php echo CHtml::ajaxSubmitButton(Yii::t('manufacturer','Submit'),CHtml::normalizeUrl(array('manufacturer/addnew','render'=>false)),array('success'=>'js: function(data) {
                        $("#Consumable_manufacturer_id").append(data);
                        $("#divDialog4").dialog("close");
                    }'),array('class' => 'btn btn-success','id'=>  uniqid())); ?>
    </div>
    <?php $this->endWidget(); ?>
 
</div>