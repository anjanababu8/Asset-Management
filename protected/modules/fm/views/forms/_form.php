<html>
<style>
.inline-labels{
    display:inline-block;
    padding:10px;
}
</style>
</html>
<?php
/* @var $this FormController */
/* @var $model Form */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'form-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        
	<div class="row">
		<?php /*echo $form->labelEx($model,'TABLE_NAME'); ?>
		<?php echo $form->textField($model,'TABLE_NAME',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'TABLE_NAME'); */?>
		
	</div>
        <table>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'FORM_NAME'); ?></div>
                    <div class="span3"><?php echo $form->textField($model,'FORM_NAME',array('size'=>60,'maxlength'=>128,'placeHolder'=>'Form Name')); ?></div>
                    
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'TYPE_ID'); ?></div>
                    <div class="span3"><?php echo $form->dropDownList($model,'TYPE_ID', CHtml::listData(Commodity::model()->findAll(), 'id', 'name'), array('empty'=>'--- Select Commodity ---')) ?></div>
                    <code>Link it to a commodity.</code>
                </div>
            </div>
        </tr>
        </table>

	<div class="row">
		<?php //echo $form->labelEx($model,'BEGIN_DATE'); ?>
		<?php /*$this->widget('zii.widgets.jui.CJuiDatePicker', array(
		'model' => $model,
		'attribute'=>'BEGIN_DATE',
		'options' => array(
			'changeMonth' => 'true',
			'changeYear' => 'true',
			'showButtonPanel' => 'true',
			'constrainInput' => 'false',
			'dateFormat'=>'yy-mm-dd',
		))); ?>
		<?php echo $form->error($model,'BEGIN_DATE'); ?>
		<p class="hint">If the form is to be available for limited time. Else, leave empty.</p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'END_DATE'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
		'model' => $model,
		'attribute'=>'END_DATE',
		'options' => array(
			'changeMonth' => 'true',
			'changeYear' => 'true',
			'showButtonPanel' => 'true',
			'constrainInput' => 'false',
			'dateFormat'=>'yy-mm-dd',
		))); ?>
		<?php echo $form->error($model,'END_DATE'); */?>
		<!--<p class="hint">If the form is to be available for limited time. Else, leave empty.</p>  -->
	</div>

    <br/><br/>    
    <div style="text-align: center;">
    <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
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