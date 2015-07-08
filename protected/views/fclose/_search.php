<?php
/* @var $this FcloseController */
/* @var $model Fclose */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'fid',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'choice',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'date',array('span'=>5)); ?>

                    <?php echo $form->textAreaControlGroup($model,'remark',array('rows'=>6,'span'=>8)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->