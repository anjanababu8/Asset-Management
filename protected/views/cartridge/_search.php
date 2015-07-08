<?php
/* @var $this CartridgeController */
/* @var $model Cartridge */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'commodity_id',array('span'=>5)); ?>

                    <?php echo $form->textAreaControlGroup($model,'category_id',array('rows'=>6,'span'=>8)); ?>

                    <?php echo $form->textFieldControlGroup($model,'name',array('span'=>5,'maxlength'=>50)); ?>

                    <?php echo $form->textFieldControlGroup($model,'location_id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'technical_incharge_id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'status_id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'manufacturer_id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'cartridge_type_id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'management_type_id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'threshold',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'link_to',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'image',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'imageFileName',array('span'=>5,'maxlength'=>100)); ?>

                    <?php echo $form->textFieldControlGroup($model,'imageFileType',array('span'=>5,'maxlength'=>50)); ?>

                    <?php echo $form->textFieldControlGroup($model,'document',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'documentFileName',array('span'=>5,'maxlength'=>100)); ?>

                    <?php echo $form->textFieldControlGroup($model,'documentFileType',array('span'=>5,'maxlength'=>50)); ?>

                    <?php echo $form->textFieldControlGroup($model,'is_deleted',array('span'=>5)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->