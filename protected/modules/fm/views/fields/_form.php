<?php
/* @var $this FieldsController */
/* @var $model FormField */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'form-field-form',
	'enableAjaxValidation'=>false,
)); ?>
		
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php /*echo $form->labelEx($model,'VARNAME'); ?>
		<?php echo $form->textField($model,'VARNAME',array('size'=>60,'maxlength'=>50,'readonly'=>($model->FIELD_ID)?true:false)); ?>
		<?php echo $form->error($model,'VARNAME'); */?>
		
	</div>
        <table>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'TITLE'); ?></div>
                    <div class="span3"><?php echo $form->textField($model,'TITLE',array('size'=>60,'maxlength'=>255,'placeHolder'=>'Field Name')); ?></div>
                </div>
            </div>
        </tr>
        <tr>
            <div class="row field_type">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'FIELD_TYPE'); ?></div>
                    <div class="span3"><?php echo (($model->FIELD_ID)?$form->textField($model,'FIELD_TYPE',array('size'=>50,'maxlength'=>50,'readonly'=>true)):$form->dropDownList($model,'FIELD_TYPE',FormField::itemAlias('field_type'),array('id'=>'field_type'))); ?></div>
                    <span class='label label-info'>Field type in the database.</span>
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'FIELD_SIZE'); ?></div>
                    <div class="span3"><?php echo $form->textField($model,'FIELD_SIZE',array('readonly'=>($model->FIELD_ID)?true:false)); ?></div>
                    <span class='label label-info'>Field size in the database.</span>
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'FIELD_SIZE_MIN'); ?></div>
                    <div class="span3"><?php echo $form->textField($model,'FIELD_SIZE_MIN'); ?></div>
                    <span class='label label-info'>The minimum value of the field (form validator).</span>
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'REQUIRED'); ?></div>
                    <div class="span3"><?php echo $form->DropDownList($model,'REQUIRED',FormField::itemAlias('required')); ?></div>
                    <span class='label label-info'>Required field (form validator).</span>
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'MATCH'); ?></div>
                    <div class="span3"><?php echo $form->textField($model,'MATCH',array('size'=>60,'maxlength'=>255,'placeHolder'=>'Pattern to Match')); ?></div>
                    <span class='label label-info'>Regular expression (example: '/^[A-Za-z0-9\s,]+$/u').</span>
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'SELECT'); ?></div>
                    <div class="span3"><?php echo $form->DropDownList($model,'SELECT',FormField::itemAlias('select')); ?></div>
                    <span class='label label-info'>Advanced field options.</span>
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'RANGE'); ?></div>
                    <div class="span3"><?php echo $form->textField($model,'RANGE',array('size'=>60,'maxlength'=>5000,'placeHolder'=>'Range')); ?></div>
                    <span class='label label-info'>Predefined values (example: 1;2;3;4;5 or 1==One;2==Two;3==Three;4==Four;5==Five).</span>
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'ERROR_MESSAGE'); ?></div>
                    <div class="span3"><?php echo $form->textField($model,'ERROR_MESSAGE',array('size'=>60,'maxlength'=>255,'placeHolder'=>'Error Message')); ?></div>
                    <span class='label label-info'>Error message to be displayed when you validate the field.</span>
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'OTHER_VALIDATOR'); ?></div>
                    <div class="span3"><?php echo $form->textField($model,'OTHER_VALIDATOR',array('size'=>60, 'maxlength'=>255,'placeHolder'=>'Other Validator')); ?></div>
                    <span class='label label-info'>JSON string (example: {"file":{"types":"jpg, gif, png"}}).</span>
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'DEFAULT'); ?></div>
                    <div class="span3"><?php echo $form->textField($model,'DEFAULT',array('size'=>60,'maxlength'=>255,'placeHolder'=>'Default Value','readonly'=>($model->FIELD_ID)?true:false)); ?></div>
                    <span class='label label-info'>Default value for the field in database.</span>
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'WIDGET'); ?></div>
                    <?php list($widgetsList) = FieldsController::getWidgets($model->FIELD_TYPE); ?>
                    <div class="span3"><?php echo $form->dropDownList($model,'WIDGET',$widgetsList,array('id'=>'widgetlist')); ?></div>
                    <span class='label label-info'>Widget name.</span>
                </div>
            </div>
        </tr>
        <tr>
            <div class="row widgetparams">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'WIDGETPARAMS'); ?></div>
                    <div class="span3"><?php echo $form->dropDownList($model,'WIDGETPARAMS',array(''=>'---','{"modelName":"Category","optionName":"name"}'=>'Category','{"modelName":"User","optionName":"name"}'=>'Technical Incharge','{"modelName":"Location","optionName":"name"}'=>'Location',
																	'{"modelName":"Manufacturer","optionName":"name"}'=>'Manufacturer','{"modelName":"Consumabletype","optionName":"name"}'=>'Consumable Type',
																	'{"modelName":"Managementtype","optionName":"name"}'=>'Management Type',
																	'{"modelName":"Dept","optionName":"name"}'=>' Department',
																	'{"modelName":"FileStatus","optionName":"name"}'=>'File Status',
																	'{"modelName":"FileType","optionName":"name"}'=>'File Type',
                        '{"modelName":"FileMaintenanceSchedule","optionName":"name"}'=>'File Maintenance Schedule')); ?></div>
                    <span class='label label-info'>JSON string (example: {"modelName":"Location","optionName":"name"} <br/> OR {"param1":["val1","val2"],"param2":{"k1":"v1","k2":"v2"}}).</span>
                    <br/><br/>
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'POSITION'); ?></div>
                    <div class="span3"><?php echo $form->textField($model,'POSITION'); ?></div>
                    <span class='label label-info'>Display order of fields.</span>
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'VISIBLE'); ?></div>
                    <div class="span3"><?php echo $form->dropDownList($model,'VISIBLE',FormField::itemAlias('visible')); ?></div>
                    <span class='label label-info'>Display field as hidden or for all.</span>
                </div>
            </div>
        </tr>
        </table>
        
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