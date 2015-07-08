<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Contact',
);
?>

<h1>Contact Us</h1>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<p>
If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
</p>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        <table>
        <tr>
            <div class="row">
	    <div class="col-md-3 col-sm-6">
                <div class="span2"><?php echo $form->labelEx($model,'name',array('class'=>'inline-labels'));?></div>
                <div class="span3"><?php echo $form->textField($model,'name',array('span'=>3));?></div>
	    </div>
	    </div>
	</tr>
        <tr>
            <div class="row">
	    <div class="col-md-3 col-sm-6">
                <div class="span2"><?php echo $form->labelEx($model,'email',array('class'=>'inline-labels'));?></div>
                <div class="span3"><?php echo $form->textField($model,'email',array('span'=>3));?></div>
	    </div>
	    </div>
	</tr>
        <tr>
            <div class="row">
	    <div class="col-md-3 col-sm-6">
                <div class="span2"><?php echo $form->labelEx($model,'subject',array('class'=>'inline-labels'));?></div>
                <div class="span3"><?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>128));?></div>
	    </div>
	    </div>
	</tr>
        <tr>
            <div class="row">
	    <div class="col-md-3 col-sm-6">
                <div class="span2"><?php echo $form->labelEx($model,'body',array('class'=>'inline-labels'));?></div>
                <div class="span3"><?php echo $form->textField($model,'body',array('rows'=>6, 'cols'=>50));?></div>
	    </div>
	    </div>
	</tr>
        </table>

	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		</div>
		<div class="hint"><code>Hint:</code> Please enter the letters as they are shown in the image above. Letters are not case-sensitive.</div>
		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php endif; ?>

	<div class="buttons">
		<br/>
		<?php echo CHtml::submitButton('Submit',array('class'=>'btn btn-large btn-success'));?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>