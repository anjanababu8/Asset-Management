<?php
/* @var $this ConsumablestockController */
/* @var $model Consumablestock */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'consumable_id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'po_number',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'unit_cost',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'quantity',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'supplier_id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'warranty',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'date_in',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'expiry_date',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'inventory_no',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'status_id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'document',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'documentFileName',array('span'=>5,'maxlength'=>100)); ?>

                    <?php echo $form->textFieldControlGroup($model,'documentFileType',array('span'=>5,'maxlength'=>50)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->