<?php
/* @var $this BlockeditemController */
/* @var $model Blockeditem */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'commodity_id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'item_id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'blocked_by',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'blocked_on',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'blocked_from',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'blocked_to',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'unblock_by',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'unblock_on',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'blocked_for',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'flag',array('span'=>5,'maxlength'=>1)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->