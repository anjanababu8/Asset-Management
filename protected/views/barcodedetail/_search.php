<?php
/* @var $this BarcodedetailController */
/* @var $model Barcodedetail */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'organisation_id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'bar_width',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'bar_height',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'type',array('span'=>5,'maxlength'=>50)); ?>

                    <?php echo $form->textFieldControlGroup($model,'format',array('span'=>5,'maxlength'=>10)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->