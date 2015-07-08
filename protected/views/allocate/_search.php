<?php
/* @var $this AllocateController */
/* @var $model Allocate */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'allocate_id',array('span'=>5)); ?>
					
					<?php echo $form->textFieldControlGroup($model,'commodity_id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'cons_id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'stock_id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'allocate_to',array('span'=>5,'maxlength'=>50)); ?>

                    <?php echo $form->textFieldControlGroup($model,'allocate_to_extend',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'date_in',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'date_out',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'given_by',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'given_to',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'user_group',array('span'=>5,'maxlength'=>2)); ?>

                    <?php echo $form->textAreaControlGroup($model,'purpose',array('rows'=>6,'span'=>8)); ?>

                    <?php echo $form->textFieldControlGroup($model,'return_on',array('span'=>5)); ?>

                    <?php echo $form->textAreaControlGroup($model,'comments',array('rows'=>6,'span'=>8)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->