<?php
/* @var $this EntryController */
/* @var $model Entry */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'entry-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
        <table>
	<?php 
		$fields=$model->getFields();
		if ($fields) {
			foreach($fields as $field) {
	?>
            <tr>
	<div class="row"><div class="col-md-3 col-sm-6">
	            <div class="span2"><?php echo $form->labelEx($model,$field->VARNAME);?></div>
	            <div class="span3">
        
		
		<?php 
		if ($widgetEdit = $field->widgetEdit($model)) {
			echo $widgetEdit;
		} elseif ($field->RANGE) {  
			if($field->SELECT==0)
				echo $form->dropDownList($model,$field->VARNAME,Entry::range($field->RANGE));
			elseif($field->SELECT==1)
				echo $form->radioButtonList($model,$field->VARNAME,Entry::range($field->RANGE),array(
						'labelOptions'=>array('style'=>'display:inline'), // add this code
						'separator'=>'       '));
			elseif($field->SELECT==2)
				echo $form->checkBoxList($model,$field->VARNAME,Entry::range($field->RANGE),array(
						'labelOptions'=>array('style'=>'display:inline'), // add this code
						'separator'=>'       '));
		} elseif ($field->FIELD_TYPE=="TEXT") {
			echo $form->textArea($model,$field->VARNAME,array('rows'=>6, 'cols'=>50));
		} else {
			echo $form->textField($model,$field->VARNAME,array('size'=>60,'maxlength'=>(($field->FIELD_SIZE)?$field->FIELD_SIZE:255)));
		}
                
	 ?>
                    </div></div>         
        </div></tr>
            
	
	<?php
			}//foreach
		}//if
	?>
        </table>
        <div style="text-align: center;">
	        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Add' : 'Save',array(
			    'color'=>TbHtml::BUTTON_COLOR_SUCCESS,
			    'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
			    //'onclick'=>'js:document.location.href="http://localhost/asset_management/index.php/consumable/admin"'
			)); ?>
			<?php echo TbHtml::button('Cancel',array(
				'color' => TbHtml::BUTTON_COLOR_DANGER,
				'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
				'onclick' => 'history.go(-1)'
			));?>
            </div>

<?php $this->endWidget(); ?>

</div><!-- form -->