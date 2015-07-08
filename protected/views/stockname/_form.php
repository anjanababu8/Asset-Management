<html>
<style>
.inline-labels{
    display:inline-block;
    padding:10px;
}
</style>
</html>
<?php
/* @var $this StocknameController */
/* @var $model Stockname */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'stockname-form',
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
                    <div class="span2"><?php echo $form->labelEx($model,'commodity_id',array('class'=>'inline-labels'));?></div></div>
                <div class="span3"><?php echo $form->dropDownList($model,'commodity_id',CHtml::listData(Commodity::model()->findAll(),'id','name'),array('span'=>3,'prompt'=>'--- Choose Commodity ---'));?></div>
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'prefix',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->textField($model,'prefix',array('span'=>3,'maxlength'=>100,'placeHolder'=>'Barcode Prefix')); ?>
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