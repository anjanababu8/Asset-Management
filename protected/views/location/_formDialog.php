<?php
/* @var $this ConsumabletypeController */
/* @var $model Consumabletype */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'consumabletype-form',
    'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>
 
    <p class="note">Fields with <span class="required">*</span> are required.</p>
 
    <?php echo $form->errorSummary($model); ?>
 
    <div class="control-group">
            <?php echo $form->labelEx($model, 'name', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php  $name=(!$model->isNewRecord)?$model->name:''  ?>
                <?php echo $form->textField($model, 'name', array('value'=>$name,'class' => 'span4', 'size' => 60, 'maxlength' => 128)); ?>
                <p class="help-block"><?php echo $form->error($model, 'name'); ?></p>
            </div>
        </div>

        <div class="control-group">
            <?php echo $form->labelEx($model, 'description', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textArea($model, 'description', array('class' => 'span4', 'rows' => 5, 'cols' => 50)); ?>
                <p class="help-block"><?php echo $form->error($model, 'description'); ?></p>
            </div>
        </div>

        <input type="hidden" name="YII_CSRF_TOKEN"
               value="<?php echo Yii::app()->request->csrfToken; ?>"/>
        <input type="hidden" name= "parent_id" value="<?php echo isset($_POST['parent_id'])?$_POST['parent_id']:''; ?>"  />

        <?php  if (!$model->isNewRecord): ?>
        <input type="hidden" name="update_id"
               value="<?php echo $model->id; ?>"/>
        <?php endif; ?>
        <div class="control-group">
            <?php   echo CHtml::submitButton($model->isNewRecord ? Yii::t('global', 'Submit')
                                                     : Yii::t('global', 'Save'),
                                             array('class' => 'btn btn-large pull-left')); ?>
        </div>

 
    <?php $this->endWidget(); ?>
 
</div>