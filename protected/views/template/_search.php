<?php
/* @var $this TemplateController */
/* @var $model Template */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

        <?php echo $form->textFieldControlGroup($model,'id',array('span'=>5)); ?>

        <?php echo $form->textFieldControlGroup($model,'name',array('span'=>5,'maxlength'=>50)); ?>
    
        
    
        <?php echo $form->textFieldControlGroup($model,'organisation_id',array('span'=>5)); ?>

        <?php echo $form->textFieldControlGroup($model,'description',array('span'=>5,'maxlength'=>100)); ?>

        <?php echo $form->textFieldControlGroup($model,'date_created',array('span'=>5)); ?>

        <?php echo $form->textFieldControlGroup($model,'path',array('span'=>5,'maxlength'=>50)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->