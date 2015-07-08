<?php
/* @var $this ConsumabletypeController */
/* @var $model Consumabletype */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'consumabletype-form',
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
                    <div class="span2"><?php echo $form->labelEx($model,'comment',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->textArea($model,'comment',array('rows'=>6,'span'=>3));?></div>
            </div>
            </div>
        </tr>
    </table>

    <?php echo '<br/>'?>

    <div style="text-align: center;">
    <?php echo CHtml::ajaxSubmitButton(Yii::t('suppliertype','Submit'),CHtml::normalizeUrl(array('suppliertype/addnew','render'=>false)),array('success'=>'js: function(data) {
                        $("#Supplier_suppliertype_id").append(data);
                        $("#divDialog7").dialog("close");
                    }'),array('class' => 'btn btn-success','id'=>  uniqid())); ?>
    </div>
    <?php $this->endWidget(); ?>
 
</div>