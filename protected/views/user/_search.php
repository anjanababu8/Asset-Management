<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'name',array('span'=>5,'maxlength'=>50)); ?>

                            <?php echo $form->textFieldControlGroup($model,'pw_md5',array('span'=>5,'maxlength'=>250)); ?>

                    <?php echo $form->textFieldControlGroup($model,'email',array('span'=>5,'maxlength'=>50)); ?>

                    <?php echo $form->textFieldControlGroup($model,'phone',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'phones',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'mobile',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'fn',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'ln',array('span'=>5)); ?>

                    

                    <?php echo $form->textFieldControlGroup($model,'active',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id_auth',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'auth_method',array('span'=>5,'maxlength'=>50)); ?>

                    <?php echo $form->textFieldControlGroup($model,'last_login',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'date_mod',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'designation',array('span'=>5,'maxlength'=>50)); ?>

                    <?php echo $form->textAreaControlGroup($model,'g_id',array('rows'=>6,'span'=>8)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->