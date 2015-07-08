<html>
<style>
.inline-labels{
    display:inline-block;
}
</style>
</html>

<?php
/* @var $this SupplierController */
/* @var $model Supplier */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'supplier-form',
    //'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <table>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'name',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->textField($model,'name',array('span'=>3,'maxlength'=>50,'placeHolder'=>'Supplier Name'));?></div>
                    <div class="span2"><?php echo $form->labelEx($model,'suppliertype_id',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->dropDownList($model,'suppliertype_id',CHtml::listData(Suppliertype::model()->findAll(),'id','name'),array('span'=>2,'prompt'=>'-------'));?>
                    <?php echo CHtml::ajaxLink(Yii::t('suppliertype',TbHtml::button('+',array(
                            'color' => TbHtml::BUTTON_COLOR_SUCCESS,
                            'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
                        ))),$this->createUrl('suppliertype/addnew'),array(
                                'onclick'=>'$("#divDialog7").dialog("open"); return false;',
                                'update'=>'#divDialog7'
                                ),array('id'=>  uniqid()));?>
                            <div id="divDialog7"></div>
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'add1',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->textArea($model,'add1',array('rows'=>2,'span'=>3));?></div>
                    <div class="span2"><?php echo $form->labelEx($model,'add2',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->textArea($model,'add2',array('rows'=>2,'span'=>3));?></div>
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'pincode',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->textField($model,'pincode',array('span'=>2,'maxlength'=>10,'placeHolder'=>'Pincode'));?></div>
                    <div class="span2"><?php echo $form->labelEx($model,'city',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->textField($model,'city',array('span'=>2,'maxlength'=>50,'placeHolder'=>'City'));?></div>
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'state',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->textField($model,'state',array('span'=>2,'maxlength'=>50,'placeHolder'=>'State'));?></div>
                    <div class="span2"><?php echo $form->labelEx($model,'country',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->textField($model,'country',array('span'=>2,'maxlength'=>50,'placeHolder'=>'Country'));?></div>
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'website',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->textField($model,'website',array('span'=>3,'maxlength'=>50,'placeHolder'=>'Website'));?></div>
                    <div class="span2"><?php echo $form->labelEx($model,'phone_no',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->textField($model,'phone_no',array('span'=>2,'maxlength'=>10,'placeHolder'=>'Phone No.'));?></div>
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'email',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->textField($model,'email',array('span'=>3,'maxlength'=>50,'placeHolder'=>'Email id'));?></div>
                    <div class="span2"><?php echo $form->labelEx($model,'tax',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->textField($model,'tax',array('span'=>2,'maxlength'=>10,'placeHolder'=>'Tax No.'));?></div>
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'document',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->fileField($model,'document'); ?></div>
                    <div class="span2"><?php echo $form->labelEx($model,'visiting_card',array('class'=>'inline-labels')); ?></div>
                    <div class="span3"><?php echo $form->fileField($model,'visiting_card'); ?></div>
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'comment',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->textArea($model,'comment',array('rows'=>2,'span'=>3));?></div>
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