<?php
/* @var $this TransferFileController */
/* @var $model TransferFile */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'fid',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'ownedby',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'transfer_to',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'previous_location',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'transfer_location',array('span'=>5)); ?>

                    <?php echo $form->textAreaControlGroup($model,'Remark',array('rows'=>6,'span'=>8)); ?>

                    <?php echo $form->textFieldControlGroup($model,'timestamp',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'uid',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'transfer_date',array('span'=>5)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->